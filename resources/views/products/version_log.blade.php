@extends('layouts.app')

@section('title', 'Phiên bản')

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
                <form action="{{ route('product.version.add', [ $product['id'] ]) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    
                    <div class="form-group mb-3">
                        <label for="">Phiên bản</label>
                        <input type="text" class="form-control" placeholder="1.0.1" name="version" value="{{ old('version') }}">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="">Mô tả phiên bản (nếu có)</label>
                        <textarea name="description" class="form-control" placeholder="Cập nhật tính năng mới..." cols="30" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">File cập nhật (nếu có)</label>
                        <input type="file" class="form-control" name="file">
                    </div>

                    <div class="form-group mb-3">
                        <button class="btn btn-success" type="submit">
                            <i class="mdi mdi-plus me-2"></i> Thêm phiên bản mới
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
                                <th>Phiên bản</th>
                                <th>Mô tả</th>
                                <th>File cập nhật</th>
                                <th>Thời gian thêm</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($version_logs as $v_log)
                            <tr>
                                <td>
                                    <b>{{ $v_log['id'] }}</b>
                                </td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ $v_log['version'] }}
                                    </span>
                                </td>
                                <td>
                                    <textarea class="form-control" cols="30" rows="2" readonly>{{ $v_log['description'] }}</textarea>
                                </td>
                                <td>
                                    <span class="badge badge-soft-warning">
                                        <a href="{{ $v_log['file_url'] }}">
                                            <i class="fas fa-cloud-download-alt"></i>
                                            TẢI XUỐNG FILE
                                        </a>
                                    </span>
                                </td>
                                <td>
                                    {{ Carbon\Carbon::parse($v_log['created_at'])->format('d/m/Y H:i:s') }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('product.version.edit', [ $v_log['id'] ]) }}" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Chỉnh sửa">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="{{ route('product.version.delete', [ $v_log['id'] ]) }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Xóa hồ sơ">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {!! $version_logs->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection