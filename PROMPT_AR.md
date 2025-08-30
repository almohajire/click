عنوان الملف: Prompt تنفيذي شامل لمشروع Click Exchange (Laravel)

1) وصف موجز للمشروع
- منصة تبادل زيارات/نقرات مبنية على Laravel، تمكّن المستخدمين من إضافة روابطهم وتحصيل نقاط عبر تصفح روابط الآخرين (Mining/Surf) مع منظومة نقاط وائتمان لإتاحة إضافة الروابط لاحقاً.
- توفر واجهة إدارة مبسطة لإدارة الروابط غير المؤكدة، التقارير، الإعدادات، والإعلانات.

2) أصحاب المصلحة والأدوار
- زائر غير مسجل: عرض صفحة ترحيب.
- مستخدم عادي (role = 0):
  - إضافة روابطه (بعد تفعيل عبر النقاط)، تصفح روابط الآخرين لكسب النقاط، تغيير الثيم، تفعيل/تعطيل فتح الروابط المختصرة، تقديم تقارير.
- مشرف (role > 0):
  - تأكيد/حذف روابط، الاطلاع على التقارير وحذفها، إدارة الإعدادات والخيارات العامة، عرض روابط التبادل.

3) الهيكل العام للتطبيق
- Framework: Laravel (Blade, Eloquent, Auth, Middleware)
- واجهات: Blade templates ضمن resources/views/users/* وواجهة front/zeta قديمة.
- أصول الواجهة: Bootstrap, AdminBSB, jQuery, axios, SweetAlert.
- النماذج الأساسية: User, Link, Ad, Report, Catcher, Config.

4) نماذج البيانات والعلاقات (مختصر عملي)
- User: hasMany(Link), hasMany(Ad), hasMany(Report), hasMany(Catcher), belongsToMany(Link) كروابط مكتشفة عبر pivot link_user (حقول pivot: id, codegen).
- Link: belongsTo(User)، belongsToMany(User) كـ discoverdByMany.
- Ad: belongsTo(User).
- Report: belongsTo(User, user_id).
- Catcher: belongsTo(User).
- Config: إعدادات عامة (slug, nameSetting, value, type).

5) الجداول (ملخص الحقول المؤثرة)
- links: id, link(unique), clicked, confirmed, hash(unique), level, user_id, timestamps.
- ads: id, link, vip_type, displayed, user_id, start, end, timestamps.
- reports: id, user_id, message, timestamps.
- catchers: id, user_id, user_ip, user_agent, timestamps.
- link_user: id, user_id, link_id, codegen, softDeletes, timestamps.
- configs: id, slug, nameSetting, value, type, timestamps.

6) أهم المسارات والواجهات
- عام: GET / => welcome
- مصادقة: Auth::routes()
- بعد تسجيل الدخول:
  - GET /home => لوحة المستخدم الرئيسية (إظهار أفضل المستخدمين/المشرفين بالنقاط)
  - RightBar: POST /rightbar/theme-color/{color} لتغيير الثيم، POST /rightbar/shorten-open لتبديل فتح الروابط المختصرة.
  - Reports: POST /report/lake-admin-links, /lake-admin-links2, /lake-of-links
  - Admin:
    - Links: GET /admin/link/unconfirmed، POST /admin/link/confirm/{link}، POST /admin/link/delete/{link}، GET /admin/link/exchange
    - Reports: GET /admin/link/report/، POST /admin/link/report/delete/{report}
    - Configs: index/add/store/store-config
    - Ads: index/add/store
  - Links (للمستخدم): mine, mining, points-mining, detect/{random?}, check, exchange-check, surf2/{link}, add, store, originale-send, originale
  - أمثلة: GET /dashbord

7) منطق النقاط والائتمان (خلاصة)
- المستخدم يجمع points عبر التصفح (mining). معاملات الضرب والحدود يتم التحكم بها عبر Config.
- عند بلوغ points >= points-to-activate يحصل المستخدم على credit_add لعدد links-to-add.
- بعد تفعيل: كل نقر يضيف credit_add بشكل كسري وفق how-many-clicks-to-add-1، مع وجود boosters للمشرف.
- عدادات number_click (لدى المكتشف) و number_clicked (لدى مالك الرابط) تتحدث لتوازن in_need.

8) مفاتيح الإعدادات المستعملة (Configs)
- site-name, facebook, twitter, youtube, printrest, linkedin
- points-to-activate, links-to-add, how-many-clicks-to-add-1, points-booster, credit-add-booster, points-multiplication
- repeate-link-in-days (مدة إعادة السماح بالنقر على نفس الرابط)
- value-referrer (قيمة meta referrer)
- time-skip-ad-second (زمن عرض قبل السماح بالتجاوز في surf2)
- if-all-ads-fail (رابط افتراضي عند فشل الإعلانات)

9) تجربة المستخدم الحالية (مراجعة مختصرة)
- لوحة مستخدم مبنية على AdminBSB: قوائم جانبية، ترويسة، ثيم قابل للتغيير.
- صفحات mining/exchange تعرض بطاقات روابط مع مستوى linkLevel (Low/Medium/High) ونقاط مكتسبة.
- صفحة surf تعتمد iFrame وتايمر/شريط تقدم، وتعرض إمكانية الإبلاغ.
- إشعارات Ajax عبر SweetAlert وaxios، استخدام CSRF meta.

10) قضايا/مخاطر تقنية مكتشفة (بحاجة إصلاح)
- Migrations: استخدام insigned بدلاً من unsigned، وقد يفشل عند التشغيل. Down في create_link_user_table يحاول dropIfExists('table_link_user') بدلاً من 'link_user'.
- Catcher::user() لا يعيد return للعلاقة.
- عدم تفعيل قيود العلاقات (foreign keys) مُعطلة بالتعليق، مما يقلل الاتساق المرجعي.
- originale() تستخدم cURL على أي URL بدون تصفية/قوائم سماح => خطر SSRF.
- surf.blade يستخدم jQuery 1.5.2 من CDN غير آمن http ويحمّل سكربتات قديمة.
- AdController وClicklinkController أغلبها فارغة (وظائف ناقصة).
- تحكم الوصول: بعض إجراءات الإدارة تبدو محمية بوسيط admin، لكن تحقق الدور داخل بعض الدوال يدوي وغير موحّد.

11) تحسينات وتجارب مستخدم مقترحة (مرتبة أولوية)
أ) الأمان والاستقرارية
- إصلاح migrations (unsigned, down names) وإضافة مفاتيح خارجية مع onDelete cascade.
- إضافة Validation صارمة للروابط، وتصفية/قوائم سماح للنطاقات في originale()، أو إزالة الميزة.
- ترقية مكتبات الواجهة، إزالة jQuery 1.x، استخدام https لكل الموارد.
- إضافة Rate limiting، سياسة/بوابة (Policies/Gates) لإدارة الصلاحيات بدلاً من if(role>0) داخل الكونترولر.
- حماية X-Frame-Options و CSP مع استثناءات مدروسة لصفحة surf فقط.

ب) تجربة المستخدم
- تحسين تدفق mining: توضيح حالة التقدم والنقاط المتبقية للتفعيل بشكل بصري (Progress + CTA واضح لإضافة رابط).
- توحيد سلوك أزرار Report برسائل محلية واضحة وإعادة التوجيه المتسق.
- إضافة صفحة سجل النقاط والتحويلات (Ledger) للمستخدم.
- شاشة إدارة روابط المستخدم: حالة التأكيد، عدد النقرات، سبب الرفض إن وُجد.
- دعم الوضع الداكن تلقائياً وPalette أوضح لاختيار الثيم بالأسماء والعاينات.

ج) الوظائف
- إكمال وحدات الإعلانات (إنشاء/جدولة/استهداف أساسي) وإحصاءات العرض.
- نظام مكافآت يومية/سلاسل نشاط (streaks) مضبوطة عبر Config.
- فلترة/تصنيف الروابط حسب level والمجال.
- إضافة Webhooks/Events لتحديث لوحات الإحصاءات في الزمن الحقيقي.

د) الأداء والمراقبة
- استخدام queues لأعمال ثقيلة (تحديث عدادات، تسجيل Catcher) وتقليل زمن الاستجابة.
- فهرسة قواعد البيانات المناسبة (user_id, link_id, confirmed, hash).
- سجلات ومقاييس: عدد جلسات التصفح المكتملة، نسبة التقارير، زمن الجلسة، معدل النقاط/المستخدم.

12) معايير قبول رئيسية للتحديثات
- تمر جميع الهجرات بنجاح من الصفر وتعمل العلاقات (FKs) بدون أخطاء.
- اختبارات وحدات للمنطق المالي للنقاط والائتمان.
- صفحات mining/surf تعمل دون أخطاء console أو mixed content.
- صلاحيات الإدارة مقيدة عبر Gates/Policies مثبتة باختبارات.

13) خطة تنفيذ موجزة (4 أسابيع)
- الأسبوع 1: إصلاح الهجرات والعلاقات والـPolicies والتحققات الأمنية.
- الأسبوع 2: ترقية الواجهة، تحسين UX للتعدين والتقارير، صفحة إدارة الروابط للمستخدم.
- الأسبوع 3: إتمام وحدة الإعلانات وتحليلات العرض، Queue للأعمال.
- الأسبوع 4: اختبارات، قياسات، ضبط Configs الافتراضية وتوثيق.

14) ملاحظات مرجعية للكود
- المسارات الأساسية: routes/web.php
- المنطق: app/Http/Controllers/LinkController.php, ReportController.php, RightBarController.php, HomeController.php
- النماذج: app/* (User, Link, Ad, Report, Catcher, Config)
- الواجهات: resources/views/users/**/* وخاصة links/* وlayouts/*
- الإعدادات: configs عبر App\Helpers\Config\Setting::getConfig

15) إضافات مهمة مقترحة للبرومبت
أ) الافتراضات ونطاق العمل
- تحديد واضح للنطاق: هل فتح روابط طرف ثالث داخل iFrame مسموح لكل النطاقات أم ضمن قائمة سماح؟
- التوافق: الحد الأدنى لإصدار PHP (7.4+) وLaravel (6.x+)، دعم الموبايل vs سطح المكتب.
- حدود النظام: أقصى عدد مستخدمين متزامنين، حجم قاعدة البيانات المتوقع، معدل الطلبات/الثانية.

ب) متطلبات غير وظيفية (NFRs)
- الأداء: زمن استجابة API < 500ms، تحميل الصفحات < 2s، دعم 1000+ مستخدم متزامن.
- التوفّر: نسخ احتياطي يومي، استراتيجية استعادة خلال 4 ساعات، ترقية آمنة بدون انقطاع.
- الأمان: تشفير البيانات الحساسة، مراجعة أمنية دورية، سجلات مراجعة للعمليات الحساسة.

ج) قواعد التحقق والتطبيع للروابط
- القبول فقط لبروتوكولات آمنة (https://)، تطبيع النطاق (IDN/Punycode).
- رفض الروابط الخاصة/المحلية (localhost, 127.0.0.1, 10.0.0.0/8, 192.168.0.0/16, 172.16.0.0/12).
- أقصى طول للرابط: 2048 حرف، فلترة المحتوى الضار (malware/phishing).
- قائمة سوداء للنطاقات المحظورة، قائمة بيضاء للنطاقات الموثوقة.

د) مصفوفة التصاريح والأدوار
- Guest: عرض الصفحة الرئيسية فقط.
- User (role=0): mining, surf, add links (بعد التفعيل), reports, theme settings.
- Moderator (role=1): confirm/reject links, view reports, basic configs.
- Admin (role=2): full access, user management, system configs, ads management.
- Super Admin (role=3): database access, system maintenance, user role changes.

هـ) نموذج تهديدات مختصر
- SSRF في LinkController::originale() - حل: قائمة سماح للنطاقات أو إزالة الميزة.
- XSS في عناوين/أوصاف الروابط - حل: تنظيف HTML وCSP صارمة.
- CSRF في طلبات Ajax - حل: التحقق من CSRF tokens في كل الطلبات.
- Clickjacking في صفحات iFrame - حل: X-Frame-Options مع استثناءات محددة.
- Rate limiting abuse - حل: حدود صارمة على surf/mining/reports.

و) استراتيجية مكافحة الغش
- التحقق من الوقت المُستغرق على الخادم (minimum surf time).
- كشف تكرار النقرات: نفس IP/User-Agent/Device fingerprint خلال فترة قصيرة.
- حدود يومية: أقصى نقاط/ساعة، أقصى روابط مضافة/يوم.
- نظام سمعة: تقييم المستخدم بناءً على جودة الروابط والسلوك.
- مراجعة تلقائية: تعليق الحساب عند الشبهات، مراجعة يدوية للحالات المشكوك فيها.

ز) استراتيجية التخزين المؤقت
- Cache للإعدادات: GetSetting::getConfig() مع TTL=3600s وinvalidation عند التحديث.
- Cache للاستعلامات الثقيلة: top users, link counts, مع تحديث كل 15 دقيقة.
- Session cache للبيانات المؤقتة: surf progress, mining state.

ح) التزامن والمعاملات
- كل تحديث للنقاط/الأرصدة داخل DB transactions مع isolation level REPEATABLE READ.
- Optimistic locking للعدادات المهمة (points, credits) لتجنب race conditions.
- Queue jobs للعمليات الثقيلة: تحديث الإحصاءات، إرسال الإشعارات، تنظيف البيانات.

ط) استراتيجية الاختبارات
- Unit Tests: منطق النقاط/الائتمان، validation rules، helper functions.
- Feature Tests: رحلات المستخدم الكاملة (register->mine->surf->add link).
- Security Tests: SSRF prevention، rate limiting، authorization.
- Performance Tests: load testing للصفحات الرئيسية، stress testing للـ APIs.

ي) المراقبة والرصد
- Application Metrics: response times، error rates، user activity.
- Business Metrics: daily active users، conversion rates، revenue per user.
- Security Metrics: failed login attempts، suspicious activities، blocked requests.
- Infrastructure Metrics: server resources، database performance، cache hit rates.
- Alerting: تنبيهات فورية للأخطاء الحرجة، تقارير يومية للمقاييس الرئيسية.

ك) التوطين والدولية
- دعم اللغات: العربية والإنجليزية كحد أدنى، إمكانية إضافة لغات أخرى.
- تنسيق التواريخ والأرقام حسب المنطقة الجغرافية.
- اتجاه النص (RTL للعربية، LTR للإنجليزية).
- ترجمة رسائل الأخطاء والإشعارات.

ل) خطة النشر والبيئات
- Development: بيئة محلية مع بيانات وهمية، hot reload للتطوير السريع.
- Staging: نسخة مطابقة للإنتاج، اختبارات التكامل والأداء.
- Production: بيئة آمنة مع مراقبة مستمرة، نسخ احتياطي تلقائي.
- إدارة الأسرار: استخدام .env files، تشفير المفاتيح الحساسة.
- CI/CD Pipeline: اختبارات تلقائية، نشر آمن، rollback سريع.

16) مؤشرات قياس النجاح (KPIs)
- نمو المستخدمين: Daily/Monthly Active Users، معدل الاحتفاظ بالمستخدمين.
- المشاركة: متوسط جلسات التصفح/المستخدم، معدل إكمال الجلسات.
- جودة المحتوى: نسبة الروابط المؤكدة، معدل التقارير/1000 رابط.
- الأداء التقني: uptime > 99.5%، زمن الاستجابة < 500ms.
- الأمان: zero security incidents، معدل الكشف عن الغش > 95%.

17) خطة معالجة الإساءة والمخالفات
- تصنيف المخالفات: spam links، fake traffic، abusive behavior.
- إجراءات تدريجية: تحذير -> تعليق مؤقت -> حظر دائم.
- آلية الاستئناف: نموذج طلب مراجعة، مراجعة يدوية خلال 48 ساعة.
- التوثيق: سجل كامل للمخالفات والإجراءات المتخذة.

18) خطة ترقية تدريجية
- المرحلة 1: إصلاح الأخطاء الحرجة والثغرات الأمنية.
- المرحلة 2: تحسين تجربة المستخدم والواجهات.
- المرحلة 3: إضافة ميزات جديدة وتحسين الأداء.
- المرحلة 4: التوسع والتحسين المستمر.
- اختبار رجعي: ضمان عمل الميزات الحالية بعد كل ترقية.

19) المشاكل التقنية المحددة المكتشفة (تحتاج إصلاح فوري)
أ) أخطاء في ملفات Migration:
- خطأ إملائي "insigned" بدلاً من "unsigned" في:
  * database/migrations/create_links_table.php (عمود level)
  * database/migrations/create_ads_table.php (عمود user_id)
  * database/migrations/create_reports_table.php (عمود user_id)
  * database/migrations/create_link_user_table.php (أعمدة user_id و link_id)
- خطأ في اسم الجدول في down() function:
  * create_link_user_table.php: يستخدم 'table_link_user' بدلاً من 'link_user'

ب) مشاكل في Models:
- app/Catcher.php: دالة user() لا تحتوي على return statement
- نقص في Foreign Key Constraints مع onDelete('cascade')
- عدم وجود unique composite constraint في link_user pivot table

ج) مشاكل أمنية فورية:
- SSRF vulnerability في LinkController::originale() - يحتاج URL validation
- استخدام jQuery قديم (1.12.4) مع ثغرات أمنية معروفة
- عدم وجود CSP headers أو X-Frame-Options
- عدم وجود rate limiting على العمليات الحساسة

د) مشاكل في Controllers:
- AdController.php فارغ تماماً - يحتاج تنفيذ كامل
- ClicklinkController.php فارغ - يحتاج تنفيذ
- منطق النقاط والائتمان مكرر في عدة controllers - يحتاج refactoring

هـ) مشاكل في Frontend:
- استخدام مكتبات قديمة وغير آمنة
- عدم وجود validation للمدخلات في الواجهة الأمامية
- تجربة مستخدم ضعيفة في صفحة التعدين
- عدم وجود loading states أو error handling مناسب

و) مشاكل في Database Design:
- نقص في Indexes للاستعلامات الشائعة
- عدم وجود soft deletes للبيانات المهمة
- نقص في data validation على مستوى قاعدة البيانات

20) خطة الإصلاح السريع (أولوية عالية)
المرحلة الأولى (أسبوع 1):
1. إصلاح أخطاء Migration فوراً
2. إضافة return statement في Catcher::user()
3. تحديث jQuery إلى إصدار آمن
4. إضافة basic URL validation في LinkController
5. إضافة CSP headers أساسية

المرحلة الثانية (أسبوع 2):
1. تنفيذ AdController و ClicklinkController
2. إضافة Foreign Key Constraints
3. تنفيذ rate limiting أساسي
4. تحسين تجربة المستخدم في صفحة التعدين

المرحلة الثالثة (أسبوع 3-4):
1. Refactor منطق النقاط والائتمان
2. إضافة comprehensive testing
3. تحسين الأداء والتخزين المؤقت
4. إضافة monitoring وlogging

هذا المستند هو Prompt تنفيذي شامل ومحدث: استخدمه كمرجعية موحّدة للمتابعة والتنفيذ، وحدثه مع كل تغيير جوهري في المتطلبات أو البنية.