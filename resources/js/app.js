require('./bootstrap');
require('./favorite');
require('./deletePicture');
require('./follow');
// require('./addPicture');
require('./messageToCompany');
require('./messageToUser');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
