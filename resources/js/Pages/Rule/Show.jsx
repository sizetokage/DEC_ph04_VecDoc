import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Index({ auth, Documents }) {
    const styles = {
        body: {
            fontFamily: "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif",
            textAlign: 'center',
            margin: 0,
            padding: 0,
            height: '100vh',
            display: 'flex',
            flexDirection: 'column',
            justifyContent: 'center',
            alignItems: 'center',
        },
        iframe: {
            flexGrow: 1,
            width: '80%',
            border: 'none',
            marginBottom: '20px',
        },
        button: {
            display: 'block',
            margin: '10px auto',
            fontSize: '16px',
            padding: '10px 20px',
            cursor: 'pointer',
            backgroundColor: '#007bff',
            color: 'white',
            border: 'none',
            borderRadius: '5px',
            transition: 'background-color 0.3s',
        },
        buttonHover: {
            backgroundColor: '#0056b3',
        },
        table: {
            width: '100%',
            borderCollapse: 'collapse',
        },
        tableCell: {
            border: '1px solid black',
            padding: '8px',
            textAlign: 'left',
        },
        tableHeader: {
            backgroundColor: '#f2f2f2',
        },
        dropArea: {
            border: '2px dashed #ccc',
            borderRadius: '5px',
            padding: '20px',
            textAlign: 'center',
        },
        highlight: {
            borderColor: 'purple',
        },
    };
        function loadPdf(url) {
            var iframe = document.getElementById('pdfIframe');
            iframe.src = url; // PDFをロードするためのURLをiframeに設定
        }

        function goBack() {
            var iframe = document.getElementById('pdfIframe');
            iframe.src = 'about:blank'; // PDFビューアを閉じる
        }

        // let dropArea = document.getElementById('drop-area');
        // let fileList = document.getElementById('file-list');

        // ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        //     dropArea.addEventListener(eventName, preventDefaults, false);
        // });

        // function preventDefaults(e) {
        //     e.preventDefault();
        //     e.stopPropagation();
        // }

        // ['dragenter', 'dragover'].forEach(eventName => {
        //     dropArea.addEventListener(eventName, highlight, false);
        // });

        // ['dragleave', 'drop'].forEach(eventName => {
        //     dropArea.addEventListener(eventName, unhighlight, false);
        // });

        // function highlight(e) {
        //     dropArea.classList.add('highlight'); // ドラッグ時のハイライト
        // }

        // function unhighlight(e) {
        //     dropArea.classList.remove('highlight'); // ハイライトを解除
        // }

        // dropArea.addEventListener('drop', handleDrop, false);

        // function handleDrop(e) {
        //     let dt = e.dataTransfer;
        //     let files = dt.files;
        //     handleFiles(files); // ファイル処理
        // }

        // function handleFiles(files) {
        //     fileList.innerHTML = ''; // リストをクリア
        //     for (let i = 0, numFiles = files.length; i < numFiles; i++) {
        //         const file = files[i];
        //         const listItem = document.createElement('li');
        //         listItem.textContent = file.name; // ファイル名をリストに表示
        //         fileList.appendChild(listItem);
        //     }
        // }
    return (
        
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Rule</h2>}
        >
            <Head title="Rule.Index" />

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            文書管理
                        </div>
                    </div>
                    <table class="bg-white text-center w-full border-collaple">
                        <thead>
                            <tr>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">文書名</th>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">タイプ</th>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">状態</th>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">製品エリア</th>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">作成者</th>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">更新日</th>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">バージョン</th>
                            </tr>
                        </thead>
                        <tbody>
                            {Documents.map(document => (
                                <tr>
                                    <td>!!社内規約ドキュメント</td>{/* <td>{document.name}</td> */}
                                    <td>!規約</td>
                                    <td>!レビュー中</td>{/* <td>{document.status}</td> */}
                                    <td>!全社</td>
                                    <td><button onClick={loadPdf('https://vecdoc.blob.core.windows.net/devcontainer/最終会議録（ph02_1) (1).pdf')}>{document.user_name}</button></td>
                                    <td>{new Date(document.updated_at).toLocaleString('ja-JP', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' })}</td>
                                    <td>!1.0</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                    <div style={styles.body}>
                        <iframe id="pdfIframe" src="about:blank" style={styles.iframe}></iframe>
                        <button
                            style={styles.button}
                            onMouseOver={() => (styles.button.backgroundColor = styles.buttonHover.backgroundColor)}
                            onMouseOut={() => (styles.button.backgroundColor = '#007bff')}
                        >
                            PDF Viewer Close
                        </button>
                        <button style={styles.button} onClick={() => (window.location.href = '/dashboard')}>
                            Return to Dashboard
                        </button>
                        {/* Add other elements using the defined styles */}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}