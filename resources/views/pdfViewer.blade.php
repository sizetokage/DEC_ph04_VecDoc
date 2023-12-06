<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Version Management & PDF Viewer</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

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

<body>

    <h2>Version管理一覧</h2>

    <!-- バージョン管理リストテーブル -->
    <table>
        <tr>
            <th>文書名</th>
            <th>タイプ</th>
            <th>状態</th>
            <th>製品/エリア</th>
            <th>所有者</th>
            <th>作成日</th>
            <th>バージョン</th>
            <th>View Document</th> <!-- 文書表示列の追加 -->
        </tr>
        <tr>
            <td>社内規約ドキュメント</td>
            <td>規約</td>
            <td>レビュー中</td>
            <td>人事部</td>
            <td>田中</td>
            <td>2023/01/27</td>
            <td>2.1</td>
            <td><button
                    onclick="loadPdf('https://vecdoc.blob.core.windows.net/devcontainer/最終会議録（ph02_1) (1).pdf')">View
                    PDF</button></td>
        </tr>
        <td>情報セキュリティドキュメント</td>
        <td>規約</td>
        <td>公開</td>
        <td>情報総括部</td>
        <td>南</td>
        <td>2023/01/27</td>
        <td>2.2</td>
        <td><button onclick="loadPdf('https://vecdoc.blob.core.windows.net/devcontainer/最終会議録（ph02_1) (1).pdf')">View
                PDF</button></td>
        </tr>
        <!-- ここに追加の文書行を続けて追加 -->
    </table>

    <!-- PDFビューア -->
    <iframe id="pdfIframe" src="about:blank" style="width: 80%; height: 500px;"></iframe>
    <button onclick="goBack()">PDF Viewer Close</button> <!-- PDFビューアを閉じるボタン -->
    <button onclick="window.location.href='/dashboard';">Return to Dashboard</button>

    <!-- ドラッグアンドドロップファイルアップロードフォーム -->
    <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
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