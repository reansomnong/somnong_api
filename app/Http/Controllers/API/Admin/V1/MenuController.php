<?php

namespace App\Http\Controllers\API\Admin\V1;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Menu\MenuResource;
use App\Http\Resources\Menu\MenuCollection;
use App\Http\Resources\Setting\SystemCollection;
use App\Http\Resources\Setting\Systems;
use App\Models\API\SqlModel;
use App\Models\System;

class MenuController extends BaseController
{
    //
    protected $SqlModel;
    public function index(Request $request)
    {
        $SqlModel = new SqlModel();
        $system_id=$SqlModel->gb_user_system($request);
        $profile_id=$SqlModel->gb_profile_id($request);
        
        if($profile_id=='1'){
            $menus = Menu::whereNull('parent_id')->where('active', '1') ->with('subMenu', function($q){ return $q->where('active', '1')->orderByRaw('ISNULL(ordering), ordering asc'); })->orderByRaw('ISNULL(ordering), ordering asc')->get();
        }
        else if ($system_id=='1') {
            $menus = Menu::select("menus.*")
            ->join("permissioncoffee", "menus.id", "=", "permissioncoffee.menu_id")
            ->where('menus.active', '1')
            ->where('permissioncoffee.system_id', $system_id)
            ->where('permissioncoffee.profile_id', $profile_id)
            ->where('menus.parent_id', null)
            ->with('subMenu', function($q) use($profile_id) { 
                return 
                    $q
                    ->join('permissioncoffee', 'permissioncoffee.menu_id', '=', 'menus.id')
                    ->where('permissioncoffee.profile_id',$profile_id)
                    ->where('active', 1);
            })
            ->orderByRaw('ISNULL(ordering), ordering asc')
            ->get();
        }
        else if ($system_id=='2') {
            $menus = Menu::select("menus.*")
            ->join("permissionpos", "menus.id", "=", "permissionpos.menu_id")
            ->where('menus.active', '1')
            ->where('permissionpos.system_id', $system_id)
            ->where('permissionpos.profile_id', $profile_id)
            ->where('menus.parent_id', null)
            ->with('subMenu', function($q) use($profile_id) { 
                return 
                    $q
                    ->join('permissionpos', 'permissionpos.menu_id', '=', 'menus.id')
                    ->where('permissionpos.profile_id',$profile_id)
                    ->where('active', 1);
            })
            ->orderByRaw('ISNULL(ordering), ordering asc')
            ->get();
        }
        else if ($system_id=='3') {
            $menus = Menu::select("menus.*")
            ->join("permissioncarstore", "menus.id", "=", "permissioncarstore.menu_id")
            ->where('menus.active', '1')
            ->where('permissioncarstore.system_id', $system_id)
            ->where('permissioncarstore.profile_id', $profile_id)
            ->where('menus.parent_id', null)
            ->with('subMenu', function($q) use($profile_id) { 
                return 
                    $q
                    ->join('permissioncarstore', 'permissioncarstore.menu_id', '=', 'menus.id')
                    ->where('permissioncarstore.profile_id',$profile_id)
                    ->where('active', 1);
            })
            ->orderByRaw('ISNULL(ordering), ordering asc')
            ->get();
        }
        else if ($system_id=='4') {
            $menus = Menu::select("menus.*")
            ->join("permissionrealestate", "menus.id", "=", "permissionrealestate.menu_id")
            ->where('menus.active', '1')
            ->where('permissionrealestate.system_id', $system_id)
            ->where('permissionrealestate.profile_id', $profile_id)
            ->where('menus.parent_id', null)
            ->with('subMenu', function($q) use($profile_id) { 
                return 
                    $q
                    ->join('permissionrealestate', 'permissionrealestate.menu_id', '=', 'menus.id')
                    ->where('permissionrealestate.profile_id',$profile_id)
                    ->where('active', 1);
            })
            ->orderByRaw('ISNULL(ordering), ordering asc')
            ->get();
        }
        else if ($system_id=='5') {
            $menus = Menu::select("menus.*")
            ->join("permissionhospital", "menus.id", "=", "permissionhospital.menu_id")
            ->where('menus.active', '1')
            ->where('permissionhospital.system_id', $system_id)
            ->where('permissionhospital.profile_id', $profile_id)
            ->where('menus.parent_id', null)
            ->with('subMenu', function($q) use($profile_id) { 
                return 
                    $q
                    ->join('permissionhospital', 'permissionhospital.menu_id', '=', 'menus.id')
                    ->where('permissionhospital.profile_id',$profile_id)
                    ->where('active', 1);
            })
            ->orderByRaw('ISNULL(ordering), ordering asc')
            ->get();
        }

        else if ($system_id=='6') {
            $menus = Menu::select("menus.*")
            ->join("permissionsomnong", "menus.id", "=", "permissionsomnong.menu_id")
            ->where('menus.active', '1')
            ->where('permissionsomnong.system_id', $system_id)
            ->where('permissionsomnong.profile_id', $profile_id)
            ->where('menus.parent_id', null)
            ->with('subMenu', function($q) use($profile_id) { 
                return 
                    $q
                    ->join('permissionsomnong', 'permissionsomnong.menu_id', '=', 'menus.id')
                    ->where('permissionsomnong.profile_id',$profile_id)
                    ->where('active', 1);
            })
            ->orderByRaw('ISNULL(ordering), ordering asc')
            ->get();
        }
        return $this->sendResponse(MenuResource::collection($menus),'Retrieved menu');
    }

    public function system_list(Request $request)
    {
        $system = System::where('active', '1')->get();
        return $this->sendResponse(Systems::collection($system),'Retrieved menu');
    }

    public function menu_by_system($id)
    {
        $SqlModel = new SqlModel();
        $results = $SqlModel->proc_get_data('CALL gb_sql_get(?,?,?)',
                              array('system_menu','',$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function get_sub_menu_list($id)
    {
        $SqlModel = new SqlModel();
        $results = $SqlModel->proc_get_data('CALL gb_sql_get(?,?,?)',
                              array('get_sub_menu','',$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function sub_menu_list(Request $request,$system_id,$profile_id,$menu_id)
    {
        //return array('get_permission',$system_id,$profile_id,$menu_id,'');
        $SqlModel = new SqlModel();
        $results = $SqlModel->proc_get_data('CALL _sql_get_multi(?,?,?,?,?)',
                              array('get_permission',$system_id,$profile_id,$menu_id,''));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function get_main_menu(Request $request)
    {
        $SqlModel = new SqlModel();
        $results = $SqlModel->proc_get_data('CALL gb_get_combo(?,?,?)', array('main_menu','', ''));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function create_left_menu(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);

        $arr=array(
                    $request->status,
                    $request->id,
                    $request->parent_id,
                    $request->icon,
                    $request->page_name,
                    $request->title,
                    $request->active,
                    $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL proc_add_left_menu(?,?,?,?,?,?,?,?)', $arr);

        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function get_left_menu(Request $request)
    {
        $SqlModel = new SqlModel();
        $results = $SqlModel->proc_get_data('CALL gb_sql_get(?,?,?)',
                              array('left_menu_list','',''));

        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function get_left_menu_byId( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $results = $SqlModel->proc_get_data('CALL gb_sql_get(?,?,?)', array('get_menu_by_id','',$id));

        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    // add_permission_menu
    public function add_permission_menu(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        
        $arr=array(
                    $request->status,
                    $request->system_id,
                    $request->profile_id,
                    $request->menu_id,
                    $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL proc_add_system_menu(?,?,?,?,?)', $arr);

        $arr_refresh=array(
            $request->system_id,
            $request->profile_id);
        $SqlModel->proc_get_data('CALL proc_refresh_permission(?,?)', $arr_refresh);
        
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
        
    }

     // add_permission_menu
     public function delete_permission(Request $request)
     {
         $SqlModel = new SqlModel();
         $gb_user_name=$SqlModel->gb_user_email($request);
         $arr=array(
                     $request->status,
                     $request->menu_id,
                     $request->system_id,
                     $gb_user_name);
 
         $results = $SqlModel->proc_get_data('CALL proc_delete_permission(?,?,?,?)', $arr);
         return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
     }



}
