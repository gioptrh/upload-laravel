<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048',
        ]);

        $file = $request->file('file');
        $path = $request->file('file')->store('upload', 'public');;
        //$path = $file->move(public_path("storage/upload"), $file->getClientOriginalName());

        File::create([
            'filename' => $request->file('file')->getClientOriginalName(),
            'filepath' => $path,
        ]);

        return redirect()->route('file-list')->with('success', 'File berhasil diupload!');

    }

    public function showExcelUploadForm()
{
    return view('upload-excel');
}

public function uploadExcel(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xls,xlsx,csv|max:2048',
    ]);

    $file = $request->file('file');
    $path = $file->store('upload/excel', 'public');

    File::create([
        'filename' => $file->getClientOriginalName(),
        'filepath' => $path,
    ]);

    return redirect()->route('file-list')->with('success', 'Excel berhasil diupload!');
}
    public function index()
    {
        $files = File::latest()->get();
        return view('file-list', compact('files'));
    }
    

public function destroy($id)
{
    $file = File::findOrFail($id);

    \Storage::disk('public')->delete($file->filepath);


    $file->delete();

    return redirect()->back()->with('success', 'File berhasil dihapus.');
}

public function showImageUploadForm()
{
    return view('upload'); 


}
}

