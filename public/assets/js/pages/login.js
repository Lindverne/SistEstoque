document.addEventListener('DOMContentLoaded', function () {
    const btnEsqueciSenha = document.getElementById('btnEsqueciSenha');
    const errorMessage = document.body.dataset.loginError;
    const successMessage = document.body.dataset.loginSuccess;

    if (btnEsqueciSenha) {
        btnEsqueciSenha.addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                icon: 'info',
                title: 'Aviso! ＼(〇_〇)／',
                text: 'O mecanismo de recuperação de senhas não está implementado ainda.',
                confirmButtonColor: '#0d6efd'
            });
        });
    }

    if (errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Oops... (>-<)',
            text: errorMessage,
            confirmButtonColor: '#0d6efd'
        });
    }

    if (successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Prontinho!',
            text: successMessage,
            confirmButtonColor: '#0d6efd'
        });
    }
});
