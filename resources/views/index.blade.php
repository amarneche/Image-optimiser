@extends('layouts.app')

@section('content')

    <div id="app">

        <div class="container-fluid d-lg-flex justify-content-between align-items-center flex-wrap justify-content-lg-center"
            style="background: #EA868F;padding-top: 30px;padding-bottom: 60px;">
            <div class="row d-lg-flex flex-grow-1 justify-content-lg-center align-items-lg-start" style="max-width: 800px;">
                <div class="col-md-6">
                    <h1 class="text-light"><br>Make smaller images and improve performance<br></h1>
                </div>
                <div class="col-md-6">
                    <compressor
                       :selected-format="selectedFormat"
                       :selected-quality="selectedQuality"
                       :selected-files="selectedFiles"
                       @file-selected="addFile"
                       
                    ></compressor>
                </div>
            </div>
        </div>
        <div class="container pt-5 pb-5">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header text-center">
                            <h6>Compressed images :</h6>
                        </div>
                        <div class="card-body p-0" >
                            <div class="table-responsive-sm text-start m-0" style="font-size: 12px;">
                                <table class="table table-striped table-hover table-sm table-borderless">
                                    <thead class="table-dark text-nowrap bg-danger">
                                        <tr>
                                            <th>File name</th>
                                            <th>Original size</th>
                                            <th>new Size</th>
                                            <th>Saving</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <tr is="compressed-file" v-for="file in selectedFiles" :key="file.name" 
                                            :file="file" 
                                            :quality="selectedQuality"
                                            :format="selectedFormat"
                                        
                                        ></tr>

                                        
                                    



                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
        </div>
        <footer></footer>


    </div>


@endsection
