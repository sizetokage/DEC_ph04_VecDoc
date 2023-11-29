<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PDF Viewer</title>
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
            margin: 20px auto;
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
    </style>
</head>

<body>
    <iframe id="pdfIframe" src="about:blank"></iframe>
    <button onclick="loadPdf()">PDFファイルを見る</button>
    <button onclick="goBack()">元のページに戻る</button> <!-- 戻るボタンを追加 -->

    <script>
        function loadPdf() {
            var iframe = document.getElementById('pdfIframe');
            iframe.src = 'https://vecdoc.blob.core.windows.net/devcontainer/データアナリティクス5回目[完成]2022冬.pdf';
        }

        function goBack() {
            window.history.back(); // 戻る機能
        }
    </script>
</body>

</html>