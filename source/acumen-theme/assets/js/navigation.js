/**
 * Accessible Mobile Navigation & Header Scripts
 */
(function() {
  'use strict';

  var header = document.querySelector('.site-header');
  var toggleBtn = document.querySelector('.menu-toggle');
  var nav = document.querySelector('.main-navigation');

  // Sticky header class toggle on scroll
  if (header) {
    window.addEventListener('scroll', function() {
      if (window.scrollY > 20) {
        header.classList.add('is-scrolled');
      } else {
        header.classList.remove('is-scrolled');
      }
    }, { passive: true });
  }

  // Mobile menu toggle
  if (toggleBtn && nav) {
    toggleBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      var isExpanded = toggleBtn.getAttribute('aria-expanded') === 'true';
      toggleBtn.setAttribute('aria-expanded', !isExpanded);
      nav.classList.toggle('is-active');
    });

    // Close on click outside
    document.addEventListener('click', function(e) {
      if (!nav.contains(e.target) && !toggleBtn.contains(e.target) && nav.classList.contains('is-active')) {
        nav.classList.remove('is-active');
        toggleBtn.setAttribute('aria-expanded', 'false');
      }
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && nav.classList.contains('is-active')) {
        nav.classList.remove('is-active');
        toggleBtn.setAttribute('aria-expanded', 'false');
        toggleBtn.focus();
      }
    });
  }
})();
