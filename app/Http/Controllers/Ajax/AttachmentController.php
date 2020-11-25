<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class AttachmentController extends Controller
{
    // 添付ファイル削除処理
    public function delAttachment(Request $request){
        if($request->attachment_name) {
            //セッションから削除要求されたデータを削除
            $attachmentArray = $request->session()->get('attachment_array');
            $attachment_name = $request->attachment_name;
            unset($attachmentArray[$attachment_name]);
            $request->session()->put('attachment_array',$attachmentArray);

            //一時保存されているファイルを削除
            $file = new Filesystem;
            $file->delete(storage_path("app/public/attachment/img/tmp/".$attachment_name));
        }
    }
}
