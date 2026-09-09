document.addEventListener('DOMContentLoaded', function () {

    const imagensProdutos = document.querySelectorAll('.item-zoom-trigger');
    const estruturaModal  = document.getElementById('previewFotoModal');

    if (estruturaModal && imagensProdutos.length > 0) {
        const bsModal      = new bootstrap.Modal(estruturaModal);
        const elementoNome = document.getElementById('modalNomeProduto');
        const elementoImg  = document.getElementById('modalImgPerfeita');

        imagensProdutos.forEach(img => {
            img.addEventListener('click', function () {
                elementoNome.textContent = this.getAttribute('data-product-name');
                elementoImg.src          = this.src;
                bsModal.show();
            });
            img.addEventListener('mouseenter', function () { this.style.transform = 'scale(1.08)'; });
            img.addEventListener('mouseleave', function () { this.style.transform = 'scale(1)'; });
        });
    }

    const btnSair = document.getElementById('btnDeslogarSistema');
    if (btnSair) {
        btnSair.addEventListener('click', function (e) {
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


    window.confirmarExclusao = function (id) {
        Swal.fire({
            title: 'Tem certeza? (º _ º)',
            text: 'Esta ação não pode ser desfeita no banco de dados!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sim, deletar!',
            cancelButtonText: 'Cancelar'
        }).then(res => {
            if (res.isConfirmed) {
                window.location.href = '../../api/controllers/excluir.php?id=' + encodeURIComponent(id);
            }
        });
    };

    const status = new URLSearchParams(window.location.search).get('status');
    if (status === 'cadastrado') {
        Swal.fire({
            title: 'Sucesso! (⌒‿⌒)',
            text: 'Produto cadastrado perfeitamente!',
            icon: 'success',
            confirmButtonColor: '#0d6efd',
            customClass: { popup: 'rounded-4 shadow-lg' }
        });
        limparParametrosUrl();
    } else if (status === 'atualizado') {
        Swal.fire({
            title: 'Atualizado! (0w0)',
            text: 'As alterações foram salvas com sucesso!',
            icon: 'success',
            confirmButtonColor: '#0d6efd',
            customClass: { popup: 'rounded-4 shadow-lg' }
        });
        limparParametrosUrl();
    } else if (status === 'deletado') {
        Swal.fire({
            title: 'Deletado! (>-<)',
            text: 'O item foi removido com sucesso!',
            icon: 'success',
            confirmButtonColor: '#0d6efd',
            customClass: { popup: 'rounded-4 shadow-lg' }
        });
        limparParametrosUrl();
    }

});
