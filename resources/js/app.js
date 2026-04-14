import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

import 'flowbite';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import flatpickr from 'flatpickr';
import { Spanish } from 'flatpickr/dist/l10n/es.js';
import 'flatpickr/dist/flatpickr.min.css';

document.addEventListener('DOMContentLoaded', function () {
    flatpickr('#renewal_date', {
        locale: Spanish,
        dateFormat: 'Y-m-d',        // formato que guarda en BD
        altInput: true,             // muestra un input visual separado
        altFormat: 'd/m/Y',         // formato que ve el usuario
        minDate: 'today',           // no permite fechas pasadas
        allowInput: true,           // permite escribir a mano también
    });
});

// tailwind.config.js
plugins: [
    require('flowbite/plugin')
]
