import Vue from 'vue';
import router from './router';

import { LMap, LTileLayer, LMarker, LGridLayer, LGeoJson } from 'vue2-leaflet';
import { Icon } from 'leaflet'
import 'leaflet/dist/leaflet.css'
import VModal from 'vue-js-modal'
import _ from 'lodash';

import App from './components/App';

require('./bootstrap');

Vue.component('l-map', LMap);
Vue.component('l-tile-layer', LTileLayer);
Vue.component('l-marker', LMarker);
Vue.component('l-grid-layer', LGridLayer);
Vue.component('l-geo-json', LGeoJson);
Vue.use(VModal);

Object.defineProperty(Vue.prototype, '$_', { value: _ });

delete Icon.Default.prototype._getIconUrl;

Icon.Default.mergeOptions({
    iconRetinaUrl: require('leaflet/dist/images/marker-icon-2x.png'),
    iconUrl: require('leaflet/dist/images/marker-icon.png'),
    shadowUrl: require('leaflet/dist/images/marker-shadow.png')
});

const app = new Vue({
    el: '#app',
    components: {
        App
    },
    render: h => h(App),
    router
});
