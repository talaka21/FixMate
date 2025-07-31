@extends('layouts.app')

@section('content')
<div class="container">
    <h2>لوحة تحكم المدير</h2>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>المستخدمين</h5>
                    <p>{{ \App\Models\User::count() }}</p>
                </div>
            </div>
        </div>
        <!-- أضف المزيد لاحقًا حسب الأقسام -->
    </div>
</div>
@endsection
