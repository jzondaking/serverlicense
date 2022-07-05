<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\License;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LicenseController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->all();
        $licenses = License::query()->orderByDesc('id');

        search_by_cols($licenses, $request->input('s'), [
            'customer', 'product', 'key', 'duration', 'fingerprint', 'activated_at', 'created_at',
        ]);

        $licenses = paginate_with_params($licenses, $params);

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

        if (License::where('key', $request->key)->where('activated_at', null)->exists()) {
            return redirect()->route('license.add')->withInput()->withErrors([
                'Mã kích hoạt đã tồn tại.'
            ]);
        }

        License::create([
            'customer' => $customer,
            'product' => $product,
            'product_id' => $product['id'],
            'key' => $request->key,
            'duration' => $this->convertDuration($request->duration_value, $request->duration_period)
        ]);

        return redirect()->route('license.index')->with('success', 'Thêm giấy phép thành công!');
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
        $license = License::where('id', $id)->firstOrFail();

        return view('licenses.edit', compact('license'));
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
            return redirect()->route('license.edit', [$id])->withInput()->withErrors($validator);
        }

        License::where('id', $id)->update([
            'duration' => $this->convertDuration($request->duration_value, $request->duration_period)
        ]);

        return redirect()->route('license.edit', [$id])->with('success', 'Đã lưu thay đổi thông tin giấy phép!');
    }
}
