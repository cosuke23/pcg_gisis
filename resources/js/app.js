import './bootstrap';

import 'bootstrap';

document.addEventListener('DOMContentLoaded', () => {

    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('sidebarToggle');

    if (!sidebar || !toggle) {
        return;
    }

    // Below Bootstrap's lg breakpoint the sidebar is an off-canvas panel.
    const mobile = window.matchMedia('(max-width: 991.98px)');

    const backdrop = document.createElement('div');
    backdrop.className = 'sidebar-backdrop';
    document.body.appendChild(backdrop);

    const closeMobile = () => {
        sidebar.classList.remove('mobile-open');
        backdrop.classList.remove('show');
    };

    toggle.addEventListener('click', () => {

        if (mobile.matches) {
            const open = sidebar.classList.toggle('mobile-open');
            backdrop.classList.toggle('show', open);
        } else {
            sidebar.classList.toggle('collapsed');
        }

    });

    backdrop.addEventListener('click', closeMobile);

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeMobile();
        }
    });

    mobile.addEventListener('change', closeMobile);

});
