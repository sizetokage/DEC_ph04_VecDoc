import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Index({ auth, Rule, Documents }) {
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

    let dropArea = document.getElementById('drop-area');
    let fileList = document.getElementById('file-list');

    // ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    //     dropArea.addEventListener(eventName, preventDefaults, false);
    // });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // ['dragenter', 'dragover'].forEach(eventName => {
    //     dropArea.addEventListener(eventName, highlight, false);
    // });

    // ['dragleave', 'drop'].forEach(eventName => {
    //     dropArea.addEventListener(eventName, unhighlight, false);
    // });
    function handleSubmit(e) { 
        e.preventDefault();

        // valuesをalertで表示
        //alert(JSON.stringify(values));

        // Inertia.postで値を送信
        router.post("/document", values);
    }

    function highlight(e) {
        dropArea.classList.add('highlight'); // ドラッグ時のハイライト
    }

    function unhighlight(e) {
        dropArea.classList.remove('highlight'); // ハイライトを解除
    }

    // dropArea.addEventListener('drop', handleDrop, false);

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
    
    return (
        // この下のコードは、resources/js/Pages/Rule/Show.jsxのコードとほぼ同じです。のちに、このコードを再利用するために、コンポーネント化しておく予定。
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Rule</h2>}
        >
            <Head title="Rule.Index" />

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {Rule.genre_name} / {Rule.name}にPDFを追加
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <form onSubmit={handleSubmit} encType="multipart/form-data">
                                

                                <div id="drop-area">
                                    <h3>ここにファイルをドラッグアンドドロップ、またはクリックして選択</h3>
                                    <input
                                        type="file"
                                        id="fileElem"
                                        name="file"
                                        style={{ display: 'none' }}
                                        onChange={(e) => handleFiles(e.target.files)}
                                    />
                                    <label htmlFor="fileElem">ファイルを選択</label>
                                </div>
                                {/* <ul id="file-list">
                                    {files.map((file, index) => (
                                        <li key={index}>{file.name}</li>
                                    ))}
                                </ul> */}
                                <button type="submit">アップロード</button>
                            </form> 
                        </div>
                    </div>
                    <table class="bg-white text-center w-full border-collaple">
                        <thead>
                            <tr>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">状態</th>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">メモ</th>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">作成者</th>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">更新日</th>
                                <th class="py-4 px-6 bg-gray-lightest dark:bg-gray-darkest font-bold uppercase text-lg text-gray-dark dark:text-gray-200 border-b border-grey-light dark:border-grey-dark">バージョン</th>
                            </tr>
                        </thead>
                        <tbody>
                            {Documents.map(document => (
                                <tr>
                                    <td>{document.status}</td>
                                    <td>{document.note}</td>
                                    <td>{document.user_name}</td>
                                    <td>{new Date(document.updated_at).toLocaleString('ja-JP', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' })}</td>
                                    <td>{ document.version}</td>
                                    <td><button style={styles.button}
                                        onClick={() => loadPdf(document.path)}>View
                                        PDF</button></td>
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
                            onClick={goBack}
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