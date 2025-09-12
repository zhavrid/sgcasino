document.addEventListener('DOMContentLoaded', function(){
    console.log('sidebar.js loaded (Lovable version)');

    var sidebar = document.getElementById('sidebar');
    var toggleBtn = document.getElementById('sidebarToggle');
    var main = document.getElementById('main') || document.querySelector('.main-content');

    console.log('elements:', {
        sidebar: !!sidebar,
        toggleBtn: !!toggleBtn,
        main: !!main
    });

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function(){
            console.log('sidebar toggle clicked');
            sidebar.classList.toggle('collapsed');
            document.body.classList.toggle('sidebar-collapsed');

            if(sidebar.classList.contains('collapsed')){
                toggleBtn.textContent = '⮞';
            } else {
                toggleBtn.textContent = '⮜';
            }
        });
    } else {
        console.warn('sidebarToggle button not found');
    }
});
