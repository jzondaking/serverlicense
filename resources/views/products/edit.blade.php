@extends('layouts.app')

@section('title', 'Chỉnh sửa sản phẩm')

@section('content')
<div class="row">
    <div class="col-lg-12">
        @include('common.alert')
    </div>
</div>

<div class="row">
    <div class="col-lg-6" style="display: block; margin: 0 auto;">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('product.save', [ $product['id'] ]) }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" value="{{ $product['name'] }}">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="">Mô tả</label>
                        <textarea name="description" class="form-control" cols="30" rows="3">{{ $product['description'] }}</textarea>
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