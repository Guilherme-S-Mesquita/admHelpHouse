document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.querySelector('#sidebar');
    const backdrop = document.querySelector('.backdrop');
    const toggleBtn = document.querySelector('.toggle-btn');






    toggleBtn.addEventListener('click', function() {
        console.log('Toggle button clicked');
        sidebar.classList.toggle('expanded');
        backdrop.classList.toggle('show-backdrop');
    });




});
