document.addEventListener('DOMContentLoaded', function(){
    var sidebar = document.getElementById('sidebar');
    var toggleBtn = document.getElementById('sidebarToggle');
    var toggleBtnMobile = document.getElementById('sidebarToggleMobile');
    var overlay = document.getElementById('overlay');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            console.log('desktop toggle clicked');
            sidebar.classList.toggle('collapsed');
            document.body.classList.toggle('sidebar-collapsed');

            if (sidebar.classList.contains('collapsed')) {
                toggleBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 16 16" fill="none">
                    <path fill="#deefff" fill-rule="evenodd" d="M3.25 1A2.25 2.25 0 001 3.25v9.5A2.25 2.25 0 003.25 15h9.5A2.25 2.25 0 0015 12.75v-9.5A2.25 2.25 0 0012.75 1h-9.5zM2.5 3.25a.75.75 0 01.75-.75h1.8v11h-1.8a.75.75 0 01-.75-.75v-9.5zM6.45 13.5h6.3a.75.75 0 00.75-.75v-9.5a.75.75 0 00-.75-.75h-6.3v11z" clip-rule="evenodd"/>
                </svg>`;
            } else {
                toggleBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 16 16" fill="none">
                    <g fill="#deefff">
                        <path d="M11.726 5.263a.7.7 0 10-.952-1.026l-3.5 3.25a.7.7 0 000 1.026l3.5 3.25a.7.7 0 00.952-1.026L8.78 8l2.947-2.737z"/>
                        <path fill-rule="evenodd" d="M1 3.25A2.25 2.25 0 013.25 1h9.5A2.25 2.25 0 0115 3.25v9.5A2.25 2.25 0 0112.75 15h-9.5A2.25 2.25 0 011 12.75v-9.5zm2.25-.75a.75.75 0 00-.75.75v9.5c0 .414.336.75.75.75h1.3v-11h-1.3zm9.5 11h-6.8v-11h6.8a.75.75 0 01.75.75v9.5a.75.75 0 01-.75.75z" clip-rule="evenodd"/>
                    </g>
                </svg>`;
            }
        });
    } else {
        console.warn('sidebarToggle button not found');
    }

    if (toggleBtnMobile) {
        toggleBtnMobile.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
            document.body.classList.toggle('sidebar-open');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            document.body.classList.remove('sidebar-open');
        });
    }

    var currentPath = window.location.pathname.replace(/\/+$/, '') || '/';
    document.querySelectorAll('.sidebar__menu__block-link').forEach(function(el){
        var href = el.getAttribute('href') || '';
        if (href === '#' || href.trim() === '') return;

        try {
            var anchor = document.createElement('a');
            anchor.href = href;
            var menuPath = anchor.pathname.replace(/\/+$/, '') || '/';
            if (menuPath === currentPath) {
                el.classList.add('active');
            }
        } catch(e){
            console.warn('Error:', href, e);
        }
    });
});
