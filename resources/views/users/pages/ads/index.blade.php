@extends('layouts.dashboard')

@section('title', 'إدارة الإعلانات')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-ad"></i>
                        إدارة الإعلانات
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.ads.add') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            إضافة إعلان جديد
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> نجح!</h5>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> خطأ!</h5>
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الرابط</th>
                                    <th>المستخدم</th>
                                    <th>نوع VIP</th>
                                    <th>تاريخ البداية</th>
                                    <th>تاريخ النهاية</th>
                                    <th>عدد المشاهدات</th>
                                    <th>الحالة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ads as $ad)
                                    <tr>
                                        <td>{{ $ad->id }}</td>
                                        <td>
                                            <a href="{{ $ad->link }}" target="_blank" class="text-primary">
                                                {{ strlen($ad->link) > 50 ? substr($ad->link, 0, 50) . '...' : $ad->link }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($ad->user)
                                                <span class="badge badge-info">{{ $ad->user->name }}</span>
                                            @else
                                                <span class="badge badge-secondary">غير محدد</span>
                                            @endif
                                        </td>
                                        <td>
                                            @switch($ad->vip_type)
                                                @case(0)
                                                    <span class="badge badge-secondary">عادي</span>
                                                    @break
                                                @case(1)
                                                    <span class="badge badge-warning">VIP 1</span>
                                                    @break
                                                @case(2)
                                                    <span class="badge badge-success">VIP 2</span>
                                                    @break
                                                @case(3)
                                                    <span class="badge badge-danger">VIP 3</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-secondary">غير محدد</span>
                                            @endswitch
                                        </td>
                                        <td>{{ $ad->start ? $ad->start->format('Y-m-d') : 'غير محدد' }}</td>
                                        <td>{{ $ad->end ? $ad->end->format('Y-m-d') : 'غير محدد' }}</td>
                                        <td>
                                            <span class="badge badge-primary">{{ number_format($ad->displayed) }}</span>
                                        </td>
                                        <td>
                                            @if(!$ad->start || !$ad->end)
                                                <span class="badge badge-secondary">غير محدد</span>
                                            @elseif($ad->start <= now() && $ad->end >= now())
                                                <span class="badge badge-success">نشط</span>
                                            @elseif($ad->start > now())
                                                <span class="badge badge-warning">قادم</span>
                                            @else
                                                <span class="badge badge-danger">منتهي</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fas fa-cog"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{ route('admin.ads.edit', $ad->id) }}" class="dropdown-item">
                                                        <i class="fas fa-edit"></i>
                                                        تعديل
                                                    </a>
                                                    <form action="{{ route('admin.ads.delete', $ad->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('هل أنت متأكد من حذف هذا الإعلان؟')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" style="border: none; background: none; width: 100%; text-align: right;">
                                                            <i class="fas fa-trash"></i>
                                                            حذف
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            <div class="alert alert-info">
                                                لا توجد إعلانات متاحة حالياً
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($ads->hasPages())
                        <div class="d-flex justify-content-center">
                            {{ $ads->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal تأكيد الحذف -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تأكيد الحذف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من حذف هذا الإعلان؟</p>
                <p class="text-danger">لا يمكن التراجع عن هذا الإجراء!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">حذف</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function deleteAd(adId) {
    if (confirm('هل أنت متأكد من حذف هذا الإعلان؟')) {
        // هنا يمكن إضافة كود حذف الإعلان
        console.log('حذف الإعلان:', adId);
    }
}

// تفعيل tooltips
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection
