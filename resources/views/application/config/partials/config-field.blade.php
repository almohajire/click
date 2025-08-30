@php
    $name = $config->slug;
    $for = $config->slug;
    $textLabel = $config->nameSetting;
    $required = false;
    $class = 'form-control';
    
    // تحسين عرض القيمة
    $displayValue = $config->value;
    if (empty($displayValue) && $displayValue !== '0') {
        $displayValue = 'غير محدد';
    }
@endphp

<div class="config-section" data-config-type="{{ $config->type }}" data-config-slug="{{ $config->slug }}">
    <div class="form-group">
        <!-- عنوان الحقل -->
        <div class="field-header">
            <label for="{{ $for }}" class="control-label">
                {{ $textLabel }}
                @if($required) <span class="required-mark">*</span> @endif
            </label>
        </div>

        <!-- عرض القيمة الحالية -->
        <div class="current-value-display">
            <div class="value-content">
                @if($config->type == 'file' && !empty($config->value))
                    <div class="file-value">
                        {{ $config->value }}
                    </div>
                @elseif($config->type == 'textarea')
                    <div class="textarea-value">
                        {{ strlen($displayValue) > 100 ? substr($displayValue, 0, 100) . '...' : $displayValue }}
                        @if(strlen($displayValue) > 100)
                            <span class="expand-text" onclick="toggleText(this, '{{ $config->slug }}')">عرض المزيد</span>
                        @endif
                    </div>
                @else
                    <div class="text-value">
                        {{ $displayValue }}
                    </div>
                @endif
            </div>
        </div>

        <!-- حقل الإدخال -->
        <div class="input-container">
            @if($config->type == 'number')
                <div class="input-wrapper number-input">
                    {!! Form::number($config->slug, $config->value, [
                        'class' => $class . ' enhanced-input',
                        'placeholder' => 'أدخل ' . $textLabel,
                        'min' => '0',
                        'step' => 'any'
                    ]) !!}
                </div>

            @elseif($config->type == 'text')
                <div class="input-wrapper text-input">
                    {!! Form::text($config->slug, $config->value, [
                        'class' => $class . ' enhanced-input',
                        'placeholder' => 'أدخل ' . $textLabel
                    ]) !!}
                </div>

            @elseif($config->type == 'tel')
                <div class="input-wrapper tel-input">
                    {!! Form::tel($config->slug, $config->value, [
                        'class' => $class . ' enhanced-input',
                        'placeholder' => 'أدخل ' . $textLabel,
                        'pattern' => '[0-9+\-\s\(\)]+'
                    ]) !!}
                </div>

            @elseif($config->type == 'email')
                <div class="input-wrapper email-input">
                    {!! Form::email($config->slug, $config->value, [
                        'class' => $class . ' enhanced-input',
                        'placeholder' => 'أدخل ' . $textLabel
                    ]) !!}
                </div>

            @elseif($config->type == 'textarea')
                <div class="input-wrapper textarea-input">
                    {!! Form::textarea($config->slug, $config->value, [
                        'class' => $class . ' enhanced-input',
                        'placeholder' => 'أدخل ' . $textLabel,
                        'rows' => 4,
                        'style' => 'resize: vertical;'
                    ]) !!}
                </div>

            @elseif($config->type == 'file')
                <div class="file-upload-container">
                    <div class="upload-area">
                        <p class="upload-text">اختر ملف أو اسحبه هنا</p>
                        <small class="upload-hint">الملفات المدعومة: JPG, PNG, GIF, PDF</small>
                    </div>
                    
                    {!! Form::file($config->slug, [
                        'class' => 'file-input',
                        'accept' => 'image/*,.pdf,.doc,.docx'
                    ]) !!}
                    
                    @if(\App\Helpers\Config\Setting::ifImg($config->slug))
                        <div class="current-image-preview">
                            <h6 class="preview-title">الصورة الحالية:</h6>
                            <div class="image-container">
                                <img src="{{ \App\Helpers\Config\Setting::ifImg($config->slug) }}" 
                                     alt="{{ $textLabel }}" 
                                     class="current-image"
                                     onclick="openImageModal(this.src, '{{ $textLabel }}')" />
                                <div class="image-overlay">
                                    <i class="material-icons">zoom_in</i>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            @elseif($config->type == 'url')
                <div class="input-wrapper url-input">
                    {!! Form::url($config->slug, $config->value, [
                        'class' => $class . ' enhanced-input',
                        'placeholder' => 'أدخل ' . $textLabel
                    ]) !!}
                </div>

            @else
                <!-- نوع غير معروف - استخدام حقل نص عادي -->
                <div class="input-wrapper text-input">
                    {!! Form::text($config->slug, $config->value, [
                        'class' => $class . ' enhanced-input',
                        'placeholder' => 'أدخل ' . $textLabel
                    ]) !!}
                </div>
            @endif
        </div>

        <!-- رسائل الخطأ -->
        @if ($errors->has($config->slug))
            <div class="error-message">
                <span class="error-text">{{ $errors->first($config->slug) }}</span>
            </div>
        @endif
    </div>
</div>

<style>
/* تصميم مبسط ونظيف */
.config-section {
    background: white;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 25px;
    border-left: 5px solid #667eea;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.config-section:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
}

.field-header {
    margin-bottom: 20px;
}

.control-label {
    color: #2c3e50;
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 0;
    display: block;
    line-height: 1.4;
}

.required-mark {
    color: #e74c3c;
    font-weight: 800;
    margin-right: 4px;
}

/* عرض القيمة الحالية */
.current-value-display {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
}

.value-content {
    color: #495057;
    font-weight: 500;
    font-size: 15px;
}

.file-value {
    color: #28a745;
    font-weight: 600;
}

.textarea-value {
    line-height: 1.6;
}

.expand-text {
    color: #667eea;
    cursor: pointer;
    text-decoration: underline;
    margin-right: 10px;
    font-weight: 600;
}

.expand-text:hover {
    color: #5a6fd8;
}

/* حقول الإدخال */
.input-container {
    margin-bottom: 15px;
}

.enhanced-input {
    padding: 15px 18px;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: #f8f9fa;
    font-weight: 500;
    width: 100%;
}

.enhanced-input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
    background: white;
    outline: none;
}

/* تحسينات خاصة بالملفات */
.file-upload-container {
    border: 2px dashed #dee2e6;
    border-radius: 12px;
    padding: 25px;
    text-align: center;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.file-upload-container:hover {
    border-color: #667eea;
    background: rgba(102, 126, 234, 0.05);
}

.upload-text {
    font-size: 16px;
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
}

.upload-hint {
    color: #6c757d;
    font-size: 12px;
}

.file-input {
    margin: 20px 0;
}

.current-image-preview {
    margin-top: 20px;
    padding: 20px;
    background: white;
    border-radius: 10px;
    border: 1px solid #dee2e6;
}

.preview-title {
    color: #495057;
    font-weight: 600;
    margin-bottom: 15px;
}

.image-container {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

.current-image {
    max-width: 200px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 8px;
}

.image-overlay i {
    color: white;
    font-size: 24px;
}

.image-container:hover .image-overlay {
    opacity: 1;
}

.image-container:hover .current-image {
    transform: scale(1.05);
}

/* رسائل الخطأ */
.error-message {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #dc3545;
    border-radius: 8px;
    padding: 12px 15px;
    margin-top: 10px;
}

.error-text {
    font-weight: 500;
}

/* تحسينات للأجهزة المحمولة */
@media (max-width: 768px) {
    .config-section {
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .control-label {
        font-size: 16px;
    }
    
    .current-value-display {
        padding: 12px;
    }
    
    .file-upload-container {
        padding: 20px;
    }
    
    .current-image {
        max-width: 150px;
    }
}
</style>

<script>
// وظيفة تبديل عرض النص الطويل
function toggleText(element, slug) {
    const textarea = document.querySelector(`[name="${slug}"]`);
    if (textarea) {
        const currentText = textarea.value;
        if (element.textContent === 'عرض المزيد') {
            element.textContent = 'إخفاء';
            element.previousElementSibling.textContent = currentText;
        } else {
            element.textContent = 'عرض المزيد';
            element.previousElementSibling.textContent = currentText.length > 100 ? 
                currentText.substring(0, 100) + '...' : currentText;
        }
    }
}

// وظيفة فتح الصورة في نافذة منبثقة
function openImageModal(src, title) {
    const modal = document.createElement('div');
    modal.className = 'image-modal';
    modal.innerHTML = `
        <div class="modal-overlay" onclick="closeImageModal()">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>${title}</h5>
                    <button class="close-btn" onclick="closeImageModal()">×</button>
                </div>
                <div class="modal-body">
                    <img src="${src}" alt="${title}" />
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    const modal = document.querySelector('.image-modal');
    if (modal) {
        modal.remove();
        document.body.style.overflow = 'auto';
    }
}

// تحسين تجربة المستخدم
document.addEventListener('DOMContentLoaded', function() {
    // إضافة تأثيرات للحقول
    const inputs = document.querySelectorAll('.enhanced-input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
        });
    });
    
    // تحسين عرض الملفات
    const fileInputs = document.querySelectorAll('.file-input');
    fileInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const container = this.closest('.file-upload-container');
                const uploadArea = container.querySelector('.upload-area');
                
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        uploadArea.innerHTML = `
                            <img src="${e.target.result}" alt="معاينة" style="max-width: 150px; border-radius: 8px; margin-bottom: 15px;" />
                            <p style="color: #28a745; font-weight: 600;">تم اختيار: ${file.name}</p>
                        `;
                    };
                    reader.readAsDataURL(file);
                } else {
                    uploadArea.innerHTML = `
                        <p style="color: #28a745; font-weight: 600;">تم اختيار: ${file.name}</p>
                    `;
                }
            }
        });
    });
});
</script>

<style>
/* نافذة الصورة المنبثقة */
.image-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 9999;
}

.modal-overlay {
    background: rgba(0,0,0,0.8);
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.modal-content {
    background: white;
    border-radius: 15px;
    max-width: 90%;
    max-height: 90%;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #dee2e6;
}

.modal-header h5 {
    margin: 0;
    color: #2c3e50;
    font-weight: 600;
}

.close-btn {
    background: none;
    border: none;
    font-size: 28px;
    color: #6c757d;
    cursor: pointer;
    padding: 5px;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.close-btn:hover {
    background: #f8f9fa;
    color: #495057;
}

.modal-body {
    padding: 20px;
    text-align: center;
}

.modal-body img {
    max-width: 100%;
    max-height: 70vh;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
</style>