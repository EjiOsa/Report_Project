<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;

class ReportCreateController extends Controller
{
        /**
     * Create a new controller instance.
     * コンストラクタで認証チェック
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 報告書作成画面への遷移メソッド　作成途中で離脱した場合用にセッションを整理
    public function createReport(Request $request){
        $request->session()->forget('attachment_array');
        $request->session()->forget('title_ses');
        $request->session()->forget('body_ses');
        $request->session()->forget('name_ses');
        return view('report_create/createReport');
    }

    // 確認画面への遷移処理
    public function reportConfirm(Request $request){
        $user = Auth::user();

        $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:2500',
        ]);

        $title = $request->input('title');
        $body = $request->input('body');
        // 名前はログイン情報から取得
        $name = $user->name;

        // 確認画面用にセッションに格納
        $request->session()->put('title_ses', $title);
        $request->session()->put('body_ses', $body);
        $request->session()->put('name_ses', $name);

        // 添付ファイル操作
        if($request->hasFile('attachment')) {
            if (!empty($request->file('attachment'))) {
                $attachments = $request->file('attachment');
                $attachmentArray = array();
                foreach($attachments as $attachment){
                    $fileName = $attachment->getClientOriginalName();
                    $extension = $attachment->getClientOriginalExtension();
                    // ユニークなファイル名を生成（形式：元のファイル名_ランダムの英数字.拡張子）
                    $newImageName = pathinfo($fileName, PATHINFO_FILENAME) . "_" . uniqid() . "." . $extension;

                    // 一時保存ディレクトリに保存
                    $attachment->storeAs("public/attachment/img/tmp", $newImageName);
                    $path = "attachment/img/".$newImageName;

                    $fileData = array('file_name'=>$fileName, 'path'=>$path, 'new_image_name'=>$newImageName);
                    $attachmentArray[$newImageName]=$fileData;
                }
                $request->session()->put('attachment_array',$attachmentArray);
            }
        }
        return view('report_create/reportConfirm');
    }

    // 登録処理をして完了画面へ遷移
    public function insertReport(Request $request){
        $title = $request->session()->get('title_ses');
        $body = $request->session()->get('body_ses');
        $name = $request->session()->get('name_ses');

        $report = new Report;
        $report->title = $title;
        $report->body = $body;
        $report->user_name = $name;
        if($request->session()->get('attachment_array')){
            $report->attachment_flg = 1;
        }
        $result = $report->save();

        if($result && $request->session()->get('attachment_array')) {
            $file = new Filesystem;
            foreach($request->session()->get('attachment_array') as $attachment_data) {
                $path = $attachment_data['path'];
                $newImageName = $attachment_data['new_image_name'];
                $attachment = new \App\Attachment();
                $attachment->parent_id = $report->id;
                $attachment->file_name = $attachment_data['file_name'];
                $attachment->model = get_class($report);
                $attachment->path = $path;
                $attachment->key = 'photos';
                $attachment->save();

                // 本保存ディレクトリにファイルを移動
                $file->move(storage_path("app/public/attachment/img/tmp/").$newImageName,storage_path("app/public/attachment/img/").$newImageName);
            }
            $file->cleanDirectory(storage_path("app/public/attachment/img/tmp"));
        }
        $request->session()->forget('attachment_array');
        $request->session()->forget('title_ses');
        $request->session()->forget('body_ses');
        $request->session()->forget('name_ses');
        return view('report_create/createFinish');
    }
}
