export default {
  init() {
    // JavaScript to be fired on all pages
    document.documentElement.style.setProperty('--scrollbar-width', (window.innerWidth - document.documentElement.clientWidth) + 'px');
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
