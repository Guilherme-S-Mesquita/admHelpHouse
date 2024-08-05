document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('#sidebar');
    const backdrop = document.querySelector('.backdrop');
    const toggleBtn = document.querySelector('.toggle-btn');

    toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('expanded'); // Adiciona ou remove a classe de expansão
        backdrop.classList.toggle('show-backdrop'); // Adiciona ou remove a classe de sobreposição
    });

    backdrop.addEventListener('click', function() {
        sidebar.classList.remove('expanded'); // Remove a classe de expansão
        backdrop.classList.remove('show-backdrop'); // Remove a classe de sobreposição
    });
});
