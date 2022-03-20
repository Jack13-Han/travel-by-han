<?php

namespace App\Http\Controllers;

use App\Jobs\CreateFile;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $posts =Post::latest('id')->paginate(10);

        return view('index',compact('posts')) ;
    }

    public function detail($slug){

        $post = Post::where('slug',$slug)->with(['galleries','comments'])->firstOrFail();

        return view('post.detail',compact('post'));
    }

    public function jobTest(){

        //store in job
        //အကြွးအလုပ်
//        dispatch(function (){
//            sleep(5);
//            logger('san kyi tr pr');
//        })->delay(now()->addSecond(10));

//        dispatch(new CreateFile());

//        CreateFile::dispatch();

        return "JobTest";
    }
}
