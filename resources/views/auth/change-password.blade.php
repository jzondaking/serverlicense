@extends('layouts.app')

@section('title', 'Đổi mật khẩu')

@section('content')
<div class="row">
    <div class="col-lg-6" style="display: block; margin: 0 auto;">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('auth.do_change_pwd') }}" method="POST">
                    @csrf

                    @include('common.alert')

                    <div class="form-group mb-3">
                        <label for="">Mật khẩu cũ</label>
                        <input type="password" name="old" class="form-control" placeholder="************">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Mật khẩu mới</label>
                        <input type="password" name="new" class="form-control" placeholder="************">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Xác nhận mật khẩu mới</label>
                        <input type="password" name="confirm" class="form-control" placeholder="************">
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-success">
                            Đổi mật khẩu
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection