<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Departement;
use App\Models\Classification;
use App\Models\Rootcause;
use App\Models\Status;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index(){

        $events = array();
        $posts = Post::where('user_id', auth()->user()->id)->get();
        foreach ($posts as $post){
            $events[] = [
                'id' => $post->id,
                'title' => $post->title,
                'finding' => $post->finding,
                'start' => $post->timeline->format('Y-m-d'),
            ];
        }
        return view('dashboard.index',[
            'events' => $events,
        ]);

   
    }

    public function action(Request $request)
    {
    	
    }

}
