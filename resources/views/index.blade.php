 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Compress Your images now </title>
     <link rel="stylesheet" href="{{ mix('css/app.css') }}">
 </head>

 <body>

     <div class="container p-10 mx-auto mt-5" id="app">
         <div class="row w-md-50 mx-auto">
             <div class="col sm-12">
                 <div class="card rounded border-red shadow">
                     <div class="card-header">
                         <div class="card-title text-center p-5">

                             <form action="/api/compress" method="post" enctype="multipart/form-data">
                                 @csrf @method('post')
                                 <div class="row mb-2">
                                     <div class="col-sm-6">
                                         <strong>
                                             Convert images to :
                                         </strong>
                                     </div>
                                     <div class="col-sm-6">

                                         <div class="btn-group" role="group" aria-label="basic">
                                             <div v-for="format in availableFormat" class="mx-1">
                                                 <input type="radio" class="btn-check" name="format" :id="format"
                                                     autocomplete="off" :value="format" v-model="selectedFormat">
                                                 <label class="btn btn-outline-danger" :for="format">@{{format}}</label>

                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-sm-12">
                                         @error('format')
                                             <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-sm-12">
                                         <label for="customRange3" class="form-label">Compression rate :
                                             @{{ compressionRate }} </label>
                                         <input type="range" v-model="compressionRate" name="quality"
                                             class="form-range" min="1" max="100" step="1" id="qualityRange">
                                         @error('quality')
                                             <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                     </div>
                                 </div>

                                 <div class="input-group mb-3">
                                     <input  v-on:change="changeImages" type="file" class="form-control" name="files[]" id="files[]"
                                         placeholder="" aria-label="" accept="image/*" multiple>

                                     <span class="input-group-btn">
                                         <button class="btn btn-danger " type="submit" aria-label="">Compress</button>
                                     </span>
                                 </div>



                             </form>
                         </div>
                         <div class="card-title" v-if="error!=''"  >
                             <span class="text-danger">
                                 @{{error}}
                             </span>
                         </div>
                     </div>

                         <div class="card-body" v-if="compressedFiles.length > 0">
                             <table class="table table-striped  table-sm-responsive">
                                 <thead class="thead-default">
                                     <tr>
                                         <th>Name</th>
                                         <th>Before</th>
                                         <th>After</th>
                                         <th>Saving</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                  
                                         <tr v-for="(file,index ) in compressedFiles" >

                                             <td scope="row" >@{{file.name}}  </td>
                                             <td>@{{file.oldSize}} </td>
                                             <td>@{{file.newSize}} </td>
                                             <td>Saving </td>
                                             <td> <button v-on:click="download(index)"  class="btn btn-danger">
                                                 Download
                                                 </button>  </td>
                                             

                                         </tr>



                                 </tbody>
                             </table>

                         </div>
                   
                 </div>
             </div>


         </div>

     </div>
     <script src=" {{ mix('js/app.js') }}"></script>

 </body>

 </html>
