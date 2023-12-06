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
        @foreach ($Documents as $document)
        <tr>
        <td>!社内規約ドキュメント</td>
        <td>!規約</td>
        <td>!レビュー中</td>
        <td>{{$document->role}}</td>
        <td>{{$document->user->name}}</td>
        <td>{{$document->created_at}}</td>
        <td>!2.1</td>
            <td><button
                    onclick="loadPdf('{{$document->path}}')">View
                    PDF</button></td> 
        </tr>
        @endforeach
        <!-- ここに追加の文書行を続けて追加 -->
    </table>

    <!-- PDFビューア -->
    <iframe id="pdfIframe" src="about:blank" style="width: 80%; height: 500px;"></iframe>
    <button onclick="goBack()">PDF Viewer Close</button> <!-- PDFビューアを閉じるボタン -->
    <button onclick="window.location.href='/dashboard';">Return to Dashboard</button>

    <script>
        function loadPdf(url) {
            var iframe = document.getElementById('pdfIframe');
            iframe.src = url; // ボタンから受け取ったURLでiframeのsrcを設定
        }

        function goBack() {
            var iframe = document.getElementById('pdfIframe');
            iframe.src = 'about:blank'; // PDFビューアを閉じる
        }
    </script>
</body>

</html>