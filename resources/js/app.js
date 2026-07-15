import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

if (document.querySelector('meta[name="is-public-page"]')) {
    import('sienna-accessibility');
}
