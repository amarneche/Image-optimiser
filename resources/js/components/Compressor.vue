<template>
    <div class="card px-2 py-1" style="border-radius: 30px;">
                    <div class="card-body text-nowrap text-truncate">
                        <h6 class="card-title fw-bold" style="margin-top: 20px;margin-bottom: 10px;">Convert them into :{{selectedFormat}}
                        </h6>
                        <div class="btn-group format-container" role="group" style="margin-bottom: 25px;">
                            <div class="format-selector" v-for="format in availableFormat" :key="format" >
                                <input type="radio" name="format" :id="format" :value="format" v-model="selectedFormat"  >
                                <label :for="format">{{ format}}</label>

                            </div>
                            </div>
                        <h6 class="card-title" style="font-weight: bold;">Conversion quality : {{selectedQuality}} %</h6>
                        <div class="row" style="margin-left: 0px;margin-bottom: 15px;">
                            <div class="col">
                                <input class="form-range" type="range" id="qualityRange"  
                                        v-model="selectedQuality"
                                        name="quality">
                            </div>
                        </div>
                        <div class="row mx-1">
                            <div class="col-sm-12 col-md-8 p-0 w-100">
                                <div class="d-flex justify-content-center align-items-center" id="chooseFile" @click="openFileExplorer">
                                    <input type="file" name="" id="fileInput" hidden  @change="changeImages" accept="image/*" multiple>
                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M24.1111 1H3.88889C2.2934 1 1 2.2934 1 3.88889V24.1111C1 25.7066 2.2934 27 3.88889 27H24.1111C25.7066 27 27 25.7066 27 24.1111V3.88889C27 2.2934 25.7066 1 24.1111 1Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.94444 11.1111C10.1411 11.1111 11.1111 10.1411 11.1111 8.94445C11.1111 7.74783 10.1411 6.77778 8.94444 6.77778C7.74782 6.77778 6.77777 7.74783 6.77777 8.94445C6.77777 10.1411 7.74782 11.1111 8.94444 11.1111Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M27 18.3333L19.7778 11.1111L3.88892 27" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                        
                                    <h6 class="mx-2"> Choose files </h6>
                                </div>
                            </div>

                        </div>
                    </div>
        </div>


</template>

<script>
let files = null;
export default {
    mounted() {
        console.log("Component mounted.");
    },
    data() {
        return {
            availableFormat: ["jpg", "jpeg", "png", "webp", "psd", "ico"],
            error: "",
            compressedFiles: [],
        };
    },
    props:['selectedFiles','selectedQuality','selectedFormat'],
    methods: {
        openFileExplorer: function(e){
            let fileInput= document.getElementById('fileInput');
            fileInput.click();
        },
        changeImages: function (e) {
            // for each image call upload the image to send a request !
            files = e.target.files;
            for (let i = 0; i < files.length; i++) {
                let file = files.item(i);
                this.$emit('file-selected',file);
                
            }
        },
        compress: function () {
           
        },


    },
};
</script>
