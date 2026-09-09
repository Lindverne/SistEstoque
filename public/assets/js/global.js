document.addEventListener('DOMContentLoaded', () => {
    const urlParams   = new URLSearchParams(window.location.search);

    const loginParam = urlParams.get('login');
    if (loginParam === 'sucesso') {
        Swal.fire({
            title: 'Seja bem-vindo! ＼(=w=) /',
            text: 'Login efetuado com sucesso no SistEstoque.',
            imageUrl: '../assets/img/global/boas-vindas.gif',
            imageWidth: 150,
            imageHeight: 150,
            imageAlt: 'Boas-vindas',
            confirmButtonText: 'Começar',
            confirmButtonColor: '#0d6efd',
            customClass: { popup: 'rounded-4 shadow-lg' },
            didOpen: (popup) => {
                const img = popup.querySelector('.swal2-image');
                if (img) img.classList.add('swal2-image-round');
            }
        });
        limparParametrosUrl();
    }

    const logoutParam = urlParams.get('logout');
    if (logoutParam === 'sucesso') {
        Swal.fire({
            title: 'Sessão Encerrada! (╥﹏╥)',
            text: 'Você deslogou do SistEstoque. Tchau!',
            imageUrl: '../assets/img/global/tchau.gif',
            imageWidth: 150,
            imageHeight: 150,
            imageAlt: 'Tchau',
            confirmButtonText: 'Ok',
            confirmButtonColor: '#6c757d',
            customClass: { popup: 'rounded-4 shadow-lg' },
            didOpen: (popup) => {
                const img = popup.querySelector('.swal2-image');
                if (img) img.classList.add('swal2-image-round');
            }
        });
        limparParametrosUrl();
    }

    iniciarBotaoSobre();
});

function iniciarBotaoSobre() {
    const btn = document.createElement('button');
    btn.id        = 'btnSobreOSite';
    btn.title     = 'Sobre o Site';
    btn.innerHTML = '<img src="../assets/img/global/autores.gif" alt="Sobre" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">';
    document.body.appendChild(btn);

    btn.addEventListener('click', () => {
        Swal.fire({
            title: 'Autores do site',
            html: `
                <p>Julio Cesar Borges Leandro - N°24</p>
                <p>Matheus Guedes - N°33</p>
            `,
            imageUrl: '../assets/img/global/autores.gif',
            imageWidth: 120,
            imageHeight: 120,
            imageAlt: 'Sobre',
            confirmButtonText: 'Fechar',
            confirmButtonColor: '#0d6efd',
            customClass: { popup: 'rounded-4 shadow-lg' },
            didOpen: (popup) => {
                const img = popup.querySelector('.swal2-image');
                if (img) img.classList.add('swal2-image-round');
            }
        });
    });
}

function limparParametrosUrl() {
    if (window.history.replaceState) {
        window.history.replaceState({}, document.title, window.location.pathname);
    }
}