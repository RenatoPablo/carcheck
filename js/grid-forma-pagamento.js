// Função para abrir o modal
document.getElementById('openModal').onclick = function() {
    document.getElementById('cadastroFormaPagamentoModal').style.display = 'block';
}

// Função para fechar o modal
document.querySelector('.modal-close').onclick = function() {
    document.getElementById('cadastroFormaPagamentoModal').style.display = 'none';
}

// Fecha o modal ao clicar fora da área de conteúdo
window.onclick = function(event) {
    const modal = document.getElementById('cadastroFormaPagamentoModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
    
// Função para abrir o modal com as ações (update ou delete)
function openModal(action, paymentMethod) {
    const modal = new bootstrap.Modal(document.getElementById('actionModal'));
    const modalMessage = document.getElementById('modalMessage');
    const updateForm = document.getElementById('updateForm');
    const deleteConfirmBtn = document.getElementById('deleteConfirmBtn');

    // Reseta o modal
    updateForm.classList.add('d-none');
    deleteConfirmBtn.classList.add('d-none');

    if (action === 'update') {
        document.getElementById('formaPagamento').value = paymentMethod;
        modalMessage.textContent = `Editar a forma de pagamento: ${paymentMethod}`;
        updateForm.classList.remove('d-none'); // Mostra o formulário de update
    } else if (action === 'delete') {
        modalMessage.textContent = `Tem certeza que deseja excluir a forma de pagamento: ${paymentMethod}?`;
        deleteConfirmBtn.classList.remove('d-none'); // Mostra o botão de exclusão
    }

    modal.show();
}