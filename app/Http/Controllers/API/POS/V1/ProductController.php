<?php

namespace App\Http\Controllers\API\POS\V1;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\API\SqlModel;
use Illuminate\Support\Facades\Storage;
use Response;

class ProductController extends BaseController
{
    //
    protected $SqlModel;
    public function create_product(Request $request)
    {
        $uniqid=uniqid();
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            $request->status,
            $request->pro_code,
            $gb_user_branch,
            $request->pro_name,
            $request->barcode,
            $request->cost,
            $request->unitprice,
            $request->discount,
            $request->qty_alert,
            $request->category_code,
            $request->line_code,
            $request->color_code,
            $request->year_code,
            $request->remark,
            $request->active,
            $request->tracking,
            $gb_user_name);

        $SqlModel->his_Activity('0',$arr,$uniqid);
        $results = $SqlModel->proc_get_data('CALL pos_register_product(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }
     public function getProduct(Request $request){

        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $pathImage= $SqlModel->gb_pos_product_image();
        $gb_url = env('APP_URL').Storage::url($pathImage);

        $para=array('getproduct', $gb_user_branch,'');
        $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)',$para);

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
                  'qty_alert'=>$arr[$count]['qty_alert'],
                  'category_code'=>$arr[$count]['category_code'],
                  'line_code'=>$arr[$count]['line_code'],
                  'color_code'=>$arr[$count]['color_code'],
                  'year_code'=>$arr[$count]['year_code'],
                  'inputter'=>$arr[$count]['inputter'],
                  'active'=>$arr[$count]['active'],
                  'url'=>$gb_url.$arr[$count]['file_name'],
                );
            }

        return $this->sendResponse($product_info, $SqlModel->gb_msg_retrieved());
    }

    public function Product_byId( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)', array('product_by_id',$gb_user_branch,$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function pro_by_category( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $pathImage= $SqlModel->gb_pos_product_image();
        $gb_url = env('APP_URL').Storage::url($pathImage);
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)', array('pro_by_category',$gb_user_branch,$id));
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
                  'qty_alert'=>$arr[$count]['qty_alert'],
                  'category_code'=>$arr[$count]['category_code'],
                  'line_code'=>$arr[$count]['line_code'],
                  'color_code'=>$arr[$count]['color_code'],
                  'year_code'=>$arr[$count]['year_code'],
                  'inputter'=>$arr[$count]['inputter'],
                  'active'=>$arr[$count]['active'],
                  'url'=>$gb_url.$arr[$count]['file_name'],
                );
            }
        
        
        return $this->sendResponse( $product_info, $SqlModel->gb_msg_retrieved());
    }

    public function search_items( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);

        $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)', array('search_items',$gb_user_branch,$id));
        $notices = $SqlModel->arrayPaginator($results, $request, $SqlModel->row_number());

        return $notices;
    }


    public function product_upload_image(Request $request)
    {
        try {

            $SqlModel = new SqlModel();
            $gb_user_email = $SqlModel->gb_user_email($request);
            $gb_user_branch = $SqlModel->gb_user_branch($request);
            $pathImage= $SqlModel->gb_pos_product_image();

            $filename = $gb_user_branch . '-' . time() . rand(1, 100) . '.' . $request->image->getClientOriginalExtension();
            $extension = '.' . $request->image->getClientOriginalExtension();
            Storage::disk('public')->put($pathImage. $filename, file_get_contents($request->image));

            $arr = array(
                'product_upload',
                $gb_user_branch,
                $request->referent_id,
                $filename,
                $request->description,
                $extension,
                $gb_user_email
            );
            $results = $SqlModel->proc_get_data('CALL pos_upload_image(?,?,?,?,?,?,?)', $arr);
            return $this->sendResponse($results,$SqlModel->gb_msg_retrieved());

        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => $SqlModel->gb_msg_wrong()
            ], 500);
        }
    }


    public function product_image(Request $request,$pro_id)
    {
        try {

            $SqlModel = new SqlModel();
            $gb_user_branch= $SqlModel->gb_user_branch($request);
            $pathImage= $SqlModel->gb_pos_product_image();
            $gb_url = env('APP_URL').Storage::url($pathImage);

            $results = $SqlModel->proc_get_data('CALL pos_sql_get(?,?,?)', array('product_image',$gb_user_branch,$pro_id));
            $arr = json_decode(json_encode($results), true);

            $product_info=[];
            for ($count = 0; $count < count($arr); $count++)
            {
                $product_info[$count] = array(
                  'row'=>$arr[$count]['row_num'],
                  'pro_code'=>$arr[$count]['pro_code'],
                  'pro_name'=>$arr[$count]['pro_name'],
                  'url'=>$gb_url.$arr[$count]['file_name'],
                );
            }
            return $this->sendResponse($product_info,$SqlModel->gb_msg_retrieved());
        } catch (\Exception $e) {
            return response()->json([
                'message' => $SqlModel->gb_msg_wrong()
            ], 500);
        }
    }

    public function user_profile_image($filename)
    {
        $data = array(
            [
                'id' => $filename,
                'url' => env('APP_URL') . Storage::url('profile/' . $filename)
            ]
        );
        return $this->sendResponse($data, 'Retrieved image Url');
    }

    public function del_product_image(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);
        $arr=array(
            'pro_del_image',
            $request->pro_code,
            $gb_user_branch,
            $request->row,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL pos_delete_images(?,?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }


}
