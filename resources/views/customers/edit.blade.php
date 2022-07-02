@extends('layouts.app')

@section('title', 'Chỉnh sửa hồ sơ khách hàng')

@section('headerAddition')
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6" style="display: block; margin: 0 auto;">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('customer.save', [ $customer['id'] ]) }}" method="POST">
                    @csrf

                    @include('common.alert')

                    <div class="form-group mb-3">
                        <label for="">Họ và tên (<b class="text-danger">*</b>):</label>
                        <input type="text" name="fullname" class="form-control" placeholder="Nguyễn Văn A" value="{{ $customer['fullname'] }}">
                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="">Giới tính (<b class="text-danger">*</b>):</label>
                                <select name="gender" class="form-control">
                                    <option value="male" @selected($customer['gender'] == 'male')>Nam</option>
                                    <option value="female" @selected($customer['gender'] == 'female')>Nữ</option>
                                    <option value="unknown" @selected($customer['gender'] == 'unknown')>Không xác định</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="">Ngày sinh / Sinh nhật:</label>
                                <input id="datepicker" placeholder="d/m/Y" value="{{ (!$customer['dob']) ? '' : Carbon\Carbon::parse($customer['dob'])->format('d/m/Y') }}" />
                            </div>

                            <script>
                                $('#datepicker').datepicker({
                                    uiLibrary: 'bootstrap4',
                                    icons: {
                                        rightIcon: '<i class="fas fa-calendar-alt"></i>'
                                    }
                                });
                            </script>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="">Số điện thoại:</label>
                                <input type="text" class="form-control" name="phone" placeholder="0123456789" value="{{ $customer['phone'] }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="">Địa chỉ email:</label>
                                <input type="text" class="form-control" name="email" placeholder="example@jzontech.asia" value="{{ $customer['email'] }}">
                            </div>
                        </div>

                    </div>

                    <div class="form-group mb-3">
                        <label for="">Ghi chú:</label>
                        <textarea name="note" class="form-control" cols="30" rows="5" placeholder="Khách sộp, ưu tiên khách này, chú ý hơn, ... (Không bắt buộc)">{{ $customer['note'] }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-success">
                            <i class="mdi mdi-plus me-2"></i> Lưu thay đổi
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection