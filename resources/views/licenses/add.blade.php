@extends('layouts.app')

@section('title', 'Giấy phép')

@section('headerAddition')
<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">
@endsection

@section('footerAddition')
<script src="/assets/libs/select2/js/select2.min.js"></script>
@endsection

@section('content')
<div class="row">

    <div class="col-lg-12">
        @include('common.alert')
    </div>

    <div class="col-lg-8" style="display: block; margin: 0 auto;">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('license.do_add') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="">Sản phẩm</label>
                                <select class="form-control" name="product">
                                    <option>-- CHỌN SẢN PHẨM --</option>
            
                                    @foreach (App\Models\Product::all() as $product)
                                    <option value="{{ $product['id'] }}">{{ $product['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="">
                                    Khách hàng 
                                    <a href="{{ route('customer.add') }}">
                                        <i class="fas fa-plus-circle"></i>
                                    </a>
                                </label>
                                <select class="form-control" name="customer">
                                    <option>-- CHỌN KHÁCH HÀNG --</option>
            
                                    @foreach (App\Models\Customer::all() as $customer)
                                    <option value="{{ $customer['id'] }}">{{ $customer['fullname'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-8">
                            <div class="form-group mb-3">
                                <label for="">Mã kích hoạt</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="key" placeholder="Nhập mã kích hoạt tùy chọn">
                                    <div class="input-group-append">
                                        <a class="btn btn-outline-danger" onclick="generateLicenseKey()">
                                            <i class="fas fa-key"></i> Tạo mã tự động
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="">Thời hạn</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="duration_value" placeholder="Nhập giá trị thời hạn">
                                    <div class="input-group-append">
                                        <select class="form-control" name="duration_period">
                                            <option value="seconds">Giây</option>
                                            <option value="minutes">Phút</option>
                                            <option value="hours">Giờ</option>
                                            <option value="days">Ngày</option>
                                            <option value="weeks">Tuần</option>
                                            <option value="months">Tháng</option>
                                            <option value="years">Năm</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <hr>

                    <button class="btn btn-success" type="submit">
                        <i class="mdi mdi-plus me-2"></i> Thêm giấy phép
                    </button>
                </form>
            </div>
        </div>
    </div>
    
</div>

<script>
    $(function() {
        $('select[name="product"]').select2()
        $('select[name="customer"]').select2()
    });

    function getRandomInt( min, max ) {
         return Math.floor( Math.random() * ( max - min + 1 ) ) + min;
    }
    
	function getRandomInt( min, max ) {
         return Math.floor( Math.random() * ( max - min + 1 ) ) + min;
    }
    
	function generateLicenseKey() {
		var tokens = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
			chars = 5,
			segments = 5,
			keyString = "";
			
		for( var i = 0; i < segments; i++ ) {
			var segment = "";
			
			for( var j = 0; j < chars; j++ ) {
			    var k = getRandomInt( 0, 35 );
				segment += tokens[ k ];
			}
			
			keyString += segment;
			
			if( i < ( segments - 1 ) ) {
				keyString += "-";
			}
		}
		
		$('input[name="key"]').val(keyString)
	}
</script>
@endsection