<template>
    <div class="row w-md-50 mx-auto">
        <div class="col sm-12">
            <div class="card rounded border-red shadow">
                <div class="card-header">
                    <div class="card-title text-center p-5">
                        <form
                            @submit.prevent
                            action="/api/compress"
                            method="post"
                            enctype="multipart/form-data"
                        >
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <strong> Convert images to : </strong>
                                </div>
                                <div class="col-sm-6">
                                    <div
                                        class="btn-group"
                                        role="group"
                                        aria-label="basic"
                                    >
                                        <div
                                            v-for="format in availableFormat"
                                            :key="format"
                                            class="mx-1"
                                        >
                                            <input
                                                type="radio"
                                                class="btn-check"
                                                name="format"
                                                :id="format"
                                                autocomplete="off"
                                                :value="format"
                                                v-model="selectedFormat"
                                            />
                                            <label
                                                class="btn btn-outline-danger"
                                                :for="format"
                                            >
                                                {{ format }}</label
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="customRange3" class="form-label"
                                        >Compression rate :
                                        {{ compressionRate }}
                                    </label>
                                    <input
                                        type="range"
                                        v-model="compressionRate"
                                        name="quality"
                                        class="form-range"
                                        min="1"
                                        max="100"
                                        step="1"
                                        id="qualityRange"
                                    />
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <input
                                    v-on:change="changeImages"
                                    type="file"
                                    class="form-control"
                                    name="files[]"
                                    id="files[]"
                                    placeholder=""
                                    aria-label=""
                                    accept="image/*"
                                    multiple
                                />

                                <span class="input-group-btn">
                                    <button
                                        class="btn btn-danger"
                                        v-on:click="compress"
                                        aria-label=""
                                    >
                                        Compress
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="card-title" v-if="error != ''">
                        <span class="text-danger">
                            {{ error }}
                        </span>
                    </div>
                </div>

                <div class="card-body" v-if="compressedFiles.length > 0">
                    <table class="table table-striped table-sm-responsive">
                        <thead class="thead-default">
                            <tr>
                                <th>Name</th>
                                <th>original Size</th>
                                <th>New Size</th>
                                <th>Saving %</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                <compressed-file  v-for="  file in selectedFiles"  
                                    :key="file.name" 
                                    :file="file" 
                                    :quality="compressionRate" 
                                    :format="selectedFormat" >
                                </compressed-file>
                        </tbody>
                    </table>
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
            compressionRate: 75,
            selectedFormat: "jpg",
            selectedFiles: [],
            error: "",
            compressedFiles: [],
        };
    },
    methods: {
        changeImages: function (e) {
            // for each image call upload the image to send a request !
            files = e.target.files;
            for (let i = 0; i < files.length; i++) {
                let file = files.item(i);
                this.selectedFiles.push(file);
            }
        },
        compress: function () {
            self = this;

            this.selectedFiles.forEach(function (file) {
                var fd = new FormData();
                fd.append("files[0]", file);
                fd.append("format", self.selectedFormat);
                fd.append("quality", self.compressionRate);

               var sizeArr = self.compressedFiles.push({
                    'key':Math.floor(Math.random()*100),
                    'name':file.name,
                    'progress':0,
                });
                //self.upload(fd ,sizeArr-1 );
            });
        },

        download: function (index) {
            let self = this;
            axios({
                method: "GET",
                url: `storage/${this.compressedFiles[index].hashName}`,
                responseType: "blob",
            })
                .then((res) => {
                    var file = window.URL.createObjectURL(new Blob([res.data]));
                    const link = document.createElement("a");
                    link.href = file;
                    link.setAttribute(
                        "download",
                        self.compressedFiles[index].name
                    );
                    link.click();
                })
                .catch((err) => {
                    self.error = err;
                });
        },
    },
};
</script>
