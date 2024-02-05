<?php

namespace App\Http\Controllers\API\Somnong\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\API\SqlModel;
use App\Http\Controllers\API\BaseController as BaseController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Response;

class SomnongQuoteController extends BaseController
{
    //
    protected $SqlModel;

    public function create_quotation(Request $request)
    {
        $SqlModel = new SqlModel();
        $gb_user_name=$SqlModel->gb_user_email($request);
        $gb_user_branch=$SqlModel->gb_user_branch($request);
        $_TranDate = date("Y-m-d H:i:s",strtotime($request->tranDate));
        
        $arr=array(
            $request->status,
            $request->quote_code,
            $request->client_id,
            $gb_user_branch,
            $request->quote_title,
            $request->house_number,
            $request->quote_status,
            $request->quote_leader,
            $request->address_code,
            $request->google_map,
            $request->remark,
            Carbon::parse($_TranDate),
            $gb_user_name);

        $results = $SqlModel->proc_get_data('CALL somnong_register_quote(?,?,?,?,?,?,?,?,?,?,?,?,?)', $arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
        
    }

  

    public function getQuotation(Request $request){

        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $arr=array('getquotation', $gb_user_branch,'');
        $results = $SqlModel->proc_get_data('CALL somnong_sql_get(?,?,?)',$arr);
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function quotes_byId( Request $request,$id )
    {
        $SqlModel = new SqlModel();
        $gb_user_branch= $SqlModel->gb_user_branch($request);
        $results = $SqlModel->proc_get_data('CALL somnong_sql_get(?,?,?)', array('quote_by_id',$gb_user_branch,$id));
        return $this->sendResponse($results, $SqlModel->gb_msg_retrieved());
    }

    public function quote_file(Request $request)
    {
        try {
            $SqlModel = new SqlModel();
            $gb_user_email = $SqlModel->gb_user_email($request);
            $gb_user_branch = $SqlModel->gb_user_branch($request);
            $pathFile= $SqlModel->gb_somnong_quote();

            $filename = $gb_user_branch . '-' . time() . rand(1, 100) . '.' . $request->image->getClientOriginalExtension();
            $extension = '.' . $request->image->getClientOriginalExtension();
            Storage::disk('somnong')->put($pathFile. $filename, file_get_contents($request->image));

            $arr = array(
                'quote_somnong',
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


    public function quote_file_view(Request $request,$quote_code)
    {
        try {

            $SqlModel = new SqlModel();
            $gb_user_branch= $SqlModel->gb_user_branch($request);
            $pathImage= $SqlModel->gb_somnong_quote();
            $gb_url = env('APP_URL').Storage::url($pathImage);
            
            $results = $SqlModel->proc_get_data('CALL somnong_sql_get(?,?,?)', array('quote_file',$gb_user_branch,$quote_code));

            $arr = json_decode(json_encode($results), true);

            $file_info=[];

            for ($count = 0; $count < count($arr); $count++)
            {
                $file_info[$count] = array(
                  'row'=>$arr[$count]['row_num'],
                  'tran_code'=>$arr[$count]['tran_code'],
                  'title'=>$arr[$count]['title'],
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

    public function quote_file_download(Request $request,$file_name)
    {
        //check image exist or not
        $SqlModel = new SqlModel();
        $exists = Storage::disk('somnong')->exists('quotes/' . $file_name);
        if ($exists) {
            //get content of image
            $content = Storage::disk('somnong')->get('quotes/' . $file_name);
            //get mime type of image
            $mime = Storage::disk('somnong')->mimeType('quotes/' . $file_name);      //prepare response with image content and response code
            $response = Response::make($content, 200);      //set header
            $response->header("Content-Type", $mime);      // return response
            $image = base64_encode($response);

            return $response;

            return [
                'status'=>true,
                'data'=>$image,
                'type'=>$mime
            ];

        }
    }

    public function del_quote_file(Request $request)
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
