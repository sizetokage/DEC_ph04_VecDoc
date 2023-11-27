<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FileUploadController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'pdf' => 'required|file|mimes:pdf|max:2048',
            ]);

            $file = $request->file('pdf');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            return back()->with('success', 'File has been uploaded.')->with('file', $fileName);
        } catch (\Exception $e) {
            // Log the error
            Log::error('File upload failed: ' . $e->getMessage());

            // Return back with an error message
            return back()->with('error', 'File upload failed.');
        }
    }
}
