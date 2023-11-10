const senha = document.getElementById('senha');
const confirmaSenha = document.getElementById('confirmaSenha');
const form = document.querySelector('form');
const erroMensagem = document.getElementById('erro-mensagem');

form.addEventListener('submit', function (event) {
    if (senha.value !== confirmaSenha.value) {
        erroMensagem.innerHTML = "As senhas não coincidem.";
        erroMensagem.style.display = "block"; // Exibe a div de erro
        event.preventDefault(); // Impede o envio do formulário
    } else {
        erroMensagem.style.display = "none"; // Oculta a div de erro se as senhas coincidirem
        const sucesso = true;
        
    }
});

