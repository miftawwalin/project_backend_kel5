// Custom sidebar fix to prevent auto-opening of Data Master menu on dashboard
$(document).ready(function() {
    // Check if we're on dashboard page
    var currentPath = window.location.pathname;
    var isDashboard = currentPath === '/' || currentPath === '/dashboard' || currentPath.includes('dashboard');
    
    if (isDashboard) {
        // Force close all collapse menus on dashboard
        $('.collapse').removeClass('show');
        $('.nav-link[aria-expanded="true"]').attr('aria-expanded', 'false');
        
        // Remove active class from parent nav-items that shouldn't be active on dashboard
        $('.nav-item').each(function() {
            var $navItem = $(this);
            var $navLink = $navItem.find('.nav-link').first();
            
            // Skip if this is the dashboard link itself
            if ($navLink.attr('href') && ($navLink.attr('href').includes('dashboard') && !$navLink.attr('href').includes('inventory-dashboard'))) {
                return;
            }
            
            // Remove active class from non-dashboard items
            if ($navItem.hasClass('active') && !$navLink.attr('href').includes('/dashboard')) {
                $navItem.removeClass('active');
                $navLink.removeClass('active');
            }
        });
        
        console.log('Sidebar fixed for dashboard page');
    }
    
    // Prevent auto-expansion of menus unless explicitly clicked
    $('.nav-link[data-bs-toggle="collapse"]').on('click', function(e) {
        var target = $(this).attr('href');
        var $target = $(target);
        
        // Only allow manual toggle
        if (!$target.hasClass('show')) {
            $('.collapse').not($target).removeClass('show');
            $('.nav-link[aria-expanded="true"]').not(this).attr('aria-expanded', 'false');
        }
    });
});
