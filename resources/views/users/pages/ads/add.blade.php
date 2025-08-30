@extends('layouts.dashboard')

@section('title', 'إضافة إعلان جديد')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus"></i>
                        إضافة إعلان جديد
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.ads.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            العودة للإعلانات
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form id="adForm" method="POST" action="{{ route('admin.ads.store') }}">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="link">رابط الإعلان <span class="text-danger">*</span></label>
                                    <input type="url" class="form-control @error('link') is-invalid @enderror" 
                                           id="link" name="link" value="{{ old('link') }}" 
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
                                        <option value="0" {{ old('vip_type') == '0' ? 'selected' : '' }}>
                                            عادي (10 نقاط)
                                        </option>
                                        <option value="1" {{ old('vip_type') == '1' ? 'selected' : '' }}>
                                            VIP 1 (25 نقطة)
                                        </option>
                                        <option value="2" {{ old('vip_type') == '2' ? 'selected' : '' }}>
                                            VIP 2 (50 نقطة)
                                        </option>
                                        <option value="3" {{ old('vip_type') == '3' ? 'selected' : '' }}>
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
                                           id="start" name="start" value="{{ old('start') }}" required>
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
                                           id="end" name="end" value="{{ old('end') }}" required>
                                    @error('end')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">تاريخ انتهاء عرض الإعلان</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">وصف الإعلان (اختياري)</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" 
                                      placeholder="وصف مختصر للإعلان">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save"></i>
                                حفظ الإعلان
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

<!-- Modal معلومات التكلفة -->
<div class="modal fade" id="costModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">معلومات تكلفة الإعلانات</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>النوع</th>
                                <th>التكلفة</th>
                                <th>المميزات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge badge-secondary">عادي</span></td>
                                <td>10 نقاط</td>
                                <td>عرض عادي</td>
                            </tr>
                            <tr>
                                <td><span class="badge badge-warning">VIP 1</span></td>
                                <td>25 نقطة</td>
                                <td>عرض مميز</td>
                            </tr>
                            <tr>
                                <td><span class="badge badge-success">VIP 2</span></td>
                                <td>50 نقطة</td>
                                <td>عرض مميز جداً</td>
                            </tr>
                            <tr>
                                <td><span class="badge badge-danger">VIP 3</span></td>
                                <td>100 نقطة</td>
                                <td>عرض متميز</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // تعيين التاريخ الحالي كتاريخ بداية افتراضي
    const today = new Date().toISOString().split('T')[0];
    $('#start').val(today);
    
    // تعيين تاريخ النهاية (أسبوع من اليوم)
    const nextWeek = new Date();
    nextWeek.setDate(nextWeek.getDate() + 7);
    $('#end').val(nextWeek.toISOString().split('T')[0]);
    
    // التحقق من صحة التواريخ
    $('#start').on('change', function() {
        const startDate = new Date($(this).val());
        const endDate = new Date($('#end').val());
        
        if (endDate <= startDate) {
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
    $('#adForm').on('submit', function(e) {
        const submitBtn = $('#submitBtn');
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...');
    });
});

// عرض معلومات التكلفة
function showCostInfo() {
    $('#costModal').modal('show');
}
</script>
@endsection
