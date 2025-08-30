# Click Master System

## 🎯 نظرة عامة
نظام متكامل لإدارة الروابط والنقاط مبني على Laravel 9، يوفر منصة آمنة وفعالة لإدارة الروابط وتتبع النقاط.

## ✨ المميزات
- **نظام مصادقة متكامل** مع إدارة الأدوار
- **إدارة الروابط** مع نظام تأكيد متقدم
- **نظام النقاط** مع تتبع دقيق للنقرات
- **لوحة تحكم للمشرفين** مع إحصائيات شاملة
- **نظام التقارير** لحماية النظام
- **واجهة مستخدم عربية** سهلة الاستخدام
- **نظام إعلانات** متكامل
- **سجلات النظام** لتتبع العمليات

## 🚀 التثبيت السريع

### المتطلبات
- PHP 8.1+
- MySQL 5.7+
- Composer 2.0+
- Web Server (Apache/Nginx)

### خطوات التثبيت

#### 1. استنساخ المشروع
```bash
git clone https://github.com/your-username/click-master.git
cd click-master
composer install
```

#### 2. تشغيل ملف التثبيت
```bash
# عبر المتصفح
http://your-domain.com/install.php

# أو من سطر الأوامر
php install.php
```

#### 3. إعداد Laravel
```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```

#### 4. إعداد الصلاحيات
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
chmod -R 755 public/
```

## 📁 بنية المشروع

```
click/
├── app/                    # منطق التطبيق
│   ├── Http/             # المتحكمات والوسائط
│   ├── Models/           # النماذج
│   └── Providers/        # مزودي الخدمات
├── config/               # ملفات التكوين
├── database/             # الهجرات والبذور
├── public/               # الملفات العامة
├── resources/            # الموارد والواجهات
├── routes/               # مسارات التطبيق
├── storage/              # الملفات المؤقتة
├── install.php           # ملف التثبيت
├── database.sql          # مخطط قاعدة البيانات
└── INSTALLATION_GUIDE.md # دليل التثبيت
```

## 🔧 الإعدادات

### قاعدة البيانات
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=click_master
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### التطبيق
```env
APP_NAME="Click Master System"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
```

## 📊 الجداول الرئيسية

- **users**: المستخدمين والمشرفين
- **links**: الروابط والنقاط
- **reports**: تقارير المستخدمين
- **ads**: الإعلانات
- **configs**: إعدادات النظام
- **catchers**: سجلات النظام
- **sessions**: جلسات المستخدمين

## 🛡️ الأمان

- حماية CSRF
- مصادقة قوية
- تشفير كلمات المرور
- إدارة الأدوار
- سجلات الأمان
- حماية من SQL Injection

## 🚀 النشر على السيرفر

### 1. تحضير السيرفر
```bash
# تثبيت المتطلبات
sudo apt update
sudo apt install php8.1 php8.1-mysql php8.1-fpm nginx mysql-server
```

### 2. رفع الملفات
```bash
# رفع المشروع
scp -r click/ user@server:/var/www/
```

### 3. إعداد قاعدة البيانات
```sql
CREATE DATABASE click_master CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4. تشغيل التثبيت
```bash
cd /var/www/click
php install.php
```

## 🔍 استكشاف الأخطاء

### مشاكل شائعة
1. **خطأ في الصلاحيات**: تأكد من صلاحيات المجلدات
2. **خطأ في قاعدة البيانات**: فحص إعدادات الاتصال
3. **خطأ في الكاش**: مسح وإعادة بناء الكاش

### أوامر مفيدة
```bash
# فحص الأخطاء
php artisan config:show
php artisan route:list

# مسح الكاش
php artisan cache:clear
php artisan config:clear
```

## 📈 الأداء

### تحسينات مقترحة
- استخدام Redis للكاش
- ضغط الصور
- CDN للملفات الثابتة
- قاعدة بيانات محسنة

### مراقبة الأداء
```bash
# مراقبة الاستعلامات
php artisan debugbar:clear

# تحليل الأداء
php artisan route:cache
php artisan config:cache
```

## 🤝 المساهمة

### كيفية المساهمة
1. Fork المشروع
2. إنشاء فرع للميزة الجديدة
3. Commit التغييرات
4. Push للفرع
5. إنشاء Pull Request

### معايير الكود
- اتباع معايير PSR-12
- تعليقات باللغة العربية
- اختبارات شاملة
- توثيق واضح

## 📞 الدعم

### قنوات الدعم
- **البريد الإلكتروني**: support@clickmaster.com
- **المسائل**: GitHub Issues
- **التوثيق**: INSTALLATION_GUIDE.md
- **المجتمع**: Discord Server

### معلومات النظام
- **الإصدار**: 1.0.0
- **Laravel**: 9.x
- **PHP**: 8.1+
- **MySQL**: 5.7+
- **الترخيص**: MIT

## 📝 الترخيص

هذا المشروع مرخص تحت رخصة MIT. راجع ملف [LICENSE](LICENSE) للتفاصيل.

## 🙏 الشكر

- فريق Laravel
- المجتمع العربي
- المساهمين في المشروع

---

**تم التطوير بواسطة Click Master Team** 🚀
