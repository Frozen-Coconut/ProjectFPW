<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function Main(Request $request)
    {
        $path = '/public/' . session('projectSekarang') . '/';
        if ($request->has('path')) {
            $request->validate([
                'path' => 'not_regex:/\.\./'
            ]);
            if (!preg_match('/^\/+$/', $request->path)) {
                $path .= $request->path;
            }
        }
        $path_sebelumnya = trim(str_replace('/public/' . session('projectSekarang'), '', str_replace(basename($path), '', $path)), '/');
        $folders = Storage::directories($path);
        $files = Storage::files($path);
        $project = session('projectSekarang');
        return view('file.main', compact('path', 'path_sebelumnya', 'folders', 'files', 'project'));
    }

    public function Upload(Request $request)
    {
        return view('file.upload');
    }

    public function UploadPost(Request $request)
    {
        $request->validate([
            'file' => 'required',
            'folder' => trim($request->folder) != '' ? 'not_regex:/\.\./' : '',
            'name' => trim($request->name) != '' ? ['not_regex:/\.\./', 'not_regex:/\//'] : ''
        ]);
        try {
            $project = session('projectSekarang');
            $file = $request->file('file');
            $folder = '';
            if (trim($request->folder) != '') {
                $folder = trim($request->folder, '/');
            }
            $name = $file->getClientOriginalName();
            if (trim($request->name) != '') {
                $name = $request->name;
            }
            $path = "/public/$project/$folder/";
            if (Storage::exists("$path/" . $name)) {
                return redirect()->route('file_upload')->with('message_error', 'File sudah ada!');
            }
            Storage::makeDirectory($path);
            Storage::putFileAs($path, $file, $name);
        } catch(Exception $ex) {
            return redirect()->route('file_upload')->with('message_error', 'Gagal upload file!');
        }
        return redirect()->route('file_upload')->with('message_success', 'Berhasil upload file!');
    }

    public function Edit(Request $request)
    {
        if (!$request->has('path')) {
            return redirect()->back();
        }
        $file = $request->path;
        $text = Storage::get('/public/' . session('projectSekarang') . '/' . $file);
        return view('file.edit', compact('file', 'text'));
    }

    public function EditPost(Request $request)
    {
        if ($request->has('save')) {
            $request->validate([
                'name' => ['required', 'not_regex:/\//', 'not_regex:/\.\./']
            ]);
            $path = '/public/' . session('projectSekarang') . '/' . $request->path;
            $text = $request->text;
            Storage::put($path, $text);
            Storage::move($path, str_replace(basename($path), '', $path) . $request->name);
            return redirect()->route('file_main')->with('message_success', 'Berhasil mengubah file!');
        } else if ($request->has('delete')) {
            $path = '/public/' . session('projectSekarang') . '/' . $request->path;
            Storage::delete($path);
            return redirect()->route('file_main')->with('message_success', 'Berhasil menghapus file!');
        }
        return redirect()->route('file_main');
    }
}
