import './bootstrap';

import createContact from './components/contacts/create.vue'
import indexContact from './components/contacts/index.vue'
import editContact from './components/contacts/edit.vue'
import {createApp} from "vue/dist/vue.esm-bundler.js";

const app = createApp({})
app.component('create-contact', createContact)
app.component('index-contact', indexContact)
app.component('edit-contact', editContact)

app.mount('#app')