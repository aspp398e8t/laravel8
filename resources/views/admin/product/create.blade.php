@extends('layouts.app')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">

@endsection

@section('main')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">首頁</a></li>
            <li class="breadcrumb-item"><a href="{{route('products.index')}}">產品管理</a></li>
            <li class="breadcrumb-item active" aria-current="page">新增產品</li>
        </ol>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h2 class="card-header pt-3 pb-2">產品 - 新增</h2>

                <div class="card-body">
                    <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row py-2">
                            <label for="name" class="col-sm-2 col-form-label">名稱<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="price" class="col-sm-2 col-form-label">價格<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" min="0" class="form-control" id="price" name="price" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="image-url" class="col-sm-2 col-form-label">主要圖片<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="file" accept="image/*" class="form-control" id="image-url" name="image_url" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="image-urls" class="col-sm-2 col-form-label">其他圖片</label>
                            <div class="col-sm-10">
                                <input type="file" accept="image/*" class="form-control" id="image-urls" name="image_urls[]" multiple>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="description" class="col-sm-2 col-form-label">描述<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" id="description" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary">新增</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

            $(document).ready(function() {
                $('#content').summernote({
                    callbacks: {
                        onImageUpload: function(files) {
                            // upload image to server and create imgNode...
                            console.log(files);
                            let url = '{{route('tool.image_upload')}}';
                            let formData = new FormData();
                            formData.append('_token','{{csrf_token()}}');
                            formData.append('image',files[0]);

                            fetch(url,{
                                'method':'post',
                                'body':formData
                            })
                            .then(function(response){
                                return response.text();
                            })
                            .then(function(data){
                                console.log(data);
                                $('#content').summernote('insertImage',data);
                            })
                            
                        }
                    }
                });
            });
                    
    </script>
    
@endsection