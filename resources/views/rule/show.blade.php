<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Version Management & PDF Viewer</title>
    <style>
        .pdf-viewer-container {
    text-align: center;
    margin: 0 auto;
    width: 80%; 
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
            width: 80%;
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
    <h2 class="text-2xl font-bold mb-4">Version管理一覧</h2>

<!-- バージョン管理リストテーブル -->
<table>
    <thead>
        <tr>
            <th>文書名</th>
            <th>状態</th>
            <th>所有者</th>
            <th>作成日</th>
            <th>バージョン</th>
            <th>View Document</th> <!-- 文書表示列の追加 -->
        </tr>
    </thead>
    <tbody>
        @foreach ($Documents as $document)
            <tr>
                <td>{{ $document->note }}</td>
                <td>{{ $document->status }}</td>
                <td>{{ $document->owner }}</td> <!-- 仮の所有者フィールド名 -->
                <td>{{ $document->created_at->format('Y/m/d') }}</td>
                <td>{{ $document->version }}</td> <!-- 仮のバージョンフィールド名 -->
                <td>
                    <button onclick="loadPdf('{{ $document->path }}')">View PDF</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

    <!-- PDFビューア -->
    <div class="pdf-viewer-container" style="position: relative;">
     <iframe id="pdfIframe" src="about:blank" style="width: 80%; height: 500px;"></iframe>
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