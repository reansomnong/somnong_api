<?php

namespace App\Http\Controllers\API\Setting\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\API\SqlModel;

class PermissionController extends BaseController
{
    //
    protected $SqlModel;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function permission_menu($id)
    {
        $SqlModel = new SqlModel();
        $results = $SqlModel->proc_get_data('CALL gb_sql_get(?,?,?)', array($id,'',$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function permission_sub($id)
    {
        $SqlModel = new SqlModel();
        $results = $SqlModel->proc_get_data('CALL gb_sql_get(?,?,?)', array('permission_sub','',$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());

    }

    public function permission_refresh(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $arr=array(
                    $request->id,
                    $request->index,
                    $gb_user_name);
        $results = $SqlModel->proc_get_data('CALL proc_refresh_left_menu(?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function gb_profile_system(Request $request,$id)
    {
        $SqlModel = new SqlModel();
        $results = $SqlModel->proc_get_data('CALL gb_get_combo(?,?,?)', array('profile','',$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function gb_main_menu(Request $request)
    {
        $SqlModel = new SqlModel();
        $results = $SqlModel->proc_get_data('CALL gb_get_combo(?,?,?)', array('main_menu_active','',''));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function create_permission(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);

        $arr=array(
            "main",
            $request->system_id,
            $request->profile_id,
            $request->menu_id,
            $gb_user_name);
            
        $results = $SqlModel->proc_get_data('CALL proc_add_system_menu(?,?,?,?,?)', $arr);

        foreach ($request->sub_menu as $k => $menu_id) {
            $arr_sub=array(
                $request->status,
                $request->system_id,
                $request->profile_id,
                $menu_id,
                $gb_user_name);
                
                $SqlModel->proc_get_data('CALL proc_add_system_menu(?,?,?,?,?)', $arr_sub);
        }

        $arr_refresh=array(
            $request->system_id,
            $request->profile_id);
        $SqlModel->proc_get_data('CALL proc_refresh_permission(?,?)', $arr_refresh);
        
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
        
    }

    public function permission(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $results=[];

        if ($request->active==true) {

            $arr=array(
                "main",
                $request->system_id,
                $request->profile_id,
                $request->menu_id,
                $gb_user_name);
            $SqlModel->proc_get_data('CALL proc_add_system_menu(?,?,?,?,?)', $arr);

            $arr_sub=array(
                "sub",
                $request->system_id,
                $request->profile_id,
                $request->sub_menu_id,
                $gb_user_name);
            $results = $SqlModel->proc_get_data('CALL proc_add_system_menu(?,?,?,?,?)', $arr_sub);
            
        }else{
            $arr_delete=array(
                "delete",
                $request->system_id,
                $request->profile_id,
                $request->sub_menu_id,
                $gb_user_name);
            $results = $SqlModel->proc_get_data('CALL proc_delete_permission(?,?,?,?,?)', $arr_delete);
        }

        $arr_refresh=array(
            $request->system_id,
            $request->profile_id);
        $SqlModel->proc_get_data('CALL proc_refresh_permission(?,?)', $arr_refresh);
        
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
        
    }

}
