<?php

namespace App\Http\Controllers\API\Somnong\V1;

use App\Models\API\SqlModel;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Storage;

class somnongPaymentController extends BaseController
{
    //
    protected $SqlModel;
    public function create_somnong_payment(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);

        $arr=array(
            $request->status,
            $request->referent_code,
            $gb_user_branch,
            $request->type_code,
            $request->currency_code,
            $request->amount,
            $request->remark,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL somnong_payments(?,?,?,?,?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
        
    }

    public function somnong_payment( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL somnong_sql_get(?,?,?)', array('payment_by_id',$gb_user_branch,$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }
    //

    public function getPayment(Request $request){

        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $arr=array('Payment', $gb_user_branch,'');
        $results = $SqlModel->proc_get_data('CALL somnong_sql_get(?,?,?)',$arr);

        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function payment_file(Request $request,$quote_code)
    {
        try {

            $SqlModel = new SqlModel();
            $gb_user_branch= $SqlModel->gb_user_branch($request);
            $pathImage= $SqlModel->gb_somnong_quote();
            $gb_url = env('APP_URL').Storage::url($pathImage);
            
            $results = $SqlModel->proc_get_data('CALL somnong_sql_get(?,?,?)', array('payment_file',$gb_user_branch,$quote_code));

            $arr = json_decode(json_encode($results), true);
            $file_info=[];

            for ($count = 0; $count < count($arr); $count++)
            {
                $file_info[$count] = array(
                  'row'=>$arr[$count]['row_num'],
                  'payment_id'=>$arr[$count]['payment_id'],
                  'extension'=>$arr[$count]['extension'],
                  'file_name'=>$arr[$count]['file_name'],
                  'url'=>$gb_url.$arr[$count]['file_name'],
                );
            }
            return $this->sendResponse($file_info,$SqlModel->gb_msg_retrieved());
        } catch (\Exception $e) {
            return response()->json([
                'message' => $SqlModel->gb_msg_wrong()
            ], 500);
        }
    }

    public function payment_upload_file(Request $request)
    {
        try {
            $SqlModel = new SqlModel();
            $gb_user_email = $SqlModel->gb_user_email($request);
            $gb_user_branch = $SqlModel->gb_user_branch($request);
            $pathFile= $SqlModel->gb_somnong_payment();

            $filename = $gb_user_branch . '-' . time() . rand(1, 100) . '.' . $request->image->getClientOriginalExtension();
            $extension = '.' . $request->image->getClientOriginalExtension();
            Storage::disk('somnong')->put($pathFile. $filename, file_get_contents($request->image));

            $arr = array(
                'payment_somnong',
                $gb_user_branch,
                $request->referent_id,
                $filename,
                $request->description,
                $extension,
                $gb_user_email
            );
            $results = $SqlModel->proc_get_data('CALL somnong_files(?,?,?,?,?,?,?)', $arr);
            return $this->sendResponse($results,$SqlModel->gb_msg_retrieved());

        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => $SqlModel->gb_msg_wrong()
            ], 500);
        }
    }

    public function del_payment_file(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);
        $arr=array(
            $request->status,
            $request->file_code,
            $gb_user_branch,
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL somnong_delete_file(?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

}
