/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import axios from 'axios';
import { v4 as uuidv4 } from 'uuid';
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('compressor', require('./components/Compressor.vue').default);
Vue.component('compressed-file', require('./components/CompressedFile.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el:"#app",
    data:()=>{
        return{
            selectedFiles: [],
            selectedQuality:75,
            selectedFormat:'jpg'
        }
    },
    methods:{
        addFile(file){
            this.selectedFiles.push(file);
        },
        changeFormat(format){
            this.selectedFormat=format;
        },
        changeQuality(quality){
            this.selectedQuality=quality;
        },
        reset(){
            this.selectedFiles=[];
            this.selectedQuality=75;
            this.selectedFormat='jpg';
        }

    }
});
