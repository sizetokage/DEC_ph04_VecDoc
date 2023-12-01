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

    <!-- 버전 관리 리스트 테이블 -->
    <table>
        <tr>
        <th>文書名</th>
        <th>タイプ</th>
        <th>状態</th>
        <th>製品/エリア</th>
        <th>所有者</th>
        <th>作成日</th>
        <th>バージョン</th>
            <th>View Document</th> <!-- 문서 보기 열을 추가 -->
        </tr>
        <tr>
        <td>社内規約ドキュメント</td>
        <td>規約</td>
        <td>レビュー中</td>
        <td>人事部</td>
        <td>田中太郎</td>
        <td>2023/01/27</td>
        <td>2.1</td>
            <td><button
                    onclick="loadPdf('https://vecdoc.blob.core.windows.net/devcontainer/最終会議録（ph02_1) (1).pdf')">View
                    PDF</button></td> <!-- 버튼을 클릭하면 PDF를 로드 -->
        </tr>
        <td>社内規約ドキュメント</td>
        <td>規約</td>
        <td>レビュー中</td>
        <td>人事部</td>
        <td>田中太郎</td>
        <td>2023/01/27</td>
        <td>2.1</td>
        <td><button onclick="loadPdf('https://vecdoc.blob.core.windows.net/devcontainer/最終会議録（ph02_1) (1).pdf')">View
                PDF</button></td> <!-- 버튼을 클릭하면 PDF를 로드 -->
        </tr>
        <!-- 여기에 추가 문서 행을 계속 추가할 수 있습니다. -->
    </table>

    <!-- PDF 뷰어 -->
    <iframe id="pdfIframe" src="about:blank" style="width: 80%; height: 500px;"></iframe>
    <button onclick="goBack()">PDF Viewer Close</button> <!-- PDF 뷰어를 닫는 버튼 -->

    <script>
        function loadPdf(url) {
            var iframe = document.getElementById('pdfIframe');
            iframe.src = url; // 버튼에서 받은 URL로 iframe의 src를 설정
        }

        function goBack() {
            var iframe = document.getElementById('pdfIframe');
            iframe.src = 'about:blank'; // PDF 뷰어를 닫음
        }
    </script>
</body>

</html>