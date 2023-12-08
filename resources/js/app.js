import { createApp } from 'vue';
import LayoutComponent from './components/Layout.vue';
import OffersComponent from './components/Offers.vue';

const app = createApp(LayoutComponent);

app.component('offers', OffersComponent);

const appElement = document.getElementById('app');
const initialOffers = JSON.parse(appElement.getAttribute('data-offers'));

app.config.globalProperties.initialOffers = initialOffers;

app.mount('#app');
