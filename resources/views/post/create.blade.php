@extends('master')

@section('title')
    Create New Post : {{env('APP_NAME')}}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">


                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Create New Post</h3>

                    <p class="mb-0">
                        <i class="fas fa-calendar text-primary"></i>
                        {{ date('d M Y') }}
                    </p>
                </div>

                <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-4">
                        <input type="text" value="{{old('title')}}" class="form-control @error("title") border border-danger is-invalid  @enderror" name="title" id="postTitle" placeholder="Enter Your Post Title">
                        <label for="postTitle">Post Title</label>
                        @error('title')
                            <div class="invalid-feedback ps-3">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="mb-4">
                        <img src="{{asset('image-default.png')}}" id="coverPreview" class="cover-img w-100 rounded-3 @error("cover") border border-danger is-invalid  @enderror" alt="">
                        <input type="file" accept="image/png,image/jpeg" name="cover" class="d-none" id="cover">
                        @error('cover')
                        <div class="invalid-feedback ps-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-4">
                        <textarea class="form-control @error("description") border border-danger is-invalid  @enderror"  name="description" style="height: 200px;" placeholder="Leave a comment here" id="floatingTextarea">{{old('description')}}</textarea>
                        <label for="floatingTextarea">Share Your Experience</label>

                        @error('description')
                        <div class="invalid-feedback ps-3">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="text-center mb-4">
                        <button class="btn btn-lg btn-primary ">
                            <i class="fas fa-message"></i>
                            Create Post
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection



@push('script')
    <script>
        let coverPreview = document.querySelector("#coverPreview");
        let cover =document.querySelector('#cover');

        coverPreview.addEventListener('click',function(){
            cover.click();

        });

        cover.addEventListener('change',function(){
            let reader = new FileReader();

            reader.onload  = function (){
              coverPreview.src = reader.result;
            };
            reader.readAsDataURL(cover.files[0]);
            // console.log(cover.file);
        });

    </script>

@endpush
