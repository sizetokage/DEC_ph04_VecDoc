<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        try {
            $file = $request->file('file');

            if (!$file || !$file->isValid()) {
                Log::error("Invalid file upload.");
                return back()->with('error', 'Invalid file upload');
            }

            $filename = $file->getClientOriginalName();
            $path = Storage::disk('azure')->putFileAs('', $file, $filename);

            if ($path === false) {
                throw new \Exception("File upload to Azure failed.");
            }

            $url = Storage::disk('azure')->url($path);

            $latestVersion = Document::where('rule_id', $request->rule_id)
                             ->max('version');

            // Document 모델 생성 및 저장
            $document = new Document;
            $document->rule_id = $request->rule_id; // 관련 Rule의 ID 또는 null
            $document->user_id = Auth::id(); // 현재 사용자의 ID
            $document->enactment_date = '2023-01-01'; // 문서의 제정 날짜
            $document->note = $filename; // 파일 이름
            $document->path = $url; // 파일 URL 또는 경로
            $document->status = '1'; // 문서 상태
            $document->version = $latestVersion + 1;
            $document->save();

            return back()->with('success', 'Document uploaded successfully');
        } catch (\Exception $e) {
            Log::error("File upload or Document save error: " . $e->getMessage());
            Log::error("Error stack trace: " . $e->getTraceAsString());
            
            return back()->with('error', 'File upload or Document save failed');
        }
    }


    public function showDocuments()
    {
    // 문서를 최신 순으로 정렬
        $Documents = Document::orderBy('created_at', 'desc')->get();

        return view('your_view', compact('Documents'));
    }
}
