document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.querySelector('.toggle-btn');
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');

    toggleButton.addEventListener('click', function() {
        sidebar.classList.toggle('expanded');
        content.classList.toggle('expanded');
    });
});
