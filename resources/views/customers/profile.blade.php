@extends('layouts.app')

@section('title', 'Hồ sơ khách hàng - '.$customer['fullname'].' - ID '.$customer['id'])

@section('headerAddition')
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6" style="display: block; margin: 0 auto;">
        <div class="card">
            <div class="card-body">
                <div class="form-group mb-3">
                    <label for="">Họ và tên:</label>
                    <input type="text" name="fullname" class="form-control" placeholder="Không có" value="{{ $customer['fullname'] }}" disabled>
                </div>

                <div class="row">

                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="">Giới tính:</label>
                            <select name="gender" class="form-control" disabled>
                                <option value="male" @selected($customer['gender'] == 'male')>Nam</option>
                                <option value="female" @selected($customer['gender'] == 'female')>Nữ</option>
                                <option value="unknown" @selected($customer['gender'] == 'unknown')>Không xác định</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="">Ngày sinh / Sinh nhật:</label>
                            <input id="datepicker" placeholder="Không có" value="{{ (!$customer['dob']) ? '' : Carbon\Carbon::parse($customer['dob'])->format('d/m/Y') }}" disabled />
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
                            <input type="text" class="form-control" name="phone" placeholder="Không có" value="{{ $customer['phone'] }}" disabled>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="">Địa chỉ email:</label>
                            <input type="text" class="form-control" name="email" placeholder="Không có" value="{{ $customer['email'] }}" disabled>
                        </div>
                    </div>

                </div>

                <div class="form-group mb-3">
                    <label for="">Ghi chú:</label>
                    <textarea name="note" class="form-control" cols="30" rows="5" placeholder="Không có" disabled>{{ $customer['note'] }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection