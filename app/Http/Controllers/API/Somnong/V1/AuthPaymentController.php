<?php

namespace App\Http\Controllers\API\Somnong\V1;

use Illuminate\Http\Request;
use App\Models\API\SqlModel;
use App\Http\Controllers\API\BaseController as BaseController;

class AuthPaymentController extends BaseController
{
    //
    protected $SqlModel;
    public function una_somnong_payment(Request $request){
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $arr=array('auth_payment_list', $gb_user_branch,'');
        $results = $SqlModel->proc_get_data('CALL somnong_sql_get(?,?,?)',$arr);

        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function auth_payment_view( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL somnong_authorizer(?,?,?,?)', array('auth_payment_view',$gb_user_branch,$id,''));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }


    public function auth_somnong_payments(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            $request->status,
            $gb_user_branch,
            $request->payment_id,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL somnong_authorizer(?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }


    public function reject_somnong_payment(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            $request->status,
            $gb_user_branch,
            $request->payment_id,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL somnong_authorizer(?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

}
