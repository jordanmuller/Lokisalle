import '../css/app.css';
import 'babel-polyfill'
import Routing from '../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';

const routes = require('../../public/js/fos_js_routes.json');
Routing.setRoutingData(routes);
global.Routing = Routing;

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');