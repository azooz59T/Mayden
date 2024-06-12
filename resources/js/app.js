import Sortable from 'sortablejs';

require('./bootstrap');
window.$ = window.jQuery = require('jquery');

document.addEventListener('DOMContentLoaded', function() {
    const sortable = new Sortable(document.querySelector('tbody'), {
        // SortableJS options here
    });

    // Add event listeners and other SortableJS logic here
});
