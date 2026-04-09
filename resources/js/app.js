import './bootstrap';

import 'flowbite';


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// tailwind.config.js
plugins: [
    require('flowbite/plugin')
]
