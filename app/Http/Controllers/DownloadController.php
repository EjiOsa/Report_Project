<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function downloadFile(Request $request){
        $path = $request->input('download');

        $fileName = basename($path);
        $filePath = "attachment/img/".$fileName;
        $mimeType = Storage::mimeType($filePath);
        $headers = [['Content-Type' => $mimeType]];
        return Storage::download($filePath, $fileName, $headers);
    }
}
