<?php

namespace App\Http\Controllers\API\POS\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\API\SqlModel;

class CountStockController extends BaseController
{
    protected $SqlModel;
    public function create_count_stock(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            $request->status,
            $request->tran_code,
            $gb_user_branch,
            $request->stc_code,
            $request->remark,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL pos_register_count_stock(?,?,?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function create_count_stock_details(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            $request->status,
            $request->tran_code,
            $gb_user_branch,
            $request->pro_code,
            $request->barcode,
            $request->qty,
            $request->remark);
        $results = $SqlModel->proc_get_data('CALL pos_register_count_stock_details(?,?,?,?,?,?,?)', $arr);
        return $this->sendResponse($results,$SqlModel->gb_msg_retrieved());
    }

    public function una_count_combo(Request $request){

        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $arr=array('una_count_list', $gb_user_branch,'');
        $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)',$arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function una_count_stock_batch( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)', array('count_stock_details_id',$gb_user_branch,$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function una_count_stock_by_id( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)', array('una_count_by_id',$gb_user_branch,$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function una_count_stock_sysdoc( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)', array('una_count_stock_sysdoc',$gb_user_branch,$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }



}
