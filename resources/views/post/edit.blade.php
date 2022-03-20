@extends('master')

@section('title')
    Edit Post : {{env('APP_NAME')}}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">


                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Edit Post</h3>

                    <p class="mb-0">
                        <i class="fas fa-calendar text-primary"></i>
                        {{ date('d M Y') }}
                    </p>
                </div>



                <form action="{{route('post.update',$post->id)}}" id="post-create" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-floating mb-4">
                        <input type="text" value="{{old('title',$post->title)}}" class="form-control @error("title")border border-danger is-invalid  @enderror" name="title" id="postTitle" placeholder="Enter Your Post Title">
                        <label for="postTitle">Post Title</label>
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    <div class="mb-4">
                        <img src="{{asset('storage/cover/'.$post->cover)}}" id="coverPreview" class="cover-img w-100 rounded-3 @error("cover")border border-danger is-invalid  @enderror" alt="">
                        <input type="file" name="cover" accept="image/png,image/jpeg" class="d-none" id="cover">
                        @error('cover')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-4">
                        <textarea class="form-control @error("description")border border-danger is-invalid  @enderror"  name="description" style="height: 200px;" placeholder="Leave a comment here" id="floatingTextarea">{{old('description',$post->description)}}</textarea>
                        <label for="floatingTextarea">Share Your Experience</label>

                        @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </form>


                <div class="border rounded p-3 mb-4" id="gallery">

                   <div class="d-flex align-items-stretch">
                       <div class="border px-5 rounded-2 me-2 d-flex justify-content-center align-items-center" id="upload-ui" style="height: 150px">
                           <i class="fas fa-upload fa-fw"></i>
                       </div>

                       <div class=" d-flex overflow-scroll" style="height: 150px">

                         @foreach($post->galleries as $g)

                               <div class="d-flex me-2 align-items-end">
                                   <img src="{{ asset('storage/gallery/'.$g->photo) }}" class="h-100 rounded "  alt="">
                                   <form action="{{ route('gallery.destroy',$g->id) }}" method="post">
                                       @csrf
                                       @method('delete')

                                       <button class="btn btn-sm btn-danger gallery-img-delete">
                                           <i class="fas fa-trash-alt"></i>
                                       </button>
                                   </form>
                               </div>

                           @endforeach
                       </div>


                   </div>

                    <form action="{{ route('gallery.store') }}" id="gallery-upload" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">

                        <div class="">
                            <input type="file" id="gallery-input" name="galleries[]" class="d-none @error('galleries') is-invalid @enderror @error('galleries.*') is-invalid @enderror " multiple>
                                @error('galleries')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                @error('galleries.*')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                        </div>
                    </form>


                </div>


                <div class="text-center mb-4">
                    <button class="btn btn-lg btn-primary " form="post-create">
                        <i class="fas fa-message"></i>
                        Update Post
                    </button>
                </div>

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


        let uploadUi = document.querySelector('#upload-ui');
        let galleryInput = document.getElementById('gallery-input');
        let galleryUpload = document.getElementById('gallery-upload');

        uploadUi.addEventListener('click',function (){
            galleryInput.click();
        });

        galleryInput.addEventListener('change',function (){
           galleryUpload.submit();
        });

    </script>

@endpush
