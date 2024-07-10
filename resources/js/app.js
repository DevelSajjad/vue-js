import './bootstrap';
import { createApp } from 'vue';
import app from './components/app.vue';
import router from './router';


// const component = createApp({
//     components: {
//         app,
//     }
// });
// component.mount("#app");
createApp(app).use(router).mount("#app");
