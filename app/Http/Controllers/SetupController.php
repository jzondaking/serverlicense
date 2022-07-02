<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SetupController extends Controller
{
    //

    public function saveSetup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'db_database' => 'required',
            'db_username' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        update_env([
            'DB_DATABASE' => $request->db_database,
            'DB_USERNAME' => $request->db_username,
            'DB_PASSWORD' => $request->db_password
        ]);

        return back();
    }

}
