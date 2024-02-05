<?php

namespace App\Http\Controllers\API\Admin\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\API\SqlModel;
use Illuminate\Support\Facades\Storage;
use Response;

class UsersController extends BaseController
{
    //
    protected $SqlModel;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Loggedin(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_branch = $SqlModel->gb_user_branch($request);
        $gb_user_id = $SqlModel->gb_user_id($request);
        $arr = array('user_logged', $gb_user_branch, $gb_user_id);
        $results = $SqlModel->proc_get_data('CALL gb_sql_get(?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function create_user(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_email = $SqlModel->gb_user_email($request);
        $gb_user_branch = $SqlModel->gb_user_branch($request);

        $arr = array(
            $request->status,
            $gb_user_branch,
            $request->id,
            $request->username,
            $request->fullname,
            $request->phone,
            $request->address,
            $gb_user_email
        );

        try {
            $results = $SqlModel->proc_get_data('CALL proc_verify_user(?,?,?,?,?,?,?,?)', $arr);
            return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
        } catch (\PDOException $e) {
            $SqlModel->his_Activity('Error Exception', $arr, '404');
            return $this->sendError($e->errorInfo[2], $e->errorInfo);
        }
    }

    public function user_upload_image(Request $request)
    {
        try {
            $SqlModel = new SqlModel();
            $gb_user_email = $SqlModel->gb_user_email($request);
            $gb_user_branch = $SqlModel->gb_user_branch($request);
            $gb_user_id = $SqlModel->gb_user_id($request);

            $filename = $gb_user_branch . '-' . time() . rand(1, 100) . '.' . $request->image->getClientOriginalExtension();
            $extension = '.' . $request->image->getClientOriginalExtension();
            Storage::disk('public')->put('profile/' . $filename, file_get_contents($request->image));

            $arr = array(
                'upload',
                $gb_user_branch,
                $gb_user_id,
                $filename,
                $request->description,
                $extension,
                $gb_user_email
            );
            $results = $SqlModel->proc_get_data('CALL proc_upload_image_user(?,?,?,?,?,?,?)', $arr);
            return $this->sendResponse($results, 'Upload image succeed .');
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ], 500);
        }
    }

    public function getImageAttribute($value)
    {
        return env('APP_URL') . Storage::url($value);
    }
    public function user_profile_image($filename)
    {
        $data = array(
            [
                'id' => $filename,
                'url' => env('APP_URL') . Storage::url('profile/' . $filename)
            ]
        );
        return $this->sendResponse($data, 'Retrieved image Url');
    }
}
