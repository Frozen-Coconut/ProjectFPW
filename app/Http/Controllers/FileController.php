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
        $path_sebelumnya = trim(str_replace(basename($path), '', str_replace('/public/' . session('projectSekarang'), '', $path)), '/');
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
        $basic_path = str_replace(basename($file), '', $file);
        $text = Storage::get('/public/' . session('projectSekarang') . '/' . $file);
        return view('file.edit', compact('file', 'basic_path', 'text'));
    }

    public function EditPost(Request $request)
    {
        $root_path = '/public/' . session('projectSekarang') . '/';
        $basic_path = $request->basic_path;
        $name = $request->name;

        $path = $root_path . $request->path;
        $new_path = $root_path . $basic_path . '/' . $name;

        if ($request->has('save')) {
            $request->validate([
                'basic_path' => ['not_regex:/\.\./'],
                'name' => ['required', 'not_regex:/\//', 'not_regex:/\.\./']
            ]);
            $text = $request->text;
            Storage::put($path, $text);
            if (Storage::exists($new_path)) {
                return redirect()->route('file_main')->with('message_error', 'File tujuan sudah ada!');
            }
            Storage::makeDirectory($root_path . $basic_path);
            Storage::move($path, $new_path);
            return redirect()->route('file_main')->with('message_success', 'Berhasil mengubah file!');
        } else if ($request->has('delete')) {
            Storage::delete($path);
            return redirect()->route('file_main')->with('message_success', 'Berhasil menghapus file!');
        } else if ($request->has('download')) {
            return Storage::download($path);
        } else if ($request->has('deleteFolder')) {
            Storage::deleteDirectory($path);
            return redirect()->route('file_main')->with('message_success', 'Berhasil menghapus folder!');
        }
        return redirect()->route('file_main');
    }
}
