<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //

    public function index(Request $request)
    {
        $row = $request->query('row') ?? 10;

        if ($request->query('s')) {
            $customers = Customer::where('id', 'LIKE', '%'.$request->query('s').'%')->
            orWhere('fullname', 'LIKE', '%'.$request->query('s').'%')->
            orWhere('gender', 'LIKE', '%'.$request->query('s').'%')->
            orWhere('dob', 'LIKE', '%'.$request->query('s').'%')->
            orWhere('phone', 'LIKE', '%'.$request->query('s').'%')->
            orWhere('email', 'LIKE', '%'.$request->query('s').'%')->
            orWhere('note', 'LIKE', '%'.$request->query('s').'%')->
            orWhere('created_at', 'LIKE', '%'.$request->query('s').'%')->
            orWhere('updated_at', 'LIKE', '%'.$request->query('s').'%')->
            orderBy('id', 'desc')->paginate($row);
        } else {
            $customers = Customer::orderBy('id', 'desc')->paginate($row);
        }

        return view('customers.index', compact('customers'));
    }

    public function viewAdd() 
    {
        return view('customers.add');
    }

    public function doAdd(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'gender' => 'required|in:male,female,unknown'
        ]);

        if ($validator->fails()) {
            return redirect()->route('customer.add')->withInput()->withErrors($validator);
        }

        Customer::insert([
            "fullname" => $request->fullname,
            "gender" => $request->gender,
            "dob" => (empty($request->dob)) ? null : Carbon::parse($request->dob)->format('Y-m-d'),
            "phone" => (empty($request->phone)) ? null : $request->phone,
            "email" => (empty($request->email)) ? null : $request->email,
            "note" => (empty($request->note)) ? null : $request->note
        ]);

        return redirect()->route('customer.index')->with('success', 'Thêm khách hàng "'.$request->fullname.'" thành công!');
    }

    public function customerProfile($id)
    {
        $customer = Customer::firstWhere('id', $id);

        if (!$customer) {
            return redirect()->route('customer.index')->withErrors([
                "Không tìm thấy hồ sơ khách hàng :("
            ]);
        } else {
            return view('customers.profile', compact('customer'));
        }
    }

    public function delete($id)
    {
        $customer = Customer::firstWhere('id', $id);

        if (!$customer) {
            return redirect()->route('customer.index')->withErrors([
                "Không tìm thấy hồ sơ khách hàng :("
            ]);
        } else {
            $customer->delete();
            return redirect()->route('customer.index')->with('success', 'Xóa hồ sơ khách hàng thành công!');
        }
    }

    public function edit($id)
    {
        $customer = Customer::firstWhere('id', $id);

        if (!$customer) {
            return redirect()->route('customer.index')->withErrors([
                "Không tìm thấy hồ sơ khách hàng :("
            ]);
        } else {
            return view('customers.edit', compact('customer'));
        }
    }

    public function save($id, Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'gender' => 'required|in:male,female,unknown'
        ]);

        if ($validator->fails()) {
            return redirect()->route('customer.edit')->withErrors($validator);
        }

        Customer::where('id', $id)->update([
            "fullname" => $request->fullname,
            "gender" => $request->gender,
            "dob" => (empty($request->dob)) ? NULL : $request->dob,
            "phone" => (empty($request->phone)) ? NULL : $request->phone,
            "email" => (empty($request->email)) ? NULL : $request->email,
            "note" => (empty($request->note)) ? NULL : $request->note
        ]);

        return redirect()->route('customer.index')->with('success', 'Lưu thông tin khách hàng "'.$request->fullname.'" thành công!');
    }

}
