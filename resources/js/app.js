import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import ExampleComponent from './Components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

app.mount('#app');
