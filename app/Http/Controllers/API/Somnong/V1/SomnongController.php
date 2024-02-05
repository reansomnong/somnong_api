<?php

namespace App\Http\Controllers\API\Somnong\V1;

use App\Http\Controllers\Controller;
use App\Models\API\SqlModel;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

class SomnongController extends BaseController
{
    //
    protected $SqlModel;

    public function combobox(Request $request,$id)
    {
        $SqlModel = new SqlModel();
        $gb_user_branch=$SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL pos_get_combo(?,?,?)', array($id,$gb_user_branch,''));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }
    public function somnongcombo(Request $request,$id)
    {
        $SqlModel = new SqlModel();
        $gb_user_branch = $SqlModel->gb_user_branch($request);

        $results = $SqlModel->proc_get_data('CALL gb_get_combo(?,?,?)', array($id,$gb_user_branch, ''));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }
}
