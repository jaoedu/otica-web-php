import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const uploadContent = document.getElementById('uploadContent');
    const uploadPreview = document.getElementById('uploadPreview');
    const previewImage = document.getElementById('previewImage');
    const previewFile = document.getElementById('previewFile');
    const changeFile = document.getElementById('changeFile');

    if (!dropZone) return;

    function renderPreview(file) {
        previewFile.textContent = file.name;

        uploadContent.classList.add('hidden');
        uploadPreview.classList.remove('hidden');

        if (file.type.includes('image')) {
            previewImage.classList.remove('hidden');

            const reader = new FileReader();

            reader.onload = e => {
                previewImage.src = e.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            previewImage.classList.add('hidden');
            previewFile.textContent = '📄 ' + file.name;
        }
    }

    fileInput.addEventListener('change', e => {
        const file = e.target.files[0];
        if (file) renderPreview(file);
    });

    changeFile.addEventListener('click', () => {
        fileInput.click();
    });

    ['dragenter', 'dragover'].forEach(event => {
        dropZone.addEventListener(event, e => {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });
    });

    ['dragleave', 'drop'].forEach(event => {
        dropZone.addEventListener(event, e => {
            e.preventDefault();
            dropZone.classList.remove('dragover');
        });
    });

    dropZone.addEventListener('drop', e => {
        const file = e.dataTransfer.files[0];

        if (!file) return;

        fileInput.files = e.dataTransfer.files;

        renderPreview(file);
    });
});
