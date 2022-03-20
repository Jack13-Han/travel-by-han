@extends('master')

@section('content')



        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    @auth

                            <div class="border rounded-3 p-4 mb-4">
                                <div class="d-flex  justify-content-between align-items-center">
                                    <h3 class="text-black-50">
                                        Welcome
                                        <br>
                                        <span class="fw-bolder text-dark">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                                    </h3>

                                    <a href="{{route('post.create')}}" class="btn btn-lg btn-primary">Create Post</a>

                                </div>


                            </div>

                    @endauth


                    <div class="posts">
                        @forelse($posts as $post)
                        <div class="post mb-4">
                            <div class="row">
                                <div class="col-lg-4">
                                    <img src="{{asset("storage/cover/".$post->cover)}}" class="cover-img w-100 rounded-3" alt="">
                                </div>

                                <div class="col-lg-8">
                                    <div class="d-flex flex-column justify-content-between h-350 py-4">

                                        <div class="">
                                            <h3 class="fw-bolder">{{$post->title}}</h3>
                                            <p class="text-black-50">
                                                {{$post->excerpt}}
                                            </p>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex ">
                                                <img src="{{asset($post->user->photo)}}" class="rounded-circle shadow-sm border border-white" height="38" alt="">
                                                <p class="mb-0 ms-2  small">
                                                   {{$post->user->name}}
                                                    <br>
                                                    <i class="fas fa-calendar text-primary"></i>
                                                    {{ $post->created_at->format('d-M-Y') }}
                                                </p>
                                            </div>
                                            <a href="{{ route('post.detail',$post->slug) }}" class="btn btn-outline-primary">Read More</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty

                        @endforelse
                    </div>

                    <div class="d-flex justify-content-center mb-4">
                        {{ $posts->links() }}
                    </div>

                </div>
            </div>
        </div>





@endsection
