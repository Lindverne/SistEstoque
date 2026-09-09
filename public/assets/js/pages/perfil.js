document.addEventListener('DOMContentLoaded', function () {

    const pfpDropZone      = document.getElementById('pfpDropZone');
    const fotoPerfilReal   = document.getElementById('fotoPerfilReal');
    const pfpUrlInput      = document.getElementById('pfpUrlInput');
    const btnAplicarUrl    = document.getElementById('btnAplicarUrlPerfil');
    const statusText       = document.getElementById('pfp-status-text');
    const previewContainer = document.getElementById('pfpPreviewContainer');
    const previewEmpty     = document.getElementById('pfpPreviewEmpty');
    const previewImg       = document.getElementById('pfpPreviewImg');
    const hiddenFotoUrl    = document.getElementById('hiddenFotoUrl');
    const cropperImgEl     = document.getElementById('cropperImagePerfil');
    const btnSalvarCrop    = document.getElementById('btnSalvarCropPerfil');

    const perfilModalEl  = document.getElementById('perfilImageModal');
    const cropperModalEl = document.getElementById('cropperModal');
    const zoomModalEl    = document.getElementById('modalPfpZoom');

    const bsPerfilModal  = new bootstrap.Modal(perfilModalEl);
    const bsCropperModal = new bootstrap.Modal(cropperModalEl);
    const bsZoomModal    = new bootstrap.Modal(zoomModalEl);

    let cropperInstance = null;

    pfpDropZone.addEventListener('click', () => fotoPerfilReal.click());

    pfpDropZone.addEventListener('dragover', e => {
        e.preventDefault();
        pfpDropZone.classList.add('dragover');
    });
    pfpDropZone.addEventListener('dragleave', () => pfpDropZone.classList.remove('dragover'));
    pfpDropZone.addEventListener('drop', e => {
        e.preventDefault();
        pfpDropZone.classList.remove('dragover');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            abrirCropper(URL.createObjectURL(file));
        }
    });

    fotoPerfilReal.addEventListener('change', () => {
        const file = fotoPerfilReal.files[0];
        if (file) abrirCropper(URL.createObjectURL(file));
    });

    function abrirCropper(src) {
        bsPerfilModal.hide();
        cropperImgEl.src = src;
        cropperModalEl.addEventListener('shown.bs.modal', iniciarCropper, { once: true });
        bsCropperModal.show();
    }

    function iniciarCropper() {
        cropperInstance?.destroy();
        cropperInstance = new Cropper(cropperImgEl, {
            aspectRatio: 1,
            viewMode: 1,
            background: false,
            autoCropArea: 0.85,
        });
    }

    btnSalvarCrop.addEventListener('click', () => {
        if (!cropperInstance) return;

        cropperInstance.getCroppedCanvas({ width: 400, height: 400 }).toBlob(blob => {
            const url = URL.createObjectURL(blob);
            previewImg.src                 = url;
            previewContainer.style.display = 'block';
            previewEmpty.style.display     = 'none';
            statusText.textContent         = '✓ Imagem recortada e pronta para salvar';

            const dt   = new DataTransfer();
            const file = new File([blob], 'perfil_crop.jpg', { type: 'image/jpeg' });
            dt.items.add(file);
            fotoPerfilReal.files = dt.files;

            hiddenFotoUrl.value = '';
            pfpUrlInput.value   = '';

            bsCropperModal.hide();
            cropperInstance.destroy();
            cropperInstance = null;
        }, 'image/jpeg', 0.92);
    });

    cropperModalEl.addEventListener('hidden.bs.modal', () => {
        cropperInstance?.destroy();
        cropperInstance = null;
    });

    btnAplicarUrl.addEventListener('click', () => {
        const url = pfpUrlInput.value.trim();
        if (!url) return;

        hiddenFotoUrl.value            = url;
        fotoPerfilReal.value           = '';
        previewImg.src                 = url;
        previewContainer.style.display = 'block';
        previewEmpty.style.display     = 'none';
        statusText.textContent         = '✓ URL vinculada';

        bsPerfilModal.hide();
    });

    const pfpAtualImg = document.getElementById('pfpAtualImg');
    if (pfpAtualImg) {
        pfpAtualImg.addEventListener('click', function () {
            document.getElementById('modalPfpImg').src = this.src;
            bsZoomModal.show();
        });
    }

    const btnSair = document.getElementById('btnDeslogarSistema');
    if (btnSair) {
        btnSair.addEventListener('click', e => {
            e.preventDefault();
            Swal.fire({
                title: 'Deseja realmente sair? (・_・;)',
                text: 'Sua sessão atual no painel será encerrada.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sair',
                cancelButtonText: 'Permanecer'
            }).then(res => {
                if (res.isConfirmed) {
                    window.location.href = '../../api/controllers/logout.php';
                }
            });
        });
    }

    const urlParams = new URLSearchParams(window.location.search);
    const status    = urlParams.get('status');
    const dadosStatus = urlParams.get('dados_status');
    const dadosErro   = urlParams.get('dados_erro');
    const erro      = urlParams.get('erro');

    if (status === 'sucess') {
        Swal.fire({
            title: 'Foto Atualizada! ✨',
            text: 'Sua nova foto de perfil foi salva com sucesso.',
            icon: 'success',
            confirmButtonColor: '#0d6efd',
            confirmButtonText: 'Ótimo!',
            customClass: { popup: 'rounded-4 shadow-lg' }
        });
        limparParametrosUrl();
    }

    if (dadosStatus === 'sucesso') {
        Swal.fire({
            title: 'Dados Atualizados! (⌒‿⌒)',
            text: 'Suas informações de conta foram salvas com sucesso.',
            imageUrl: '../assets/img/global/atualizar.gif',
            imageWidth: 150,
            imageHeight: 150,
            imageAlt: 'Sucesso',
            confirmButtonColor: '#0d6efd',
            confirmButtonText: 'Ótimo!',
            customClass: { popup: 'rounded-4 shadow-lg' },
            didOpen: (popup) => {
                const img = popup.querySelector('.swal2-image');
                if (img) img.classList.add('swal2-image-round');
            }
        });
        limparParametrosUrl();
    }

    if (dadosErro) {
        Swal.fire({
            title: 'Oops... (>-<)',
            text: decodeURIComponent(dadosErro),
            icon: 'error',
            confirmButtonColor: '#dc3545',
            customClass: { popup: 'rounded-4 shadow-lg' }
        });
        limparParametrosUrl();
    }

    if (erro) {
        Swal.fire({
            icon: 'error',
            title: 'Oops... (>-<)',
            text: decodeURIComponent(erro),
            confirmButtonColor: '#dc3545',
            customClass: { popup: 'rounded-4 shadow-lg' }
        });
        limparParametrosUrl();
    }

});

function limparParametrosUrl() {
    if (window.history.replaceState) {
        window.history.replaceState({}, document.title, window.location.pathname);
    }
}