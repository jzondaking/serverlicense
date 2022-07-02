<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\License;
use App\Models\Product;
use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    //

    public function License(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "ok" => false,
                "message" => "VALIDATION_FAILED",
                "errors" => $validator->errors()
            ]);
        }

        $license = License::where('key', $request->key)->first();

        if ($license) {

            if ($license['activated_at'] !== null && (time() - Carbon::parse($license['activated_at'])->getTimestamp()) >= $license['duration']) {
                return response()->json([
                    "ok" => false,
                    "message" => "EXPIRED_LICENSE"
                ]);
            }

            if (!$license['activated_at']) {
                $fingerprint = array(
                    'ip' => $request->ip(),
                    'useragent' => $request->header('user-agent')
                );

                License::where('key', $request->key)->update([
                    'fingerprint' => $fingerprint,
                    'activated_at' => Carbon::now()
                ]);
            }

            return response()->json([
                "ok" => true,
                "message" => "VALID_LICENSE",
                "data" => $license
            ]);
            

        } else {
            return response()->json([
                "ok" => false,
                "message" => "INVALID_LICENSE"
            ]);
        }
    }

    public function product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "ok" => false,
                "message" => "VALIDATION_FAILED",
                "errors" => $validator->errors()
            ]);
        }

        $product = Product::where('id', $request->id)->first();

        if ($product) {

            $versions = Version::where('product_id', $request->id)->orderBy('id', 'desc')->get();

            return response()->json([
                "ok" => true,
                "message" => "SUCCESS",
                "data" => array(
                    "product" => $product,
                    "lastest_version" => $versions[0] ?? null,
                    "versions" => $versions
                )
            ]);

        } else {
            return response()->json([
                "ok" => false,
                "message" => "PRODUCT_NOT_FOUND",
            ]);
        }
    }

}
