<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\License;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LicenseController extends Controller
{
    //
    
    public function index(Request $request)
    {
        $row = $request->input('row') ?? 15;

        if ($request->input('s')) {
            $licenses = License::where('customer', 'LIKE', '%'.$request->input('s').'%')->
            orWhere('product', 'LIKE', '%'.$request->input('s').'%')->
            orWhere('key', 'LIKE', '%'.$request->input('s').'%')->
            orWhere('duration', 'LIKE', '%'.$request->input('s').'%')->
            orWhere('fingerprint', 'LIKE', '%'.$request->input('s').'%')->
            orWhere('activated_at', 'LIKE', '%'.$request->input('s').'%')->
            orWhere('created_at', 'LIKE', '%'.$request->input('s').'%')->
            orderBy('id', 'desc')->paginate($row);
        } else {
            $licenses = License::orderBy('id', 'desc')->paginate($row);
        }

        return view('licenses.index', compact('licenses'));
    }
    
    public function viewAdd()
    {
        return view('licenses.add');
    }

    public function doAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product' => 'required|numeric',
            'customer' => 'required|numeric',
            'key' => 'required',
            'duration_value' => 'required|numeric',
            'duration_period' => 'required|in:seconds,minutes,hours,days,weeks,months,years'
        ]);

        if ($validator->fails()) {
            return redirect()->route('license.add')->withInput()->withErrors($validator);
        }

        $product = Product::where('id', $request->product)->first();
        $customer = Customer::where('id', $request->customer)->first();
        
        if (!License::where('key', $request->key)->where('activated_at', null)->exists()) {

            License::insert([
                'customer' => $customer,
                'product' => $product,
                'product_id' => $product['id'],
                'key' => $request->key,
                'duration' => $this->convertDuration($request->duration_value, $request->duration_period)
            ]);

            return redirect()->route('license.index')->with('success', 'Thêm giấy phép thành công!');

        } else {
            return redirect()->route('license.add')->withInput()->withErrors([
                'Mã kích hoạt đã tồn tại.'
            ]);
        }
    }

    public function convertDuration($value, $period)
    {
        $arr = array(
            'seconds' => $value,
            'minutes' => $value * 60,
            'hours' => $value * 3600,
            'days' => $value * 86400,
            'weeks' => $value * 604800,
            'months' => $value * 2630000,
            'years' => $value * 31557600,
        );

        return $arr[$period];
    }

    public function edit($id)
    {
        $license = License::where('id', $id)->first();

        if ($license) {
            return view('licenses.edit', compact('license'));
        } else {
            return abort(404);
        }

    }

    public function delete($id)
    {
        License::where('id', $id)->delete();
        return redirect()->route('license.index')->with('success', 'Xóa giấy phép thành công!');
    }
    
    public function save(Request $request, $id) 
    {
        $validator = Validator::make($request->all(), [
            'duration_value' => 'required|numeric',
            'duration_period' => 'required|in:seconds,minutes,hours,days,weeks,months,years'
        ]);

        if ($validator->fails()) {
            return redirect()->route('license.edit', [ $id ])->withInput()->withErrors($validator);
        }

        License::where('id', $id)->update([
            'duration' => $this->convertDuration($request->duration_value, $request->duration_period)
        ]);

        return redirect()->route('license.edit', [ $id ])->with('success', 'Đã lưu thay đổi thông tin giấy phép!');
    }
}
