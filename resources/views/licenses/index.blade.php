@extends('layouts.app')

@section('title', 'Giấy phép')

@section('content')
<div class="row">

    <div class="col-lg-12">
        @include('common.alert')
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                @section('button')
                <a href="{{ route('license.add') }}" class="btn btn-success mb-2" style="width: 100%;">
                    <i class="mdi mdi-plus me-2"></i> Thêm giấy phép
                </a>
                @endsection

                @include('common.table_tools')

                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th width="1%">Sản phẩm</th>
                                <th width="1%">Khách hàng</th>
                                <th width="1%">Mã giấy phép</th>
                                <th>Thời hạn</th>
                                <th>Kích hoạt</th>
                                <th>Fingerprint</th>
                                <th>Thời gian thêm</th>
                                <th width="1%">Hành động</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($licenses as $license)

                            @php
                                $customer_data = json_decode($license['customer'], true);    
                                $product_data = json_decode($license['product'], true);

                                if ($license['fingerprint'] !== null) {
                                    $fingerprint_data = json_decode($license['fingerprint'], true);
                                }
                            @endphp

                            <tr>
                                <td>
                                    <b>{{ $license['id'] }}</b>
                                </td>
                                <td>
                                    <span class="badge bg-dark">
                                        {{ $product_data['name'] }}
                                    </span>
                                </td>
                                <td>
                                    <input type="text" value="{{ $customer_data['fullname'] }}" readonly  data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Họ và tên: <b>{{ $customer_data['fullname'] }}</b><br>Số điện thoại: <b>{{ $customer_data['phone'] ?? 'Không có' }}</b><br>Email: <b>{{ $customer_data['email'] ?? 'Không có' }}</b><br><br><b><a href='{{ route('customer.profile', [ $customer_data['id'] ]) }}'>XEM HỒ SƠ KH</a></b>" data-bs-html="true">
                                </td>
                                <td>
                                    <input type="text" value="{{ $license['key'] }}" readonly>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ durationFormat($license['duration']) }}
                                    </span>
                                </td>
                                <td>
                                    @if (!$license['activated_at'])
                                    <span class="badge bg-danger">Chưa kích hoạt</span>
                                    @else
                                    <span class="badge bg-success">Đã kích hoạt</span> <br>
                                    <span class="badge bg-warning">{{ Carbon\Carbon::parse($license['activated_at'])->format('d/m/Y H:i:s') }}</span>
                                    @endif
                                </td>
                                <th>
                                    @if (!$license['fingerprint'])
                                    <span class="badge bg-danger">Không có dữ liệu</span>
                                    @else
                                    <button class="btn btn-primary btn-sm" onclick="Swal.fire({ 'title': 'Fingerprint Data', 'html': 'Địa chỉ IP: <b>{{ $fingerprint_data['ip'] }}</b><br>Useragent: <b>{{ $fingerprint_data['useragent'] }}</b>' })">
                                        <i class="fas fa-fingerprint"></i> XEM NGAY
                                    </button>
                                    @endif
                                </th>
                                <td>
                                    {{ Carbon\Carbon::parse($license['created_at'])->format('d/m/Y H:i:s') }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('license.edit', [ $license['id'] ]) }}" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Chỉnh sửa">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="{{ route('license.delete', [ $license['id'] ]) }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Xóa giấy phép">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {!! $licenses->links() !!}
            </div>
        </div>
    </div>
    
</div>
@endsection