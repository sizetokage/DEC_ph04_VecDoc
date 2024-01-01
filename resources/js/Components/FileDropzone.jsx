import React from 'react';
import { useDropzone } from 'react-dropzone';

export function FileDropzone({ onFileChange }) {
    const { acceptedFiles, getRootProps, getInputProps } = useDropzone(
        {
            onDrop: acceptedFiles => {
                onFileChange(acceptedFiles);
            }
        }
    );

    const files = acceptedFiles.map(file => (
        <li key={file.path}>
            {file.path} - {file.size} bytes
        </li>
    ));

    return (
        <section className="container">
            <div {...getRootProps({ className: 'dropzone' })}>
                <input {...getInputProps()} />
                <p>ファイルをドロップしてください</p>
            </div>
            <aside>
                <h4></h4>
                <ul>{files}</ul>
            </aside>
        </section>
    );
}