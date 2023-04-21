<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Departement;
use App\Models\Rootcause;
use App\Models\Status;
use App\Models\Post;
use App\Models\User;

class ChartController extends Controller
{
    public function index(){
        $categories = Departement::all();
        $subcategories = Status::all();
        $subcategories2 = Rootcause::all();
        $posts1 = Post::with('departement', 'status')
            ->get()
            ->groupBy(function ($post) {
                return $post->departement->name;
            })
            ->map(function ($posts) {
                return $posts->groupBy(function ($post) {
                    return $post->status->name;
                });
            });
        $posts2 = Post::with('departement', 'rootcause')
            ->get()
            ->groupBy(function ($post) {
                return $post->departement->name;
            })
            ->map(function ($posts2) {
                return $posts2->groupBy(function ($post) {
                    return $post->rootcause->name;
                });
            });
        
        $allcapa = array();
        $capadone = array();
        $capacancel = array();
        $capaopen = array();
        $capaclose = array();
        $man = array();
        $machine = array();
        $methode = array();
        $material = array();
        $mileau = array();
        $departements = Departement::all();
        $statuses = Status::all();
        $kategorisdept  = Departement::withCount('posts')->get();
        $kategorisstat  = Status::withCount('posts')->get();

        foreach ($departements as $departement){
            $alldept[] = $departement->name;
            $capaclose[]=Post::where('departement_id',$departement->id)->where('status_id',2)->count();
            $capaopen[]=Post::where('departement_id',$departement->id)->where('status_id',1)->count();
            $capadone[]=Post::where('departement_id',$departement->id)->where('status_id',3)->count();
            $capacancel[]=Post::where('departement_id',$departement->id)->where('status_id',4)->count();
            $man[]=Post::where('departement_id',$departement->id)->where('rootcause_id',1)->count();
            $machine[]=Post::where('departement_id',$departement->id)->where('rootcause_id',2)->count();
            $methode[]=Post::where('departement_id',$departement->id)->where('rootcause_id',3)->count();
            $material[]=Post::where('departement_id',$departement->id)->where('rootcause_id',4)->count();
            $mileau[]=Post::where('departement_id',$departement->id)->where('rootcause_id',5)->count();
        }
        
        foreach ($kategorisdept as $kategori){
            $allcapa[] = $kategori->posts_count;
        }
        // dd($depts);

        return view('dashboard.chart.index',compact('categories', 'subcategories','subcategories2', 'posts1', 'posts2'),[
            'posts' => Post::all(),
            'status' => Status::all(),
            'alldept' => $alldept,
            'allcapa' => $allcapa,
            'capaclose' => $capaclose,
            'capadone' => $capadone,
            'capaopen' => $capaopen,
            'capacancel' => $capacancel,
            'man' => $man,
            'machine' => $machine,
            'methode' => $methode,
            'material' => $material,
            'mileau' => $mileau,
            
        ]);
    }
}
