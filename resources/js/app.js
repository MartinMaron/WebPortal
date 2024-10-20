import './bootstrap.js';

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask'
import('../../vendor/usernotnull/tall-toasts/dist/js/tall-toasts.js')
    .then(() => {
        // After loading, set the ToastComponent to Alpine
        Alpine.data('ToastComponent', window.Toast); // Use the global Toast object
    })
    .catch((error) => {
        console.error('Failed to load ToastComponent:', error); // Handle errors
    });
Alpine.plugin(mask)
window.Alpine = Alpine;
Alpine.start();
