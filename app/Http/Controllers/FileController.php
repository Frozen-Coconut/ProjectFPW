<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function Main(Request $request)
    {
        return view('file.main');
    }

    public function Upload(Request $request)
    {
        return view('file.upload');
    }

    public function UploadPost(Request $request)
    {
        $request->validate([
            'file' => 'required',
            'folder' => 'required|not_regex:/\.\./'
        ]);
        try {
            $project = session('projectSekarang');
            $file = $request->file('file');
            $folder = trim($request->folder, '/');
            Storage::makeDirectory("/public/$project/$folder");
            Storage::putFileAs("/public/$project/$folder/", $file, $file->getClientOriginalName());
        } catch(Exception $ex) {
            return redirect()->route('file_upload')->with('message_error', 'Gagal upload file!');
        }
        return redirect()->route('file_upload')->with('message_success', 'Berhasil upload file!');
    }

    public function Edit(Request $request)
    {
        return view('file.edit');
    }
}
