import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { initTE,
         Select, Modal, Ripple, Toast } from "tw-elements";
initTE({ Select, Modal, Ripple, Toast });
