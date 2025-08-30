@extends('layouts.app')

@section('title', 'خطأ في الخادم')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="error-page">
                <div class="error-icon">
                    <i class="fas fa-exclamation-triangle text-warning" style="font-size: 5rem;"></i>
                </div>
                
                <h1 class="text-gradient mb-4">خطأ 500</h1>
                <h2 class="mb-4">خطأ في الخادم</h2>
                
                <p class="text-muted mb-4">
                    عذراً، حدث خطأ في الخادم. يرجى المحاولة مرة أخرى لاحقاً.
                </p>
                
                @if(isset($error))
                    <div class="alert alert-danger mb-4">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ $error }}
                    </div>
                @endif
                
                <div class="error-actions">
                    <a href="{{ route('welcome') }}" class="btn btn-primary me-3">
                        <i class="fas fa-home me-2"></i>
                        العودة للرئيسية
                    </a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            لوحة التحكم
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            تسجيل الدخول
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
