import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { Select, initTE, Modal, Ripple, } from "tw-elements";
initTE({ Select, Modal, Ripple });
