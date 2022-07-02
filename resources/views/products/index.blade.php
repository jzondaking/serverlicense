@extends('layouts.app')

@section('title', 'Sản phẩm')

@section('content')
<div class="row">
    <div class="col-lg-12">
        @include('common.alert')
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('product.add') }}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="">Mô tả sản phẩm (nếu có)</label>
                        <textarea name="description" class="form-control" cols="30" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <hr>

                    <div class="form-group mb-3">
                        <label for="">Phiên bản</label>
                        <input type="text" class="form-control" name="version" placeholder="1.0.0" value="{{ old('version') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Mô tả phiên bản (nếu có)</label>
                        <textarea name="version_description" placeholder="Fix lỗi lặt vặt..." class="form-control" cols="30" rows="3">{{ old('version_description') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">File cập nhật (nếu có)</label>
                        <input type="file" class="form-control" name="file">
                    </div>

                    <div class="form-group mb-3">
                        <button class="btn btn-success" type="submit">
                            <i class="mdi mdi-plus me-2"></i> Thêm sản phẩm
                        </button>
                    </div>
                </form>
                    
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                @include('common.table_tools')

                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th width="1%">ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Mô tả</th>
                                <th>Phiên bản HT</th>
                                <th>Thời gian thêm</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>
                                    <b>{{ $product['id'] }}</b>
                                </td>
                                <td>
                                    {{ $product['name'] }}
                                </td>
                                <td>
                                    <textarea class="form-control" cols="30" rows="2" readonly>{{ $product['description'] }}</textarea>
                                </td>
                                <td>
                                    <span class="badge badge-soft-success" style="font-weight: bold;">
                                        {{ App\Models\Version::where('product_id', $product['id'])->orderBy('id', 'desc')->first()['version'] ?? 'Không có' }}
                                    </span>
                                    <br>
                                    <span class="badge badge-soft-warning">
                                        <a href="{{ App\Models\Version::where('product_id', $product['id'])->orderBy('id', 'desc')->first()['file_url'] ?? '#' }}">
                                            <i class="fas fa-cloud-download-alt"></i>
                                            TẢI XUỐNG FILE
                                        </a>
                                    </span>
                                </td>
                                <td>
                                    {{ Carbon\Carbon::parse($product['created_at'])->format('d/m/Y H:i:s') }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('product.version_log', [ $product['id'] ]) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Phiên bản">
                                            <i class="fas fa-history"></i>
                                        </a>
                                        <a href="{{ route('product.edit', [ $product['id'] ]) }}" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Chỉnh sửa">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="{{ route('product.delete', [ $product['id'] ]) }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Xóa sản phẩm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {!! $products->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection