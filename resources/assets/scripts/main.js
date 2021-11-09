// import external dependencies
import 'jquery';
// import '@fortawesome/fontawesome-free/js/all.min.js';

// import then needed Font Awesome functionality
import { library, dom } from '@fortawesome/fontawesome-svg-core';
// import the Facebook and Twitter icons
import { faSearch, faCheck, faFilePdf, faBars} from '@fortawesome/free-solid-svg-icons';
import { faLinkedin, faFacebookF} from '@fortawesome/fontawesome-free-brands';

// add the imported icons to the library
library.add(faSearch, faCheck, faFilePdf, faLinkedin, faFacebookF, faBars);

// tell FontAwesome to watch the DOM and add the SVGs when it detects icon markup
dom.watch();

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
