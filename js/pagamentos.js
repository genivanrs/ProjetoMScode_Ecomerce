// JavaScript para controlar o modal
var modal = document.getElementById("modalPix");
var btnEfetuarPagamento = document.getElementById("btnEfetuarPagamento");
var btnFinalizarPagamento = document.getElementById("btnFinalizarPagamento");
var closeModal = document.getElementById("closeModal");

// Quando o botão "Efetuar Pagamento via PIX" é clicado, exiba o modal
btnEfetuarPagamento.onclick = function() {
    modal.style.display = "block";
}

// Quando o botão "X" (closeModal) é clicado, feche o modal
closeModal.onclick = function() {
    modal.style.display = "none";
}

// Quando o botão "Finalizar Pagamento" é clicado, você pode adicionar a lógica para finalizar o pagamento via PIX
btnFinalizarPagamento.onclick = function() {
    // Adicione a lógica para finalizar o pagamento via PIX aqui
    alert("Pagamento via PIX finalizado.");
}

// Quando o usuário clica em qualquer lugar fora do modal, feche-o
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
