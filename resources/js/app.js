require('./bootstrap');


/*
|----------------------------------------------------------------------------
| Import Vue
|----------------------------------------------------------------------------
|
| Here we import the vue node module and put it in the window, the object
| containing the DOM document.
|
*/

window.Vue = require('vue');


/*
|----------------------------------------------------------------------------
| Add Vue Components
|----------------------------------------------------------------------------
|
| Here we add vue components to make them available inside the window
| object.
|
*/

Vue.component('example-component', require('./components/Example.vue').default);
Vue.component('c-basic', require('./components/Basic.vue').default);
Vue.component('c-name', require('./components/Name.vue').default);
Vue.component('c-friends', require('./components/Friends.vue').default);
Vue.component('c-friends-plus', require('./components/FriendsPlus.vue').default);
Vue.component('c-friends-if', require('./components/FriendsIf.vue').default);

/*
|----------------------------------------------------------------------------
| Instantiate Vue
|----------------------------------------------------------------------------
|
| Here we instantiate the vue on a component with the id #app. Therefore all
| the vue modules added in app.js will be available inside this component.
|
*/

window.onload = function(e) {
    const app = new Vue({
        el: '#app'
    });
}