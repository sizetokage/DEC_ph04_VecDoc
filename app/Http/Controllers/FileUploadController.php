<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:2048',
        ]);

        $file = $request->file('pdf');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        return back()->with('success', 'File has been uploaded.')->with('file', $fileName);
    }
}