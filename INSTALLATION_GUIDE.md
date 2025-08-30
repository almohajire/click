# دليل تثبيت Click Master System

## 📋 المتطلبات الأساسية

### متطلبات الخادم
- **PHP**: 8.1 أو أعلى
- **MySQL**: 5.7 أو أعلى / MariaDB 10.2 أو أعلى
- **Web Server**: Apache أو Nginx
- **Composer**: 2.0 أو أعلى

### امتدادات PHP المطلوبة
- `pdo`
- `pdo_mysql`
- `mbstring`
- `openssl`
- `tokenizer`
- `xml`
- `ctype`
- `json`
- `fileinfo`
- `curl`

## 🚀 خطوات التثبيت

### 1. تحضير قاعدة البيانات
```sql
-- إنشاء قاعدة البيانات
CREATE DATABASE click_master CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- إنشاء مستخدم لقاعدة البيانات (اختياري)
CREATE USER 'clickmaster'@'localhost' IDENTIFIED BY 'your_password';
GRANT ALL PRIVILEGES ON click_master.* TO 'clickmaster'@'localhost';
FLUSH PRIVILEGES;
```

### 2. تشغيل ملف التثبيت
```bash
# الوصول إلى ملف التثبيت عبر المتصفح
http://your-domain.com/install.php

# أو تشغيله من سطر الأوامر
php install.php
```

### 3. تحديث ملف .env
```bash
# نسخ ملف البيئة
cp env.example .env

# تحديث إعدادات قاعدة البيانات
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=click_master
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. تشغيل أوامر Laravel
```bash
# توليد مفتاح التطبيق
php artisan key:generate

# تشغيل الهجرات
php artisan migrate

# إدراج البيانات الأولية
php artisan db:seed

# إنشاء رابط التخزين
php artisan storage:link

# تنظيف وإعادة بناء الكاش
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# إنشاء الكاش للإنتاج
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 5. إعداد صلاحيات المجلدات
```bash
# تعيين صلاحيات الكتابة
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod -R 755 public/

# تعيين المالك (إذا كان ضرورياً)
chown -R www-data:www-data storage/
chown -R www-data:www-data bootstrap/cache/
chown -R www-data:www-data public/
```

## 🔧 إعدادات إضافية

### إعدادات Apache
```apache
<VirtualHost *:80>
    ServerName your-domain.com
    DocumentRoot /path/to/click/public
    
    <Directory /path/to/click/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/click_error.log
    CustomLog ${APACHE_LOG_DIR}/click_access.log combined
</VirtualHost>
```

### إعدادات Nginx
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/click/public;
    index index.php index.html index.htm;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### إعدادات PHP-FPM
```ini
; php.ini
memory_limit = 256M
max_execution_time = 300
upload_max_filesize = 64M
post_max_size = 64M
max_input_vars = 3000
```

## 📊 اختبار النظام

### 1. اختبار الوصول
- الوصول للصفحة الرئيسية
- اختبار نظام التسجيل
- اختبار تسجيل الدخول

### 2. اختبار قاعدة البيانات
```bash
# اختبار الاتصال
php artisan tinker
DB::connection()->getPdo();
```

### 3. اختبار الأداء
```bash
# اختبار سرعة التحميل
php artisan route:list
php artisan config:cache
```

## 🛡️ إعدادات الأمان

### 1. تحديث كلمات المرور
- تغيير كلمة مرور قاعدة البيانات
- تحديث كلمة مرور المستخدم المشرف

### 2. إعدادات HTTPS
```bash
# توجيه HTTP إلى HTTPS
# إضافة شهادة SSL
# تحديث APP_URL في .env
```

### 3. حماية الملفات
```bash
# إزالة ملف التثبيت
rm install.php

# حماية ملف .env
chmod 600 .env

# حماية مجلد storage
chmod 755 storage/
```

## 🔍 استكشاف الأخطاء

### مشاكل شائعة

#### 1. خطأ في الاتصال بقاعدة البيانات
```bash
# فحص حالة MySQL
sudo systemctl status mysql

# فحص إعدادات .env
php artisan config:show database
```

#### 2. خطأ في الصلاحيات
```bash
# فحص صلاحيات المجلدات
ls -la storage/
ls -la bootstrap/cache/

# إصلاح الصلاحيات
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

#### 3. خطأ في الكاش
```bash
# مسح الكاش
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 📞 الدعم الفني

### معلومات الاتصال
- **البريد الإلكتروني**: support@clickmaster.com
- **الموقع**: https://clickmaster.com/support
- **التوثيق**: https://docs.clickmaster.com

### معلومات النظام
- **الإصدار**: 1.0.0
- **Laravel**: 9.x
- **PHP**: 8.1+
- **MySQL**: 5.7+

## ✅ قائمة التحقق

- [ ] تثبيت PHP 8.1+
- [ ] تثبيت MySQL 5.7+
- [ ] إنشاء قاعدة البيانات
- [ ] تشغيل ملف التثبيت
- [ ] تحديث ملف .env
- [ ] تشغيل الهجرات
- [ ] إدراج البيانات الأولية
- [ ] إنشاء رابط التخزين
- [ ] إعداد الصلاحيات
- [ ] اختبار النظام
- [ ] إزالة ملف التثبيت
- [ ] إعداد HTTPS
- [ ] النسخ الاحتياطي

## 🎯 ملاحظات مهمة

1. **النسخ الاحتياطي**: قم بعمل نسخة احتياطية قبل التثبيت
2. **البيئة**: تأكد من أن البيئة مناسبة للإنتاج
3. **الأمان**: قم بتحديث كلمات المرور الافتراضية
4. **الأداء**: استخدم الكاش لتحسين الأداء
5. **المراقبة**: قم بإعداد نظام مراقبة للنظام
