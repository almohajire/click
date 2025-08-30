<?php
/**
 * Click Master System - ملف التثبيت
 * يقوم بتحويل قاعدة البيانات من SQLite إلى MySQL
 * وإعداد النظام للنشر على السيرفر
 */

// منع الوصول المباشر
if (!defined('INSTALL_ACCESS')) {
    define('INSTALL_ACCESS', true);
}

// إعدادات قاعدة البيانات MySQL
$mysql_config = [
    'host' => 'localhost',
    'port' => '3306',
    'database' => 'click_master',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci'
];

// إعدادات Laravel
$laravel_config = [
    'app_name' => 'Click Master System',
    'app_env' => 'production',
    'app_debug' => false,
    'app_url' => 'http://localhost',
    'timezone' => 'Asia/Riyadh',
    'locale' => 'ar'
];

class ClickMasterInstaller
{
    private $mysql_config;
    private $laravel_config;
    private $errors = [];
    private $success = [];

    public function __construct($mysql_config, $laravel_config)
    {
        $this->mysql_config = $mysql_config;
        $this->laravel_config = $laravel_config;
    }

    /**
     * بدء عملية التثبيت
     */
    public function install()
    {
        echo "<h1>بدء تثبيت Click Master System</h1>\n";
        
        // فحص المتطلبات
        $this->checkRequirements();
        
        if (!empty($this->errors)) {
            $this->displayErrors();
            return false;
        }

        // إنشاء قاعدة البيانات
        $this->createDatabase();
        
        // تحويل البيانات
        $this->migrateData();
        
        // تحديث ملفات التكوين
        $this->updateConfigFiles();
        
        // إنشاء ملف .env
        $this->createEnvFile();
        
        // عرض النتائج
        $this->displayResults();
        
        return true;
    }

    /**
     * فحص متطلبات النظام
     */
    private function checkRequirements()
    {
        echo "<h2>فحص متطلبات النظام...</h2>\n";
        
        // فحص إصدار PHP
        if (version_compare(PHP_VERSION, '8.1.0', '<')) {
            $this->errors[] = "يجب أن يكون إصدار PHP 8.1 أو أعلى. الإصدار الحالي: " . PHP_VERSION;
        } else {
            $this->success[] = "✓ إصدار PHP مناسب: " . PHP_VERSION;
        }

        // فحص امتدادات PHP
        $required_extensions = ['pdo', 'pdo_mysql', 'mbstring', 'openssl', 'tokenizer', 'xml', 'ctype', 'json'];
        foreach ($required_extensions as $ext) {
            if (!extension_loaded($ext)) {
                $this->errors[] = "امتداد PHP مطلوب: $ext";
            } else {
                $this->success[] = "✓ امتداد PHP متوفر: $ext";
            }
        }

        // فحص اتصال MySQL
        try {
            $pdo = new PDO(
                "mysql:host={$this->mysql_config['host']};port={$this->mysql_config['port']}",
                $this->mysql_config['username'],
                $this->mysql_config['password']
            );
            $this->success[] = "✓ اتصال MySQL ناجح";
        } catch (PDOException $e) {
            $this->errors[] = "فشل الاتصال بـ MySQL: " . $e->getMessage();
        }

        // فحص صلاحيات الكتابة
        $writable_paths = ['storage', 'bootstrap/cache', 'public'];
        foreach ($writable_paths as $path) {
            if (is_writable($path)) {
                $this->success[] = "✓ المجلد قابل للكتابة: $path";
            } else {
                $this->errors[] = "المجلد غير قابل للكتابة: $path";
            }
        }
    }

    /**
     * إنشاء قاعدة البيانات
     */
    private function createDatabase()
    {
        echo "<h2>إنشاء قاعدة البيانات...</h2>\n";
        
        try {
            $pdo = new PDO(
                "mysql:host={$this->mysql_config['host']};port={$this->mysql_config['port']}",
                $this->mysql_config['username'],
                $this->mysql_config['password']
            );
            
            // إنشاء قاعدة البيانات
            $sql = "CREATE DATABASE IF NOT EXISTS `{$this->mysql_config['database']}` 
                    CHARACTER SET {$this->mysql_config['charset']} 
                    COLLATE {$this->mysql_config['collation']}";
            
            if ($pdo->exec($sql)) {
                $this->success[] = "✓ تم إنشاء قاعدة البيانات: {$this->mysql_config['database']}";
            }
            
            // الاتصال بقاعدة البيانات الجديدة
            $pdo = new PDO(
                "mysql:host={$this->mysql_config['host']};port={$this->mysql_config['port']};dbname={$this->mysql_config['database']}",
                $this->mysql_config['username'],
                $this->mysql_config['password']
            );
            
            // إنشاء الجداول
            $this->createTables($pdo);
            
        } catch (PDOException $e) {
            $this->errors[] = "خطأ في إنشاء قاعدة البيانات: " . $e->getMessage();
        }
    }

    /**
     * إنشاء الجداول
     */
    private function createTables($pdo)
    {
        echo "<h3>إنشاء الجداول...</h3>\n";
        
        // جدول المستخدمين
        $users_table = "
        CREATE TABLE IF NOT EXISTS `users` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL UNIQUE,
            `password` varchar(255) NOT NULL,
            `number_click` int(10) unsigned NOT NULL DEFAULT '0',
            `points` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
            `number_clicked` int(10) unsigned NOT NULL DEFAULT '0',
            `in_need` tinyint(1) NOT NULL DEFAULT '0',
            `role` tinyint(3) unsigned NOT NULL DEFAULT '0',
            `color` tinyint(3) unsigned NOT NULL DEFAULT '0',
            `shorten_open` tinyint(1) NOT NULL DEFAULT '0',
            `shorten_url` varchar(255) NOT NULL DEFAULT 'https://bitly.com',
            `credit_add` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
            `remember_token` varchar(100) DEFAULT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `users_number_click_index` (`number_click`),
            KEY `users_points_index` (`points`),
            KEY `users_number_clicked_index` (`number_clicked`),
            KEY `users_in_need_index` (`in_need`),
            KEY `users_role_index` (`role`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        
        if ($pdo->exec($users_table)) {
            $this->success[] = "✓ تم إنشاء جدول المستخدمين";
        }

        // جدول الروابط
        $links_table = "
        CREATE TABLE IF NOT EXISTS `links` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `link` varchar(255) NOT NULL UNIQUE,
            `clicked` int(11) NOT NULL DEFAULT '0',
            `confirmed` tinyint(1) NOT NULL DEFAULT '0',
            `hash` varchar(255) NOT NULL UNIQUE,
            `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
            `user_id` int(10) unsigned NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `links_clicked_index` (`clicked`),
            KEY `links_confirmed_index` (`confirmed`),
            KEY `links_level_index` (`level`),
            KEY `links_user_id_index` (`user_id`),
            KEY `links_user_id_confirmed_index` (`user_id`, `confirmed`),
            KEY `links_level_confirmed_index` (`level`, `confirmed`),
            CONSTRAINT `links_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        
        if ($pdo->exec($links_table)) {
            $this->success[] = "✓ تم إنشاء جدول الروابط";
        }

        // جدول التقارير
        $reports_table = "
        CREATE TABLE IF NOT EXISTS `reports` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `user_id` int(10) unsigned NOT NULL,
            `link_id` int(10) unsigned NOT NULL,
            `reason` text NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `reports_user_id_index` (`user_id`),
            KEY `reports_link_id_index` (`link_id`),
            CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
            CONSTRAINT `reports_link_id_foreign` FOREIGN KEY (`link_id`) REFERENCES `links` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        
        if ($pdo->exec($reports_table)) {
            $this->success[] = "✓ تم إنشاء جدول التقارير";
        }

        // جدول الإعلانات
        $ads_table = "
        CREATE TABLE IF NOT EXISTS `ads` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `title` varchar(255) NOT NULL,
            `content` text NOT NULL,
            `image` varchar(255) DEFAULT NULL,
            `active` tinyint(1) NOT NULL DEFAULT '1',
            `user_id` int(10) unsigned NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `ads_user_id_index` (`user_id`),
            KEY `ads_active_index` (`active`),
            CONSTRAINT `ads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        
        if ($pdo->exec($ads_table)) {
            $this->success[] = "✓ تم إنشاء جدول الإعلانات";
        }

        // جدول الإعدادات
        $configs_table = "
        CREATE TABLE IF NOT EXISTS `configs` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `key` varchar(255) NOT NULL UNIQUE,
            `value` text NOT NULL,
            `description` text,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `configs_key_index` (`key`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        
        if ($pdo->exec($configs_table)) {
            $this->success[] = "✓ تم إنشاء جدول الإعدادات";
        }

        // جدول السجلات
        $catchers_table = "
        CREATE TABLE IF NOT EXISTS `catchers` (
            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
            `user_id` int(10) unsigned NOT NULL,
            `action` varchar(255) NOT NULL,
            `details` text,
            `ip_address` varchar(45) DEFAULT NULL,
            `user_agent` text,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `catchers_user_id_index` (`user_id`),
            KEY `catchers_action_index` (`action`),
            KEY `catchers_created_at_index` (`created_at`),
            CONSTRAINT `catchers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        
        if ($pdo->exec($catchers_table)) {
            $this->success[] = "✓ تم إنشاء جدول السجلات";
        }

        // جدول الجلسات
        $sessions_table = "
        CREATE TABLE IF NOT EXISTS `sessions` (
            `id` varchar(255) NOT NULL,
            `user_id` bigint(20) unsigned DEFAULT NULL,
            `ip_address` varchar(45) DEFAULT NULL,
            `user_agent` text,
            `payload` text NOT NULL,
            `last_activity` int(11) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `sessions_user_id_index` (`user_id`),
            KEY `sessions_last_activity_index` (`last_activity`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";
        
        if ($pdo->exec($sessions_table)) {
            $this->success[] = "✓ تم إنشاء جدول الجلسات";
        }
    }

    /**
     * تحويل البيانات من SQLite
     */
    private function migrateData()
    {
        echo "<h2>تحويل البيانات...</h2>\n";
        
        if (!file_exists('database/database.sqlite')) {
            $this->success[] = "✓ لا توجد بيانات SQLite للتحويل";
            return;
        }

        try {
            // الاتصال بـ SQLite
            $sqlite = new PDO('sqlite:database/database.sqlite');
            $sqlite->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // الاتصال بـ MySQL
            $mysql = new PDO(
                "mysql:host={$this->mysql_config['host']};port={$this->mysql_config['port']};dbname={$this->mysql_config['database']}",
                $this->mysql_config['username'],
                $this->mysql_config['password']
            );
            $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // تحويل المستخدمين
            $users = $sqlite->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user) {
                $stmt = $mysql->prepare("
                    INSERT INTO users (name, email, password, number_click, points, number_clicked, 
                                     in_need, role, color, shorten_open, shorten_url, credit_add, 
                                     remember_token, created_at, updated_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt->execute([
                    $user['name'], $user['email'], $user['password'], $user['number_click'],
                    $user['points'], $user['number_clicked'], $user['in_need'], $user['role'],
                    $user['color'], $user['shorten_open'], $user['shorten_url'], $user['credit_add'],
                    $user['remember_token'] ?? null, $user['created_at'], $user['updated_at']
                ]);
            }
            $this->success[] = "✓ تم تحويل " . count($users) . " مستخدم";

            // تحويل الروابط
            $links = $sqlite->query('SELECT * FROM links')->fetchAll(PDO::FETCH_ASSOC);
            foreach ($links as $link) {
                $stmt = $mysql->prepare("
                    INSERT INTO links (link, clicked, confirmed, hash, level, user_id, created_at, updated_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt->execute([
                    $link['link'], $link['clicked'], $link['confirmed'], $link['hash'],
                    $link['level'], $link['user_id'], $link['created_at'], $link['updated_at']
                ]);
            }
            $this->success[] = "✓ تم تحويل " . count($links) . " رابط";

        } catch (Exception $e) {
            $this->errors[] = "خطأ في تحويل البيانات: " . $e->getMessage();
        }
    }

    /**
     * تحديث ملفات التكوين
     */
    private function updateConfigFiles()
    {
        echo "<h2>تحديث ملفات التكوين...</h2>\n";
        
        // تحديث config/database.php
        $database_config = file_get_contents('config/database.php');
        $database_config = str_replace(
            "'default' => env('DB_CONNECTION', 'sqlite')",
            "'default' => env('DB_CONNECTION', 'mysql')",
            $database_config
        );
        file_put_contents('config/database.php', $database_config);
        $this->success[] = "✓ تم تحديث إعدادات قاعدة البيانات";

        // تحديث config/app.php
        $app_config = file_get_contents('config/app.php');
        $app_config = str_replace(
            "'name' => env('APP_NAME', 'Laravel')",
            "'name' => env('APP_NAME', '{$this->laravel_config['app_name']}')",
            $app_config
        );
        $app_config = str_replace(
            "'env' => env('APP_ENV', 'local')",
            "'env' => env('APP_ENV', '{$this->laravel_config['app_env']}')",
            $app_config
        );
        $app_config = str_replace(
            "'debug' => env('APP_DEBUG', true)",
            "'debug' => env('APP_DEBUG', {$this->laravel_config['app_debug']})",
            $app_config
        );
        $app_config = str_replace(
            "'url' => env('APP_URL', 'http://localhost')",
            "'url' => env('APP_URL', '{$this->laravel_config['app_url']}')",
            $app_config
        );
        $app_config = str_replace(
            "'timezone' => 'UTC'",
            "'timezone' => '{$this->laravel_config['timezone']}'",
            $app_config
        );
        $app_config = str_replace(
            "'locale' => 'en'",
            "'locale' => '{$this->laravel_config['locale']}'",
            $app_config
        );
        file_put_contents('config/app.php', $app_config);
        $this->success[] = "✓ تم تحديث إعدادات التطبيق";
    }

    /**
     * إنشاء ملف .env
     */
    private function createEnvFile()
    {
        echo "<h2>إنشاء ملف البيئة...</h2>\n";
        
        $env_content = "APP_NAME=\"{$this->laravel_config['app_name']}\"
APP_ENV={$this->laravel_config['app_env']}
APP_KEY=
APP_DEBUG={$this->laravel_config['app_debug']}
APP_URL={$this->laravel_config['app_url']}

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST={$this->mysql_config['host']}
DB_PORT={$this->mysql_config['port']}
DB_DATABASE={$this->mysql_config['database']}
DB_USERNAME={$this->mysql_config['username']}
DB_PASSWORD={$this->mysql_config['password']}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=database
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=\"hello@example.com\"
MAIL_FROM_NAME=\"{$this->laravel_config['app_name']}\"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME=\"{$this->laravel_config['app_name']}\"
VITE_PUSHER_APP_KEY=\"{PUSHER_APP_KEY}\"
VITE_PUSHER_HOST=\"{PUSHER_HOST}\"
VITE_PUSHER_PORT=\"{PUSHER_PORT}\"
VITE_PUSHER_SCHEME=\"{PUSHER_SCHEME}\"
VITE_PUSHER_APP_CLUSTER=\"{PUSHER_APP_CLUSTER}\"";

        if (file_put_contents('.env', $env_content)) {
            $this->success[] = "✓ تم إنشاء ملف .env";
        } else {
            $this->errors[] = "فشل في إنشاء ملف .env";
        }
    }

    /**
     * عرض الأخطاء
     */
    private function displayErrors()
    {
        echo "<div style='color: red; background: #ffe6e6; padding: 15px; border: 1px solid #ff9999; margin: 10px 0;'>";
        echo "<h3>❌ الأخطاء التي تم اكتشافها:</h3>";
        foreach ($this->errors as $error) {
            echo "<p>• $error</p>";
        }
        echo "</div>";
    }

    /**
     * عرض النتائج
     */
    private function displayResults()
    {
        echo "<h2>🎉 تم التثبيت بنجاح!</h2>\n";
        
        echo "<div style='color: green; background: #e6ffe6; padding: 15px; border: 1px solid #99ff99; margin: 10px 0;'>";
        echo "<h3>✅ العمليات المكتملة:</h3>";
        foreach ($this->success as $success) {
            echo "<p>$success</p>";
        }
        echo "</div>";

        echo "<h3>📋 الخطوات التالية:</h3>";
        echo "<ol>";
        echo "<li>قم بتشغيل الأمر: <code>php artisan key:generate</code></li>";
        echo "<li>قم بتشغيل الأمر: <code>php artisan migrate</code></li>";
        echo "<li>قم بتشغيل الأمر: <code>php artisan db:seed</code></li>";
        echo "<li>قم بتشغيل الأمر: <code>php artisan storage:link</code></li>";
        echo "<li>قم بتشغيل الأمر: <code>php artisan config:cache</code></li>";
        echo "<li>قم بتشغيل الأمر: <code>php artisan route:cache</code></li>";
        echo "<li>قم بتشغيل الأمر: <code>php artisan view:cache</code></li>";
        echo "</ol>";

        echo "<h3>🔧 معلومات قاعدة البيانات:</h3>";
        echo "<ul>";
        echo "<li><strong>النوع:</strong> MySQL</li>";
        echo "<li><strong>الخادم:</strong> {$this->mysql_config['host']}</li>";
        echo "<li><strong>المنفذ:</strong> {$this->mysql_config['port']}</li>";
        echo "<li><strong>اسم قاعدة البيانات:</strong> {$this->mysql_config['database']}</li>";
        echo "<li><strong>اسم المستخدم:</strong> {$this->mysql_config['username']}</li>";
        echo "<li><strong>الترميز:</strong> {$this->mysql_config['charset']}</li>";
        echo "</ul>";

        echo "<h3>⚠️ ملاحظات مهمة:</h3>";
        echo "<ul>";
        echo "<li>تأكد من تحديث كلمة مرور قاعدة البيانات في ملف .env</li>";
        echo "<li>قم بإزالة ملف install.php بعد التثبيت</li>";
        echo "<li>تأكد من صلاحيات المجلدات storage و bootstrap/cache</li>";
        echo "<li>قم بتشغيل النظام في بيئة آمنة</li>";
        echo "</ul>";
    }
}

// بدء التثبيت إذا تم الوصول للملف مباشرة
if (defined('INSTALL_ACCESS')) {
    $installer = new ClickMasterInstaller($mysql_config, $laravel_config);
    $installer->install();
}
?>
