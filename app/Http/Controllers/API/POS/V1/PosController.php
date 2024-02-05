<?php

namespace App\Http\Controllers\API\POS\V1;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\API\SqlModel;
use Illuminate\Support\Facades\Storage;

class PosController extends BaseController
{
    protected $SqlModel;
    public function pos_combo(Request $request,$id)
    {
        $SqlModel = new SqlModel();
        $gb_user_branch=$SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL pos_get_combo(?,?,?)', array($id,$gb_user_branch,''));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function pos_currency(Request $request,$id)
    {
        $SqlModel = new SqlModel();
        $gb_user_branch=$SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL pos_get_combo(?,?,?)', array('subcurrency',$gb_user_branch,$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function una_point_of_sale( Request $request )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch=$SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL pos_sql(?,?,?)', array('una_point_of_sale',$gb_user_branch,''));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }
    public function una_pos_product( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch=$SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL pos_sql(?,?,?)', array('una_pos_product',$gb_user_branch,$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function una_pos_trans( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch=$SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL pos_sql(?,?,?)', array('una_pos',$gb_user_branch,$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function productById( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL pos_sql(?,?,?)', array('productById',$gb_user_branch,$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function una_pos_sysdoc( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL pos_sql(?,?,?)', array('una_pos_sysdoc',$gb_user_branch,$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function una_pos_details( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch=$SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL pos_sql(?,?,?)', array('una_pos_details',$gb_user_branch,$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function top_pos_by_category( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $pathImage= $SqlModel->gb_pos_product_image();
        $gb_url = env('APP_URL').Storage::url($pathImage);

        if($id=="All"){
            $results = $SqlModel->proc_get_data('CALL pos_sql(?,?,?)', array('top_pos',$gb_user_branch,$id));
        }
        else{
            $results = $SqlModel->proc_get_data('CALL pos_sql(?,?,?)', array('top_pos_by_category',$gb_user_branch,$id));
        }

        $arr = json_decode(json_encode($results), true);
        $product_info=[];
            for ($count = 0; $count < count($arr); $count++)
            {
                $product_info[$count] = array(
                  'pro_code'=>$arr[$count]['pro_code'],
                  'barcode'=>$arr[$count]['barcode'],
                  'pro_name'=>$arr[$count]['pro_name'],
                  'cost'=>$arr[$count]['cost'],
                  'unitprice'=>$arr[$count]['unitprice'],
                  'discount'=>$arr[$count]['discount'],
                  'url'=>$gb_url.$arr[$count]['file_name'],
                );
            }
        return $this->sendResponse($product_info,$SqlModel->gb_msg_retrieved());
    }

    public function search_pos( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $pathImage= $SqlModel->gb_pos_product_image();
        $gb_url = env('APP_URL').Storage::url($pathImage);

        $results = $SqlModel->proc_get_data('CALL pos_sql(?,?,?)', array('search_pos',$gb_user_branch,$id));
        $arr = json_decode(json_encode($results), true);

        $product_info=[];
            for ($count = 0; $count < count($arr); $count++)
            {
                $product_info[$count] = array(
                  'pro_code'=>$arr[$count]['pro_code'],
                  'barcode'=>$arr[$count]['barcode'],
                  'pro_name'=>$arr[$count]['pro_name'],
                  'cost'=>$arr[$count]['cost'],
                  'unitprice'=>$arr[$count]['unitprice'],
                  'discount'=>$arr[$count]['discount'],
                  'url'=>$gb_url.$arr[$count]['file_name'],
                );
            }
            return $this->sendResponse($product_info,$SqlModel->gb_msg_retrieved());
    }

    public function pos_delete_sysdoc(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            'pos_delete_sysdoc',
            $gb_user_branch,
            $request->sysdoc,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL pos_delete(?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function create_pos_invoice(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            $request->status,
            $request->pos_code,
            $gb_user_branch,
            $request->cus_code,
            $request->table_num,
            $request->people_num,
            $request->remark,
            $gb_user_name);

        
        $results = $SqlModel->proc_get_data('CALL pos_invoices(?,?,?,?,?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }


    public function create_pos_details(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            $request->status,
            $request->pos_code,
            $gb_user_branch,
            $request->sto_code,
            $request->pro_code,
            $request->barcode,
            $request->unitprice,
            $request->discount,
            $request->qty,
            $request->remark);


        $results = $SqlModel->proc_get_data('CALL pos_invoice_details(?,?,?,?,?,?,?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }


    public function auth_point_of_sale(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            $request->status,
            $gb_user_branch,
            $request->pos_code,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL pos_authorizer(?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }


    public function reject_point_of_sale(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            $request->status,
            $gb_user_branch,
            $request->pos_code,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL pos_reject_trans(?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }


    public function pos_charges(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            'collect',
            $request->pos_code,
            $gb_user_branch,
            $request->charge,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL pos_charges(?,?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }


}
