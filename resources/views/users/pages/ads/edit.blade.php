@extends('layouts.dashboard')

@section('title', 'تعديل الإعلان')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i>
                        تعديل الإعلان
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.ads.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            العودة للإعلانات
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form id="editAdForm" method="POST" action="{{ route('admin.ads.update', $ad->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="link">رابط الإعلان <span class="text-danger">*</span></label>
                                    <input type="url" class="form-control @error('link') is-invalid @enderror" 
                                           id="link" name="link" value="{{ old('link', $ad->link) }}" 
                                           placeholder="https://example.com" required>
                                    @error('link')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">أدخل رابط الإعلان الكامل</small>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="vip_type">نوع VIP <span class="text-danger">*</span></label>
                                    <select class="form-control @error('vip_type') is-invalid @enderror" 
                                            id="vip_type" name="vip_type" required>
                                        <option value="">اختر النوع</option>
                                        <option value="0" {{ old('vip_type', $ad->vip_type) == '0' ? 'selected' : '' }}>
                                            عادي (10 نقاط)
                                        </option>
                                        <option value="1" {{ old('vip_type', $ad->vip_type) == '1' ? 'selected' : '' }}>
                                            VIP 1 (25 نقطة)
                                        </option>
                                        <option value="2" {{ old('vip_type', $ad->vip_type) == '2' ? 'selected' : '' }}>
                                            VIP 2 (50 نقطة)
                                        </option>
                                        <option value="3" {{ old('vip_type', $ad->vip_type) == '3' ? 'selected' : '' }}>
                                            VIP 3 (100 نقطة)
                                        </option>
                                    </select>
                                    @error('vip_type')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start">تاريخ البداية <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('start') is-invalid @enderror" 
                                           id="start" name="start" 
                                           value="{{ old('start', $ad->start ? $ad->start->format('Y-m-d') : '') }}" required>
                                    @error('start')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">تاريخ بداية عرض الإعلان</small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end">تاريخ النهاية <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('end') is-invalid @enderror" 
                                           id="end" name="end" 
                                           value="{{ old('end', $ad->end ? $ad->end->format('Y-m-d') : '') }}" required>
                                    @error('end')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">تاريخ انتهاء عرض الإعلان</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>عدد المشاهدات</label>
                                    <input type="text" class="form-control" value="{{ number_format($ad->displayed) }}" readonly>
                                    <small class="form-text text-muted">لا يمكن تعديل عدد المشاهدات</small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>تاريخ الإنشاء</label>
                                    <input type="text" class="form-control" value="{{ $ad->created_at->format('Y-m-d H:i') }}" readonly>
                                    <small class="form-text text-muted">تاريخ إنشاء الإعلان</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="updateBtn">
                                <i class="fas fa-save"></i>
                                تحديث الإعلان
                            </button>
                            <a href="{{ route('admin.ads.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                                إلغاء
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // التحقق من صحة التواريخ
    $('#start').on('change', function() {
        const startDate = new Date($(this).val());
        const endDate = new Date($('#end').val());
        
        if (endDate && endDate <= startDate) {
            $('#end').val('');
            alert('تاريخ النهاية يجب أن يكون بعد تاريخ البداية');
        }
    });
    
    // عرض معلومات التكلفة عند تغيير نوع VIP
    $('#vip_type').on('change', function() {
        const selectedType = $(this).val();
        if (selectedType !== '') {
            const costs = {
                '0': '10 نقاط',
                '1': '25 نقطة',
                '2': '50 نقطة',
                '3': '100 نقطة'
            };
            
            const cost = costs[selectedType];
            if (cost) {
                alert(`تكلفة هذا النوع: ${cost}`);
            }
        }
    });
    
    // معالجة إرسال النموذج
    $('#editAdForm').on('submit', function(e) {
        const updateBtn = $('#updateBtn');
        updateBtn.prop('disabled', true);
        updateBtn.html('<i class="fas fa-spinner fa-spin"></i> جاري التحديث...');
    });
});
</script>
@endsection
