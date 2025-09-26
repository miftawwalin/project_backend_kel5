// Simple test script for settings functionality
console.log('Settings test script loaded');

// Test function to manually toggle settings
window.testToggleSettings = function() {
  console.log('Manual test toggle');
  document.body.classList.toggle('settings-open');
  console.log('Body classes:', document.body.className);
};

// Test if elements exist
document.addEventListener('DOMContentLoaded', function() {
  console.log('DOM loaded, checking elements...');
  
  const toggler = document.querySelector('.settings-sidebar-toggler');
  const sidebar = document.querySelector('.settings-sidebar');
  
  console.log('Settings toggler found:', !!toggler);
  console.log('Settings sidebar found:', !!sidebar);
  
  if (toggler) {
    console.log('Toggler position:', window.getComputedStyle(toggler).position);
    console.log('Toggler z-index:', window.getComputedStyle(toggler).zIndex);
    console.log('Toggler right:', window.getComputedStyle(toggler).right);
    console.log('Toggler visibility:', window.getComputedStyle(toggler).visibility);
  }
  
  // Add manual click test
  if (toggler) {
    toggler.addEventListener('click', function(e) {
      console.log('Click event detected on settings toggler!');
    });
  }
});

// Global function to test settings
window.openSettings = function() {
  document.body.classList.add('settings-open');
  console.log('Settings opened manually');
};

window.closeSettings = function() {
  document.body.classList.remove('settings-open');
  console.log('Settings closed manually');
};

// Test sidebar themes
window.testSidebarLight = function() {
  document.body.classList.remove('sidebar-dark');
  document.body.classList.add('sidebar-light');
  localStorage.setItem('sidebarTheme', 'sidebar-light');
  console.log('Sidebar theme changed to light manually');
};

window.testSidebarDark = function() {
  document.body.classList.remove('sidebar-light');
  document.body.classList.add('sidebar-dark');
  localStorage.setItem('sidebarTheme', 'sidebar-dark');
  console.log('Sidebar theme changed to dark manually');
};

// Check current sidebar theme
window.checkSidebarTheme = function() {
  const hasLight = document.body.classList.contains('sidebar-light');
  const hasDark = document.body.classList.contains('sidebar-dark');
  const stored = localStorage.getItem('sidebarTheme');
  
  console.log('Sidebar theme status:', {
    hasLightClass: hasLight,
    hasDarkClass: hasDark,
    storedTheme: stored,
    allBodyClasses: document.body.className
  });
};
