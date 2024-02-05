<?php

namespace App\Http\Controllers\API\POS\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\API\SqlModel;

class AuthCountStockController extends BaseController
{
    
    protected $SqlModel;
    public function una_count_stock(Request $request){
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $arr=array('auth_count_list', $gb_user_branch,'');
        $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)',$arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function una_count_stock_view(Request $request,$id){
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $arr=array('una_count_by_id', $gb_user_branch,$id);
        $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)',$arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function una_count_stock_details(Request $request,$id){
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $arr=array('count_stock_details_id', $gb_user_branch,$id);
        $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)',$arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function auth_count_stock(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);
        $arr=array(
            $request->status,
            $gb_user_branch,
            $request->tran_code,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL pos_authorizer(?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function reject_count_stock(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            $request->status,
            $gb_user_branch,
            $request->tran_code,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL pos_reject_trans(?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }


}
