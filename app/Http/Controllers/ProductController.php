<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //

    public function index(Request $request)
    {
        $row = $request->query('row') ?? 5;

        if ($request->query('s')) {
            $products = Product::where('id', 'LIKE', '%'.$request->query('s').'%')->
            orWhere('name', 'LIKE', '%'.$request->query('s').'%')->
            orWhere('description', 'LIKE', '%'.$request->query('s').'%')->
            orderBy('id', 'desc')->paginate($row);
        } else {
            $products = Product::orderBy('id', 'desc')->paginate($row);
        }

        return view('products.index', compact('products'));
    }

    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'version' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product.index')->withInput()->withErrors($validator);
        }
        
        if ($request->hasFile('file')) {
            $file = $request->file;
            $path = 'public';
            $filename = md5(time())."_".date('d_m_Y')."_".time().".".$file->extension();
            $request->file('file')->storeAs($path, $filename, 'local');
        } else {
            $filename = null;
        }

        $product = new Product;
        $product->name = $request->name;
        $product->description = (!$request->description) ? null : $request->description;
        $product->save();

        $product_id = $product->id;

        Version::insert([
            'product_id' => $product_id,
            'version' => $request->version,
            'description' => (!$request->version_description) ? null : $request->version_description,
            'file_url' => (!$filename) ? null : '/storage/'.$filename
        ]);

        return redirect()->route('product.index')->with('success', 'Thêm sản phẩm "'.$request->name.'" thành công!');
    }

    public function delete($id) 
    {
        Product::where('id', $id)->delete();
        Version::where('product_id', $id)->delete();

        return redirect()->route('product.index')->with('success', 'Xóa sản phẩm thành công!');
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();

        if ($product) {
            return view('products.edit', compact('product'));
        } else {
            return abort(404);
        }
    }

    public function save(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        Product::where('id', $id)->update([
            'name' => $request->name,
            'description' => (!$request->description) ? null : $request->description,
        ]);

        return back()->with('success', 'Đã lưu thay đổi thông tin sản phẩm!');
    }

    public function version_log($id)
    {
        $product = Product::where('id', $id)->first();

        if ($product) {
            $version_logs = Version::where('product_id', $id)->orderBy('id', 'desc')->paginate(5); 
            return view('products.version_log', compact('version_logs', 'product'));
        } else {
            return abort(404);
        }
    }

    public function addVersion(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'version' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        
        if ($request->hasFile('file')) {
            $file = $request->file;
            $path = 'public';
            $filename = md5(time())."_".date('d_m_Y')."_".time().".".$file->extension();
            $request->file('file')->storeAs($path, $filename, 'local');
        } else {
            $filename = null;
        }

        Version::insert([
            'product_id' => $id,
            'version' => $request->version,
            'description' => (!$request->description) ? null : $request->description,
            'file_url' => (!$filename) ? null : '/storage/'.$filename
        ]);

        return back()->with('success', 'Thêm phiên bản mới "'.$request->version.'" thành công!');
    }

    public function editVersion($id)
    {
        $version = Version::where('id', $id)->first();

        if ($version) {
            return view('products.version_edit', compact('version'));
        } else {
            return abort(404);
        }
    }

    public function deleteVersion($id)
    {
        Version::where('id', $id)->delete();
        return back()->with('success', 'Xóa phiên bản thành công!');
    }

    public function saveVersion(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'version' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        
        if ($request->hasFile('file')) {
            $file = $request->file;
            $path = 'public';
            $filename = md5(time())."_".date('d_m_Y')."_".time().".".$file->extension();
            $request->file('file')->storeAs($path, $filename, 'local');
        } else {
            $filename = null;
        }

        if (!$filename) {
            Version::where('id', $id)->update([
                'version' => $request->version,
                'description' => (!$request->description) ? null : $request->description
            ]);
        } else {
            Version::where('id', $id)->update([
                'version' => $request->version,
                'description' => (!$request->description) ? null : $request->description,
                'file_url' => '/storage/'.$filename
            ]);
        }

        return back()->with('success', 'Đã lưu thay đổi thông tin phiên bản!');
    }
}
