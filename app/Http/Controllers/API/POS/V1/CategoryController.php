<?php

namespace App\Http\Controllers\API\POS\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\API\SqlModel;
class CategoryController extends BaseController
{
    protected $SqlModel;
    public function create_category(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            $request->status,
            $request->lin_code,
            $gb_user_branch,
            $request->parent_id,
            $request->lin_name,
            $request->remark,
            $request->active,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL pos_register_category(?,?,?,?,?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }


    public function pos_category(Request $request){
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $arr=array('category', $gb_user_branch,'');
        $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)',$arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function view_category( Request $request,$id)
    {
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);

        $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)', array('view_category',$gb_user_branch,$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }
}
