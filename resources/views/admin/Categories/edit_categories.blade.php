@extends('layouts.admin')

@section('content')
<div class="col mt-1 d-flex flex-column">
    <div class="card card-primary ">
        <div class="card-header">
          <h3 class="card-title">Edit Category</h3>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger m-2">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('admin.categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body container">
                <div class = column>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category Name</label>
                        <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" value="{{ $category->category_name}}" oninput="nameChange(event)" >
                    </div>
                    <div class="row">
                        <div class="col">
                            <div>
                                <label for="category_image">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="category_image" name='category_image' onchange="loadFile(event)">
                                        <label class="custom-file-label" for="category_image" id='labelvalue'>Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div>
                                <label for="category_color">Category Color</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="color" onchange="colorChange(event)" value="{{ $category->category_color }}" name='category_color'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-5 mr-2">
                            <div class="container d-flex ml-0 p-0" style="background: {{ $category->category_color }};border-radius: 5%; width: 450px; height: 300px; position:relative;overflow:hidden" id='color' >
                                <img id="output" style="object-fit: cover; opacity: 40% ; width:100%;height:auto;" src="{{ asset('images/categories/'.$category->category_image) }}">
                                <div class= "bottom-left" style="position: absolute;bottom:0px;left:30px; font-family: 'Outfit', sans-serif; font-size: 180%; color:white">
                                    <p id='name'>{{ $category->category_name }}</p>
                                </div>
                            </div>
                            <script>
                                var loadFile = function(event) {
                                    var image = document.getElementById('output');
                                    var label = document.getElementById('labelvalue');
                                    image.src = URL.createObjectURL(event.target.files[0]);
                                    label.innerHTML = event.target.files[0].name;
                                };

                                var nameChange = function(event) {
                                    var name = document.getElementById('name');
                                    name.innerHTML = event.target.value;
                                };

                                var colorChange = function(event){
                                    var color = document.getElementById('color');
                                    color.style.background = event.target.value;
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
          <!-- /.card-body -->
    
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
    </div>
</div>



@endsection