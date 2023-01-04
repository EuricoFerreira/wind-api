import './bootstrap';
import router from './routes';
import Auth from './auth';

import { createApp } from 'vue';

import App from './components/AppComponent.vue';

const app = createApp(App);
  
    app.use(router)
    .mount("#app");