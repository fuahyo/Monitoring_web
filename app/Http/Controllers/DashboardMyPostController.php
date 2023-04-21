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
use Carbon\Carbon;

class DashboardMyPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $currentdate = date('Y-m-d H:i:s');
        $timeline1 = Post::where('user_id', auth()->user()->id)->get('prove');
        $datenow = Carbon::now();
        $reminder = date('Y-m-d', strtotime("+7 days"));

        // dd($timeline1);
        // return ($today);
        // dd($reminder);
        return view('dashboard.mypost.index',[
            // $currentdate => date('Y-m-d H:i:s'),

            'posts' => Post::where('user_id', auth()->user()->id)->get(),
            'timeline' => Post::where('user_id', auth()->user()->id)->get('timeline'),
            'approved' => Post::where('user_id', auth()->user()->id)->get('approved'),
            'prove' => Post::where('user_id', auth()->user()->id)->get('prove'),
            'currentdate' => $currentdate,
            'reminder' => $reminder,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //fungsi menampilkan isi halaman create post 
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Post $mypost)
    {   
        
        return view('dashboard.mypost.show', [
            
            'post' => $mypost,
            'departements' => Departement::all(),
            'users' => User::all(),
            'classifications' => Classification::all(),
            'rootcauses' => Rootcause::all(),
            'statuses' => Status::all(),
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    // edit itu untuk nampilin view
    public function edit(Post $mypost)
    {   
        $reminder = date('Y-m-d', strtotime("+7 days"));
        $currentdate = date('Y-m-d H:i:s');
        return view('dashboard.mypost.edit', [
            
            'post' => $mypost,
            'departements' => Departement::all(),
            'users' => User::all(),
            'classifications' => Classification::all(),
            'rootcauses' => Rootcause::all(),
            'statuses' => Status::all(), 
            'timeline' => Post::where('user_id', auth()->user()->id)->get('timeline'),
            'currentdate' => $currentdate,
            'reminder' => $reminder,
            
        ]);
    }

    // update itu untuk update data
    public function update(Request $request, Post $mypost)
    {   
        // dd($request);
        // return $request;
        $rules = [
            'source_capa' => 'required|max:255',
            'title' => 'required|max:255',
            'finding' => 'required|max:255',
            'requirement' => 'required|max:255',
            'gap_analysis' => 'required|max:255',
            'corrective_action' => 'required|max:255',
            'preventive_action' => 'required|max:255',
            'departement_id' => 'required',
            'user_id' => 'required',
            'classification_id' => 'required',
            'rootcause_id' => 'required',
            'timeline' => 'required',
            'timeline1' => '',
            'timeline2' => '',
            'modifikasi1' => 'mimes:pdf',
            'modifikasi2' => 'mimes:pdf',
            'status_id' => 'required',
            // 'image' => 'image|file|max:2048',
            'prove' => '',
            'approved' => ''
        ];

        if($request->slug != $mypost->slug){
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        if($request->file('modifikasi1')){
            if($request->oldModifikasi1){
                Storage::delete($request->oldModifikasi1);
            }
            $validatedData['modifikasi1'] = $request->file('modifikasi1')->store('post-files');
        }
        if($request->file('modifikasi2')){
            if($request->oldModifikasi2){
                Storage::delete($request->oldModifikasi2);
            }
            $validatedData['modifikasi2'] = $request->file('modifikasi2')->store('post-files');
        }

        $validatedData['user_id'] = request()->user_id;
        $validatedData['departement_id'] = auth()->user()->departement_id;
        // $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100, '...');

        Post::where('id', $mypost->id)->update($validatedData);
        
        
        return redirect('/dashboard/mypost')->with('success', 'File has been Uploaded!'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
        
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

}
