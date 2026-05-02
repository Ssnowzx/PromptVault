// Cofre de Engenharia de Prompts - JS Utilities
document.addEventListener('DOMContentLoaded', function() {
    // Auto-dismiss flash messages
    const flash = document.querySelector('.flash-message');
    if (flash) {
        setTimeout(() => {
            flash.style.opacity = '0';
            flash.style.transform = 'translateY(-10px)';
            setTimeout(() => flash.remove(), 300);
        }, 4000);
    }

    // Confirm delete
    document.querySelectorAll('[data-confirm]').forEach(el => {
        el.addEventListener('click', function(e) {
            if (!confirm(this.dataset.confirm)) {
                e.preventDefault();
            }
        });
    });

    // Mobile sidebar toggle
    const sidebar = document.querySelector('.sidebar');
    const topBar = document.querySelector('.top-bar');

    if (sidebar && topBar) {
        // Create mobile toggle button
        const toggleBtn = document.createElement('button');
        toggleBtn.id = 'sidebarToggle';
        toggleBtn.className = 'btn-outline btn-sm d-md-none me-3';
        toggleBtn.innerHTML = '<i class="bi bi-list" style="font-size: 1.2rem; line-height: 1;"></i>';
        toggleBtn.style.border = 'none';
        toggleBtn.style.padding = '0.2rem 0.5rem';
        
        // Insert it at the beginning of top-bar
        topBar.insertBefore(toggleBtn, topBar.firstChild);

        // Create overlay
        const overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay d-md-none';
        document.body.appendChild(overlay);

        function toggleSidebar() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        toggleBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
    }
});
