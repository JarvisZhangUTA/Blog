
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

import VueResource from 'vue-resource';
window.Vue.use(VueResource);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('search-bar', require('./components/SearchBar.vue'));
Vue.component('topic-list-thumb', require('./components/TopicListThumb.vue'));
Vue.component('topic-list', require('./components/TopicList.vue'));
Vue.component('follow-button', require('./components/FollowButton.vue'));
Vue.component('editor', require('./components/Editor.vue'));

const app = new Vue({
    el: '#app'
});
