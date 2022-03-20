@extends('master')
@section('title')
    Edit Profile : {{env('APP_NAME')}}
@endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center min-vh-100">
            <div class="col-md-6 col-lg-5">
                <div class="text-center  mt-5">
                    <img src="{{asset(\Illuminate\Support\Facades\Auth::user()->photo)}}" class="profile-image" alt="">
                    <br>
                    <button class="btn btn-sm btn-primary" id="edit-photo" style="margin-top: -25px">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <p class="mb-0">{{ auth()->user()->name }}</p>
                    <p class="small text-black-50">{{ auth()->user()->email }}</p>
                </div>

                <form action="{{ route('update-profile') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="photo" value="{{ old('photo',auth()->user()->photo) }}" class="d-none @error('photo') is-invalid @enderror" id="photo" accept="image/jpeg,image/png">
                    @error('photo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror


                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror " id="yourName" value="{{  old('name',auth()->user()->name) }}" placeholder="name@example.com">
                        <label for="yourName">Profile Name</label>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input disabled type="email" class="form-control " id="floatingInput" value="{{ auth()->user()->email }}" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-lg btn-primary">Update Profile</button>
                    </div>
                </form>

            </div>
        </div>
    </div>




@endsection


@push('script')
    <script>
        let profileImage = document.querySelector('.profile-image');
        let editPhoto =document.querySelector('#edit-photo');
        let photo = document.getElementById('photo');

        editPhoto.addEventListener('click',function (){
            photo.click();
        })


        // cover.addEventListener('change',function(){
        //     let reader = new FileReader();
        //
        //     reader.onload  = function (){
        //         coverPreview.src = reader.result;
        //     };
        //     reader.readAsDataURL(cover.files[0]);
        //     // console.log(cover.file);
        // });


        photo.addEventListener('change',function (){
            let file = photo.files[0];
            let reader = new FileReader();

            reader.onload = function (){
                profileImage.src = reader.result;
            }
            reader.readAsDataURL(file);
        })
    </script>
@endpush
