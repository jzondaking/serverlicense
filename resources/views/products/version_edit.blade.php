@extends('layouts.app')

@section('title', 'Chỉnh sửa phiên bản')

@section('content')
<div class="row">
    <div class="col-lg-12">
        @include('common.alert')
    </div>
</div>

<div class="row">
    <div class="col-lg-4" style="display: block; margin: 0 auto;">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('product.version.save', [ $version['id'] ]) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label for="">Phiên bản</label>
                        <input type="text" class="form-control" value="1.0.1" name="version" value="{{ $version['version'] }}">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="">Mô tả phiên bản (nếu có)</label>
                        <textarea name="description" class="form-control" placeholder="Cập nhật tính năng mới..." cols="30" rows="3">{{ $version['description'] }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">File cập nhật (nếu có)</label>
                        <input type="file" class="form-control" name="file">
                        <span class="text-danger">Không tải file lên nếu muốn giữ nguyên giá trị</span>
                    </div>

                    <div class="form-group mb-3">
                        <button class="btn btn-success" type="submit">
                            Lưu thay đổi
                        </button>
                    </div>
                </form>
                    
            </div>
        </div>
    </div>
</div>
@endsection