<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rule') }}
        </h2>
    </x-slot>

        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("規約一覧") }}
                </div>
            </div>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Version Management & PDF Viewer</title>
                <style>
                
            .pdf-viewer-container {
                background-color: white;
                text-align: center;
                margin: 0 auto;
                width: 100%; 
            }
        
            .button-style {
                display: inline-block;
                margin: 0 10px;
                font-size: 16px;
                padding: 10px 20px;
                cursor: pointer;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                transition: background-color 0.3s;
            }
                /* Style for the upload button */
            button[type="submit"] {
                display: inline-block;
                padding: 10px 20px;
                background-color: #007bff; /* Example button color */
                color: white; /* Text color */
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }
        
            /* You can still keep the hover effect for better user experience */
            button[type="submit"]:hover {
                background-color: #0056b3;
            }
        
            .button-style:hover {
                background-color: #0056b3;}

            .bottom-buttons {
                position: fixed; 
                bottom: 10px; 
                left: 50%; 
                transform: translateX(-50%); 
                padding: 5px 10px;
                font-size: 12px; }
            
                iframe {
                    flex-grow: 1;
                    width: 100%;
                    border: none;
                    margin-bottom: 20px;
                }
            
                button {
                    display: block;
                    margin: 10px auto;
                    font-size: 16px;
                    padding: 10px 20px;
                    cursor: pointer;
                    background-color: #007bff;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    transition: background-color 0.3s;
                }
            
                button:hover {
                    background-color: #0056b3;
                }
            
                table {
                    width: 100%;
                    background-color: white;
                    border-collapse: collapse;
                }
            
                table,
                th,
                td {
                    border: 1px solid black;
                }
            
                th,
                td {
                    padding: 8px;
                    text-align: left;
                }
            
                th {
                    background-color: #f2f2f2;
                }
            
                #drop-area {
                    border: 2px dashed #ccc;
                    border-radius: 5px;
                    padding: 20px;
                    text-align: center;
                }
                .highlight {
                    border-color: purple;
                   }
        </style>

        </head>
        <body class="font-sans text-center m-0 p-0 flex flex-col justify-center items-center h-screen">
        <!-- バージョン管理リストテーブル -->
        <table>
            <thead>
                <tr>
                    <th>文書名</th>
                    <th>状態</th>
                    <th>所有者</th>
                    <th>作成日</th>
                    <th>バージョン</th>
                    <th>View Document</th> 
                </tr>
            </thead>
            <tbody>
                @foreach ($Documents as $document)
                    <tr>
                        <td>{{ $document->note }}</td>
                        <td>{{ $document->status }}</td>
                        <td>{{ $document->user_id }}</td> 
                        <td>{{ $document->created_at->format('Y/m/d') }}</td>
                        <td>{{ $document->version }}</td> 
                        <td>
                            <button onclick="loadPdf('{{ $document->path }}')">View PDF</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
               
            <!-- PDFビューア -->
            <div class="pdf-viewer-container" style="position: relative;">
             <iframe id="pdfIframe" src="about:blank" style="width: 100%; height: 500px;"></iframe>
                <div class="bottom-buttons" style="position: absolute; bottom: -50px; left: 50%; transform: translateX(-50%);">
                <button onclick="goBack()" class="button-style">PDF Viewer Close</button>
                <button onclick="window.location.href='/dashboard';" class="button-style">Return to Dashboard</button>
            </div>
               
            <!-- ドラッグアンドドロップファイルアップロードフォーム -->
            <form action="/upload" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="rule_id" value="{{ $id }}">
                <div id="drop-area">
                    <h3>ここにファイルをドラッグアンドドロップ、またはクリックして選択</h3>
                    <input type="file" id="fileElem" name="file" style="display:none" onchange="handleFiles(this.files)">
                    <label for="fileElem">ファイルを選択</label>
                </div>
                <ul id="file-list"></ul> <!-- アップロードされたファイルのリスト -->
                <button type="submit">アップロード</button>
            </form>
               
               
            <script>
                function loadPdf(url) {
                    var iframe = document.getElementById('pdfIframe');
                    iframe.src = url; // PDFをロードするためのURLをiframeに設定
                }
            
                function goBack() {
                    var iframe = document.getElementById('pdfIframe');
                    iframe.src = 'about:blank'; // PDFビューアを閉じる
                }
            
                let dropArea = document.getElementById('drop-area');
                let fileList = document.getElementById('file-list');
            
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    dropArea.addEventListener(eventName, preventDefaults, false);
                });
            
                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            
                ['dragenter', 'dragover'].forEach(eventName => {
                    dropArea.addEventListener(eventName, highlight, false);
                });
            
                ['dragleave', 'drop'].forEach(eventName => {
                    dropArea.addEventListener(eventName, unhighlight, false);
                });
            
                function highlight(e) {
                    dropArea.classList.add('highlight'); // ドラッグ時のハイライト
                }
            
                function unhighlight(e) {
                    dropArea.classList.remove('highlight'); // ハイライトを解除
                }
            
                dropArea.addEventListener('drop', handleDrop, false);
            
                function handleDrop(e) {
                    let dt = e.dataTransfer;
                    let files = dt.files;
                    handleFiles(files); // ファイル処理
                }
            
                function handleFiles(files) {
                    fileList.innerHTML = ''; // リストをクリア
                    for (let i = 0, numFiles = files.length; i < numFiles; i++) {
                        const file = files[i];
                        const listItem = document.createElement('li');
                        listItem.textContent = file.name; // ファイル名をリストに表示
                        fileList.appendChild(listItem);
                    }
                }
            </script>
        </body>
        </html>
        </div>
        </div>
            
        </x-app-layout>
            