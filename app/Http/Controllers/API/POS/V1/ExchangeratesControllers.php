<?php

namespace App\Http\Controllers\API\POS\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\API\SqlModel;

class ExchangeratesControllers extends BaseController
{
    //
    protected $SqlModel;

    public function create_vat(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            $request->status,
            $request->sysdoc,
            $gb_user_branch,
            $request->amount,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL pos_register_vat(?,?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function list_vat(Request $request){

        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);

        $arr=array('getVAT', $gb_user_branch,'');
        $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)',$arr);

        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function create_base_exchange(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            $request->status,
            $request->currency_code,
            $gb_user_branch,
            $request->amount,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL pos_base_exchange(?,?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function create_exchange_rates(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            $request->status,
            $request->currency_code,
            $gb_user_branch,
            $request->sysdoc,
            $request->amount,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL pos_register_exchangerates(?,?,?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function list_currency(Request $request){

        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);

        $arr=array('getcurrency', $gb_user_branch,'');
        $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)',$arr);

        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }
}
