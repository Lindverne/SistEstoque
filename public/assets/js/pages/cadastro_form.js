document.addEventListener('DOMContentLoaded', function () {
    const status = document.body.dataset.status || '';

    if (status === 'erro_existe') {
        Swal.fire({
            icon: 'error',
            title: 'Oops... (>-<)',
            text: 'Este nome de usuário já está sendo utilizado!',
            confirmButtonColor: '#0d6efd'
        });
    } else if (status === 'erro_banco') {
        Swal.fire({
            icon: 'error',
            title: 'Erro interno ＼(=-=)/',
            text: 'Não foi possível salvar ou se comunicar com o banco de dados. Tente de novo!',
            confirmButtonColor: '#0d6efd'
        });
    }
});
