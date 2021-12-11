/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import axios from 'axios';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
let files =null;
const app = new Vue({
    data(){
        return{
            availableFormat:['jpg','jpeg','png','webp','psd','ico'],
            compressionRate:75,
            selectedFormat:'jpg',
            selectedFiles:[],
            error:"",
            compressedFiles:[],

        }
    },
    methods:{
        changeImages:function (e){
            // for each image call upload the image to send a request ! 
            files=e.target.files;
            for (let i=0; i<files.length ; i++){
                let file= files.item(i);
                var fd = new FormData;
                fd.append('files[0]',file);
                fd.append('format',this.selectedFormat);
                fd.append('quality',this.compressionRate);
                this.upload(fd);

            }
        },
        upload :function (data ){
            let self=this;
            axios.post("/api/compress/",data)
            .then(res => {
                
                res.data.response.forEach(function(item){
                    self.compressedFiles.push(item);
                });
                console.log(res);
               
            })
            .catch(err => {
                self.error=err;
                console.error(err); 
            })
        },
        download :function(index){
            let self=this;
            axios.post("/api/download",{
                'path':this.compressedFiles[index].path,
                'filename':this.compressedFiles[index].name
            })
            .then(res => {
                console.log(res)
            })
            .catch(err => {
                self.error=err;
                console.error(err); 
            })
        }
    },
    el: '#app',
});
