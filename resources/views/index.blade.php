 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compress Your images now </title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src=" {{ mix('js/app.js') }}"></script>
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
                                            <input type="radio" class="btn-check" name="format" id="jpg"
                                                autocomplete="off" value="jpg">
                                            <label class="btn btn-outline-danger" for="jpg">jpg</label>

                                            <input type="radio" class="btn-check" name="format" id="jpeg"
                                                autocomplete="off" value="jpeg">
                                            <label class="btn btn-outline-danger" for="jpeg">jpeg</label>
                                            
                                            <input type="radio" class="btn-check" name="format" id="png"
                                                autocomplete="off" value="png">
                                            <label class="btn btn-outline-danger" for="png">png</label>
                                            
                                            <input type="radio" class="btn-check" name="format" id="webp"
                                                autocomplete="off" value="webp">
                                            <label class="btn btn-outline-danger" for="webp">webp</label>
                                            
                                            <input type="radio" class="btn-check" name="format" id="psd"
                                                autocomplete="off" value="psd">
                                            <label class="btn btn-outline-danger" for="psd">PSD</label>


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
                                        <label for="customRange3" class="form-label">Compression rate</label>
                                        <input type="range" name="quality" class="form-range" min="1" max="100"
                                            step="1" id="qualityRange">
                                        @error('quality')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="files[]" id="files[]" placeholder=""
                                        aria-label="" accept="image/*" multiple>

                                    <span class="input-group-btn">
                                        <button class="btn btn-danger " type="submit" aria-label="">Compress</button>
                                    </span>
                                </div>



                            </form>
                        </div>
                    </div>
                    @if(session('response'))
                        
                    <div class="card-body">
                       <table class="table table-striped  table-responsive">
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
                                   @foreach (session('response') as $file)
                                   <tr>
                                        <td scope="row"> {{$file['name']}} </td>
                                        <td>{{$file['oldSize']}}</td>
                                        <td>{{$file['newSize']}}</td>
                                        <td>{{$file['oldSize']/$file['newSize'] }} </td>
                                        <td> 
                                            <form action="/" method="post">
                                                @csrf @method('post')
                                                <input type="text" name="filename" value="{{$file['name']}}" hidden  >
                                                <input type="text" name="path" value="{{$file['path']}}" hidden  >
                                                <button type="submit">Download</button>
                                            </form>
                                          
                                        </td>
                                    </tr>
                                   @endforeach
                                  
                                   
                               </tbody>
                       </table>
                       
                    </div>
                    @endif
                </div>
            </div>


        </div>

    </div>

</body>

</html>
