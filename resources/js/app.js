// ---------------------------------------------------------
// CoreUI + Laravel JS setup
// ---------------------------------------------------------

// Import your SCSS file so Vite bundles it
import '../css/app.scss';

// Import CoreUI JS library
import * as coreui from '@coreui/coreui';

// Optionally, import Bootstrap’s JS helpers (CoreUI includes Bootstrap base)
import 'bootstrap';

// Optional: initialize CoreUI components when the DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  console.log('CoreUI Admin Loaded ✅');
});
