// Código JavaScript para exibir mensagens de erro
document.addEventListener("DOMContentLoaded", function() {
    let mensagemErro = document.getElementById('erro-mensagem');
    const urlParams = new URLSearchParams(window.location.search);
    const erro = urlParams.get('erro');

    if (erro) {
        mensagemErro.style.display = 'block';
        mensagemErro.innerText = erro;
    }
});


//form do login
document.addEventListener('DOMContentLoaded', function() {
    
    console.log("JavaScript está sendo executado");

    const loginLink = document.getElementById('login-link');
    console.log(loginLink); // Verifica se o elemento foi encontrado
    const loginContainer = document.querySelector('.login-container');

    // Quando o usuário clica em "Login", exibe o formulário
    loginLink.addEventListener('click', (event) => {
        event.preventDefault(); // Impede o link de navegar para outra página
        console.log("Clique no link 'Login'");
        loginContainer.style.display = 'flex';
        loginContainer.style.zIndex = '999';
    });

    // Adicione um evento para ocultar o formulário quando o usuário clica fora dele
    loginContainer.addEventListener('click', (event) => {
        if (event.target === loginContainer) {
            loginContainer.style.display = 'none';
        }
    });
    
});




