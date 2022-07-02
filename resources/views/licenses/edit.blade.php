@extends('layouts.app')

@section('title', 'Chỉnh sửa giấy phép')

@section('content')
<div class="row">

    <div class="col-lg-12">
        @include('common.alert')
    </div>

    <div class="col-lg-4" style="display: block; margin: 0 auto;">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('license.save', [ $license['id'] ]) }}" method="POST">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label for="">Thời hạn</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="duration_value" placeholder="Nhập giá trị thời hạn" value="{{ convertDurationSeconds($license['duration']) }}">
                            <div class="input-group-append">
                                <select class="form-control" name="duration_period">
                                    <option value="seconds" @selected(periodDetection($license['duration']) == 'seconds')>Giây</option>
                                    <option value="minutes" @selected(periodDetection($license['duration']) == 'minutes')>Phút</option>
                                    <option value="hours" @selected(periodDetection($license['duration']) == 'hours')>Giờ</option>
                                    <option value="days" @selected(periodDetection($license['duration']) == 'days')>Ngày</option>
                                    <option value="weeks" @selected(periodDetection($license['duration']) == 'weeks')>Tuần</option>
                                    <option value="months" @selected(periodDetection($license['duration']) == 'months')>Tháng</option>
                                    <option value="years" @selected(periodDetection($license['duration']) == 'years')>Năm</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success" type="submit">
                        Lưu thay đổi
                    </button>
                </form>
            </div>
        </div>
    </div>
    
</div>

@endsection