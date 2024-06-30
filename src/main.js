import { createApp } from 'vue';
import App from './App.vue';
import router from './router'; // Assuming you have a router setup
import axiosInstance from './axios-config.js'; // Import your custom Axios instance

const app = createApp(App);
app.use(router); // Use Vue Router if you have it

// Provide the Axios instance globally via a property on the app instance
app.config.globalProperties.$http = axiosInstance;

app.mount('#app');

// import { createApp } from 'vue';
// import App from './App.vue';
// import router from './router';

// const app = createApp(App);
// app.use(router);

// app.mount('#app');

// import Vue from 'vue';
// import App from './App.vue';
// import router from './router';

// new Vue({
//     router,
//     render: h => h(App),
// }).$mount('#app');


// import { createApp } from 'vue'
// import App from './App.vue'

// createApp(App).mount('#app')
