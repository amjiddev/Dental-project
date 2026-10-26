"use strict";
(function() {
    function initSidebarToggle() {
        const sidebarToggle = document.querySelector('#kt_app_sidebar_toggle');
        const body = document.body;
        if (!sidebarToggle) {
            console.warn('Sidebar toggle button not found');
            return;
        }
        // Remove existing click listeners by cloning
        const newToggle = sidebarToggle.cloneNode(true);
        sidebarToggle.parentNode.replaceChild(newToggle, sidebarToggle);
        // Get the new element
        const toggle = document.querySelector('#kt_app_sidebar_toggle');
        // Direct click handler
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const isMinimized = body.getAttribute('data-kt-app-sidebar-minimize') === 'on';
            if (isMinimized) {
                // Expand
                body.removeAttribute('data-kt-app-sidebar-minimize');
                toggle.classList.remove('active');
                console.log('Sidebar expanded');
            } else {
                // Minimize
                body.setAttribute('data-kt-app-sidebar-minimize', 'on');
                toggle.classList.add('active');
                console.log('Sidebar minimized');
            }
            // Persist state
            const date = new Date(Date.now() + 30 * 24 * 60 * 60 * 1000);
            const cookieValue = isMinimized ? 'off' : 'on';
            document.cookie = 'sidebar_minimize_state=' + cookieValue + '; expires=' + date.toUTCString() + '; path=/';
        });
        console.log('Sidebar toggle initialized successfully');
    }
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSidebarToggle);
    } else {
        // Small delay to ensure Metronic scripts have loaded
        setTimeout(initSidebarToggle, 500);
    }
    // Also initialize after a short delay in case other scripts interfere
    setTimeout(initSidebarToggle, 1000);
})();
