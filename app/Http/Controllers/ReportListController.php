<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportListController extends Controller
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

    public function getReport(){
        $report = new Report;
        $reportList = $report->sortable()->get();

        return view('report_list/reportList',compact('reportList'));
    }

    public function getNarrowReport(Request $request){
        $report = new Report;
        $title = $request->input('title');
        $body = $request->input('body');
        $report = $report->where('title', 'like', "%$title%");
        $report = $report->where('body', 'like', "%$body%");
        $reportList = $report->sortable()->get();

        return view('report_list/reportList',compact('reportList','title','body'));
    }

    public function reportNarrow(Request $request){
        if ($request->has('narrow')){
            $reportList = $this->narrow($request);
            $title = $request->input('title');
            $body = $request->input('body');
        }elseif ($request->has('clear')){
            $this->getReport();
        }
        return view('report_list/reportList',compact('reportList','title','body'));
    }

    public function narrow(Request $request){
        $request->validate([
            'title' => 'max:50',
            'body' => 'max:2500',
        ]);

        $title = $request->input('title');
        $body = $request->input('body');

        $report = new Report;

        $report = $report->where('title', 'like', "%$title%");
        $report = $report->where('body', 'like', "%$body%");
        $reportList = $report->get();

        return $reportList;
    }

    public function reportDetail(Request $request){
        $id = $request->input('detail');
        $report = new Report;
        $reportDetail = $report->find($id);

        $attachments = $reportDetail->attachments()->get();

        return view('report_list/reportDetail',compact('reportDetail','attachments'));
    }
}
