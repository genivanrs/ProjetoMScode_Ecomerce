function atualizarNumeroItensCarrinho() {
    $.ajax({
        type: "GET",
        url: "get_num_itens_carrinho.php",
        success: function(numItens) {
            $("#numItensCarrinho").text(numItens);
        },
        error: function() {
            // Lidar com erros, se necessário
        }
    });
}

// Chame a função para atualizar a contagem de itens no carrinho
atualizarNumeroItensCarrinho();

$(document).ready(function() {
    $(".adicionar_ao_carrinho").click(function(e) {
        location.reload(); // Recarrega a página
    });
});
