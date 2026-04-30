<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function() {
            // Pega os dados do botão
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const email = this.getAttribute('data-email');
            const phone = this.getAttribute('data-phone');

            // Joga os dados nos campos do Modal de Edição
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_phone').value = phone;

            // Abre o Modal de Edição
            var myModal = new bootstrap.Modal(document.getElementById('editDataModal'));
            myModal.show();
        });
    });
</script>

</body>

</html>