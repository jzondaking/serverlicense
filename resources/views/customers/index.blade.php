@extends('layouts.app')

@section('title', 'Khách hàng')

@section('content')
<div class="row">

    <div class="col-lg-12">
        @include('common.alert')
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                @section('button')
                <a href="{{ route('customer.add') }}" class="btn btn-success mb-2" style="width: 100%;">
                    <i class="mdi mdi-plus me-2"></i> Thêm khách hàng
                </a>
                @endsection

                @include('common.table_tools')

                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                {{-- <th width="1%">#</th> --}}
                                <th>ID</th>
                                <th width="1%">Họ và tên</th>
                                <th>Giới tính</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ email</th>
                                <th>Thời gian thêm</th>
                                <th width="1%">Hành động</th>
                            </tr>
                        </thead>

                        @php
                            function displayData($data, $data_) {
                                if (!$data) {
                                    return '<span class="badge badge-soft-danger">Không có</span>';
                                } else {
                                    return $data_;
                                }
                            }
                        @endphp
                        
                        <tbody>
                            @foreach ($customers as $customer)
                            <tr>
                                {{-- <td>
                                    <input class="form-check-input" type="checkbox">
                                </td> --}}
                                <td>
                                    <b>{{ $customer['id'] }}</b>
                                </td>
                                <td>
                                    <input type="text" value="{{ $customer['fullname'] }}" readonly>
                                </td>
                                <td>
                                    @if ($customer['gender'] == 'male')
                                    <span class="badge badge-soft-info">Nam</span>
                                    @elseif ($customer['gender'] == 'female')
                                    <span class="badge badge-soft-danger">Nữ</span>
                                    @else
                                    <span class="badge badge-soft-warning">Không XĐ</span>
                                    @endif
                                </td>
                                <td>
                                    {!! displayData($customer['phone'], '<span class="badge badge-soft-warning">'.$customer['phone'].'</span>') !!}
                                </td>
                                <td>
                                    {!! displayData($customer['email'], '<input type="text" value="'.$customer['email'].'" style="width: 100%" readonly>') !!}
                                </td>
                                <td>
                                    {{ Carbon\Carbon::parse($customer['created_at'])->format('d/m/Y H:i:s') }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('customer.profile', [ $customer['id'] ]) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Xem hồ sơ">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('customer.edit', [ $customer['id'] ]) }}" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Chỉnh sửa">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="{{ route('customer.delete', [ $customer['id'] ]) }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Xóa hồ sơ">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {!! $customers->links() !!}
            </div>
        </div>
    </div>
    
</div>
@endsection