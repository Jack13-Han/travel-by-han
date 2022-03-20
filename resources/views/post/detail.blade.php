@extends('master')

@section('content')



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="post mb-4">
                    <div class="row">

                        <h3 class="fw-bolder text-capitalize mb-4">{{$post->title}}</h3>

                        <img src="{{asset("storage/cover/".$post->cover)}}" class="cover-img w-100 rounded-3 mb-4" alt="">

                        <p class="text-black-50 mb-4 post-detail">
                            {{$post->description}}
                        </p>

                        @if($post->galleries->count())
                            <div class="gallery rounded border p-2 mb-4 ">
                                <h3 class="text-center fw-bolder mb-4">Post Gallery</h3>
                                <div class="row g-3 justify-content-center">
                                    @foreach($post->galleries as $gallery)
                                    <div class="col-6 col-lg-3 col-md-4 ">
                                        <a class="venobox" data-gall="gallery" href="{{asset('storage/gallery/'.$gallery->photo)}}">
                                            <img src="{{asset('storage/gallery/'.$gallery->photo)}}" class="rounded gallery-photo" alt="image alt"/>
                                        </a>

                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="mb-4">
                            <h3 class="text-center fw-bolder ">Users Comment</h3>
                        </div>

                        <div class="row justify-content-center mb-4">
                            <div class="col-lg-8">

                                <div class="comments">
                                    @forelse($post->comments as $comment)
                                   <div class="border rounded mb-3 p-3">
                                          <div class="d-flex justify-content-between align-items-center mb-3">
                                              <div class="d-flex ">
                                                  <img src="{{asset($comment->user->photo)}}" class="rounded-circle shadow-sm border border-white" height="38" alt="">
                                                  <p class="mb-0 ms-2  small">
                                                      {{$comment->user->name}}
                                                      <br>
                                                      <i class="fas fa-calendar text-primary"></i>
                                                      {{ $comment->created_at->diffForHumans() }}
                                                  </p>
                                              </div>

                                              @can('delete',$comment)
                                                  <form action="{{route('comment.destroy',$comment->id)}}" method="post">
                                                      @csrf
                                                      @method('delete')
                                                      <button class="btn btn-sm btn-outline-danger">
                                                          <i class="fas fa-trash-alt"></i>
                                                      </button>
                                                  </form>
                                              @endcan

                                          </div>

                                           <p class="mb-0">
                                               {{ $comment->message }}
                                           </p>

                                   </div>
                                    @empty
                                        <p class="text-center">
                                            There is no Comment yet !
                                            @auth
                                                Start comment now.
                                            @endauth
                                            @guest
                                                <a href="{{ route('login') }}">Login</a> to comment
                                            @endguest
                                        </p>

                                    @endforelse
                                </div>


                                @auth

                                <form action="{{route('comment.store')}}" method="post" id="comment-create">

                                    @csrf
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <div class="form-floating mb-2">
                                        <textarea class="form-control @error('message') is-invalid  @enderror " name="message" style="height: 150px" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                        <label for="floatingTextarea">Comments</label>

                                        @error('message')
                                        <div class="invalid-feedback ps-3">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                    </div>

                                    <div class="text-center">
                                        <button class="btn btn-primary">Comment</button>
                                    </div>

                                </form>

                                @endauth
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border rounded p-4">
                            <div class="d-flex ">
                                <img src="{{asset($post->user->photo)}}" class="rounded-circle shadow-sm border border-white" height="38" alt="">
                                <p class="mb-0 ms-2  small">
                                    {{$post->user->name}}
                                    <br>
                                    <i class="fas fa-calendar text-primary"></i>
                                    {{ $post->created_at->format('d-M-Y') }}
                                </p>
                            </div>



                            <div class="">

                                @auth

                                    @can('delete',$post)
                                       <form action="{{route('post.destroy',$post->id)}}" class="d-inline-block" method="post">
                                           @csrf
                                           @method('delete')

                                           <button class="btn btn-outline-danger">
                                               <i class="fas fa-trash-alt fa-fw"></i>
                                           </button>

                                       </form>

                                    @endcan

                                    @can('update',$post)

                                            <a href="{{ route('post.edit',$post->id) }}" class="btn btn-outline-warning">
                                                <i class="fas fa-edit fa-fw"></i>
                                            </a>
                                        @endcan

                                @endauth

                                <a href="{{ route('index') }}" class="btn btn-outline-primary">Read All</a>
                            </div>

                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>





@endsection
