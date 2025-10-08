(function($) {
  'use strict';
  
  // Ensure DOM is ready and jQuery is available
  $(document).ready(function() {
    
    console.log('Theme switcher initializing...');
    
    // Check if elements exist
    if (!$('.settings-sidebar-toggler').length) {
      console.error('Settings sidebar toggler not found!');
      return;
    }
    
    console.log('Settings sidebar toggler found:', $('.settings-sidebar-toggler').length);
    
    // Function to update sidebar logo based on theme
    function updateSidebarLogo(sidebarTheme) {
      var $logo = $('#sidebar-logo');
      if ($logo.length) {
        // Get the base URL from the current logo src to maintain Laravel's asset() helper path
        var currentSrc = $logo.attr('src');
        var basePath = currentSrc.substring(0, currentSrc.lastIndexOf('/') + 1);
        
        var logoPath = sidebarTheme === 'sidebar-dark' 
          ? basePath + 'logowhite.png'
          : basePath + 'logo.png';
        
        // Create a new image to test if the logo exists before changing
        var testImg = new Image();
        testImg.onload = function() {
          $logo.attr('src', logoPath);
          console.log('Logo successfully updated to:', logoPath);
        };
        testImg.onerror = function() {
          console.error('Failed to load logo:', logoPath);
          // Fallback to original logo if white logo fails to load
          if (sidebarTheme === 'sidebar-dark') {
            $logo.attr('src', basePath + 'logo.png');
            console.log('Fallback: Using regular logo for dark theme');
          }
        };
        testImg.src = logoPath;
      } else {
        console.error('Logo element with id "sidebar-logo" not found');
      }
    }
    
    // Get current theme from localStorage or default to light
    var currentTheme = localStorage.getItem('theme') || 'light';
    var currentSidebarTheme = localStorage.getItem('sidebarTheme') || 'sidebar-light';
    
    // Apply saved theme on page load
    console.log('Initializing themes - Main:', currentTheme, 'Sidebar:', currentSidebarTheme);
    applyTheme(currentTheme);
    applySidebarTheme(currentSidebarTheme);
    
    // Update UI to reflect current theme
    updateThemeUI(currentTheme);
    updateSidebarThemeUI(currentSidebarTheme);
    
    // Ensure logo is updated on page load
    updateSidebarLogo(currentSidebarTheme);
    
    // Add test functions to window for debugging
    window.testSidebarTheme = function(theme) {
      console.log('Testing sidebar theme:', theme);
      applySidebarTheme(theme);
      updateSidebarThemeUI(theme);
    };
    
    // Debug function to test logo switching
    window.testLogoSwitch = function() {
      console.log('Testing logo switch...');
      var $logo = $('#sidebar-logo');
      if ($logo.length) {
        console.log('Current logo src:', $logo.attr('src'));
        console.log('Current body classes:', document.body.className);
        
        // Test dark logo
        updateSidebarLogo('sidebar-dark');
        
        // Test light logo after 2 seconds
        setTimeout(function() {
          updateSidebarLogo('sidebar-light');
        }, 2000);
      } else {
        console.error('Logo element not found!');
      }
    };
    
    window.getCurrentThemes = function() {
      console.log('Current themes:', {
        main: localStorage.getItem('theme') || 'light',
        sidebar: localStorage.getItem('sidebarTheme') || 'sidebar-light',
        bodyClasses: document.body.className
      });
    };
    
    // Theme item click handlers (Light/Dark theme images)
    $('.theme-item').on('click', function(e) {
      e.preventDefault();
      var theme = $(this).data('theme');
      
      if (theme) {
        // Apply the theme
        applyTheme(theme);
        
        // Save to localStorage
        localStorage.setItem('theme', theme);
        
        // Update UI
        updateThemeUI(theme);
        
        // Update sidebar theme accordingly
        var sidebarTheme = theme === 'dark' ? 'sidebar-dark' : 'sidebar-light';
        applySidebarTheme(sidebarTheme);
        localStorage.setItem('sidebarTheme', sidebarTheme);
        updateSidebarThemeUI(sidebarTheme);
        
        console.log('Theme switched to:', theme);
      }
    });
    
    // Sidebar theme radio button handlers (with debugging)
    $(document).off('change', "input:radio[name=sidebarThemeSettings]"); // Remove any existing handlers
    $(document).on('change', "input:radio[name=sidebarThemeSettings]", function() {
      var sidebarTheme = $(this).val();
      console.log('Sidebar theme radio changed to:', sidebarTheme);
      
      // Apply sidebar theme
      applySidebarTheme(sidebarTheme);
      
      // Save to localStorage
      localStorage.setItem('sidebarTheme', sidebarTheme);
      
      console.log('Sidebar theme applied:', sidebarTheme);
      console.log('Body classes after sidebar change:', $('body')[0].className);
    });
    
    // Function to apply main theme (light/dark)
    function applyTheme(theme) {
      var $body = $('body');
      var $head = $('head');
      var currentStylesheet = $head.find('#theme-stylesheet');
      
      // Add loading state
      $body.addClass('theme-loading');
      
      // Create new stylesheet element
      var stylesheetPath = theme === 'dark' 
        ? window.location.origin + '/assets/css/demo2/style.css' 
        : window.location.origin + '/assets/css/demo1/style.css';
      
      var newStylesheet = $('<link>', {
        id: 'theme-stylesheet-temp',
        rel: 'stylesheet',
        href: stylesheetPath
      });
      
      // Load new stylesheet
      newStylesheet.on('load', function() {
        // Remove old stylesheet
        if (currentStylesheet.length) {
          currentStylesheet.remove();
        }
        
        // Replace temp stylesheet with permanent one
        $(this).attr('id', 'theme-stylesheet');
        
        // Add theme class to body
        $body.removeClass('theme-light theme-dark').addClass('theme-' + theme);
        
        // Remove loading state
        setTimeout(function() {
          $body.removeClass('theme-loading');
        }, 100);
        
        // Update charts if they exist
        if (typeof updateChartsTheme === 'function') {
          updateChartsTheme(theme);
        }
        
        // Re-initialize feather icons
        if (typeof feather !== 'undefined') {
          feather.replace();
        }
      });
      
      // Handle load error
      newStylesheet.on('error', function() {
        console.error('Failed to load theme stylesheet:', stylesheetPath);
        $body.removeClass('theme-loading');
      });
      
      // Append new stylesheet to head
      $head.append(newStylesheet);
    }
    
    // Function to apply sidebar theme
    function applySidebarTheme(sidebarTheme) {
      console.log('Applying sidebar theme:', sidebarTheme);
      var $body = $('body');
      
      // Remove all existing sidebar theme classes
      $body.removeClass('sidebar-light sidebar-dark');
      
      // Add new sidebar theme class
      $body.addClass(sidebarTheme);
      
      // Update sidebar logo based on theme
      updateSidebarLogo(sidebarTheme);
      
      console.log('Body classes after applying sidebar theme:', $body[0].className);
      
      // Force a repaint to ensure styles are applied
      $body[0].offsetHeight;
    }
    
    // Function to update theme UI indicators
    function updateThemeUI(theme) {
      $('.theme-item').removeClass('active');
      $('.theme-item[data-theme="' + theme + '"]').addClass('active');
    }
    
    // Function to update sidebar theme UI
    function updateSidebarThemeUI(sidebarTheme) {
      $('input:radio[name=sidebarThemeSettings]').prop('checked', false);
      $('input:radio[name=sidebarThemeSettings][value="' + sidebarTheme + '"]').prop('checked', true);
    }
    
    // Function to update charts theme (if needed)
    window.updateChartsTheme = function(theme) {
      // This function can be extended to update ApexCharts themes
      // For now, it's just a placeholder
      console.log('Updating charts theme to:', theme);
      
      // You can add specific chart theme updates here
      // For example, updating ApexCharts theme
      if (window.ApexCharts) {
        // Update existing charts theme
        // This would require chart instances to be globally accessible
      }
    };
    
    // Settings sidebar toggle with multiple event bindings
    function toggleSettings(e) {
      e.preventDefault();
      e.stopPropagation();
      console.log('Settings button clicked!');
      
      var isOpen = $('body').hasClass('settings-open');
      console.log('Current state:', isOpen ? 'open' : 'closed');
      
      $('body').toggleClass('settings-open');
      
      // Add visual feedback
      $('.settings-sidebar-toggler').addClass('clicked');
      setTimeout(function() {
        $('.settings-sidebar-toggler').removeClass('clicked');
      }, 200);
      
      console.log('New state:', $('body').hasClass('settings-open') ? 'open' : 'closed');
    }
    
    // Multiple event bindings to ensure it works
    $('.settings-sidebar-toggler').on('click', toggleSettings);
    $('.settings-sidebar-toggler').on('touchstart', toggleSettings);
    
    // Direct event binding as fallback
    document.addEventListener('click', function(e) {
      if (e.target.closest('.settings-sidebar-toggler')) {
        toggleSettings(e);
      }
    });
    
    // Also handle click on settings sidebar overlay to close
    $(document).on('click', function(e) {
      if ($('body').hasClass('settings-open') && 
          !$(e.target).closest('.settings-sidebar, .settings-sidebar-toggler').length) {
        $('body').removeClass('settings-open');
      }
    });
    
  });
  
})(jQuery);
