<?php

namespace App\Http\Controllers\API\Somnong\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\API\SqlModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Response;

class SomnongStaffController extends BaseController
{
    //
    protected $SqlModel;
    public function getStaff(Request $request){

        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $arr=array('getStaff', $gb_user_branch,'');
        $results = $SqlModel->proc_get_data('CALL somnong_sql_get(?,?,?)',$arr);

        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function staff_byId( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL somnong_sql_get(?,?,?)', array('staff_by_id',$gb_user_branch,$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }
    
    public function create_staff(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);
        $_dob = date("Y-m-d H:i:s",strtotime($request->DOB));
        
        $arr=array(
            $request->status,
            $request->staff_id,
            $gb_user_branch,
            $request->full_name,
            $request->position_id,
            $request->phone,
            $request->gender,
            $request->address_code,
            $request->active,
            $request->remark,
            Carbon::parse($_dob),
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL somnong_register_staff(?,?,?,?,?,?,?,?,?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
        
    }


}
