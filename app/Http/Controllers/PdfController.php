<?php

namespace App\Http\Controllers;

class PdfController extends Controller
{
    public function showPdf()
    {
        // PDFファイルのURLを設定します。実際のURLに変更する必要があります。
        $pdfUrl = "https://vecdoc.blob.core.windows.net/devcontainer/データアナリティクス5回目[完成]2022冬.pdf";

        // ビューにPDFのURLを渡します。
        return view('pdfViewer', compact('pdfUrl'));
    }
}