<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compress Your images now  </title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
   <script src=" {{ mix('js/app.js') }}"></script>
</head>
<body >

<div class="container p-10 mx-auto mt-5" id="app">
    <div class="row w-50 mx-auto">
        <div class="col sm-12">
            <div class="card rounded border-red shadow">
                <div class="card-header">
                    <div class="card-title text-center p-5">
                        <h5>Upload your images in here ! </h5>
                        <button class="btn btn-danger rounded-3  mt-5 ">Choose files</button>
                        <form action="/api/compress" method="post" enctype="multipart/form-data">
                            @csrf @method('post')
                            <input type="file" name="files[]" id="" accept="image/*" multiple>
                            <button type="submit" class="btn btn-danger rounded-3  mt-5 ">Upload </button>
                            @error('files') {{$message}}  @enderror
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
    
</body>
</html>