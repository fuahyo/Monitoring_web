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
use Illuminate\Support\Facades\Notification;
use App\Http\Notification\CapaNotification;
use Carbon\Carbon;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // $posts = Post::latest()->filter(request(['search', 'user','departement', 'rootcause', 'classification']))->paginate(15)->withQueryString();
        // dd($posts);
        if(request('departement')){
            $departement = Departement::firstWhere('slug', request('departement'));
            $title = ' in '. $departement->name;
        }
        if(request('classification')){
            $classification = Classification::firstWhere('slug', request('classification'));
            $title = ' in '. $classification->name;
        }
        if(request('status')){
            $status = Status::firstWhere('slug', request('status'));
            $title = ' in '. $status->name;
        }
        if(request('rootcause')){
            $rootcause = Rootcause::firstWhere('slug', request('rootcause'));
            $title = ' in '. $rootcause->name;
        }
        if(request('user')){
            $user = User::firstWhere('username', request('user'));
            $title = ' in '. $user->name;
        }
        
        $currentdate = date('Y-m-d H:i:s');
        $timeline1 = Post::where('user_id', auth()->user()->id)->get('prove');
        $datenow = Carbon::now();
        $reminder = date('Y-m-d', strtotime("+7 days"));
        return view('dashboard.posts.index',[
            'posts' => Post::latest()->filter(request(['search', 'user','departement', 'rootcause', 'classification']))->paginate(15)->withQueryString(),
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
        // ddd(request);
        return view('dashboard.posts.create', [
            // 'categories' => Category::all(),
            // 'departements' => Departement::all(),
            'departements' => \DB::table('departements')->orderBy('id','ASC')->get(),
            'classifications' => Classification::all(),
            'rootcauses' => Rootcause::all(),
            'statuses' => Status::all(),
            // 'users' => User::where('user_id', auth()->user()->id)->get()
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'source_capa' => 'required|max:255',
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'finding' => 'required|max:255',
            'requirement' => 'required|max:255',
            'gap_analysis' => 'required|max:255',
            'corrective_action' => 'required|max:255',
            'preventive_action' => 'required|max:255',
            'classification_id' => 'required',
            'rootcause_id' => 'required',
            'timeline' => 'required',
            'status_id' => 'required'
        ]);
        $validatedData['user_id'] = request()->user_id;
        $validatedData['departement_id'] = request()->departement_id;
        
        // $user_name = request()->user_name;
        $user_email= request()->email;
        $user_name= request()->user_name;
        $title= request()->title;
        $timeline= request()->timeline;
        // dd ($slug);
        Post::create($validatedData);

        // \Mail::raw('Hi '.$user_name.', this is your New CAPA with Title: '.$title.'. Please pay attention and close the CAPA immediately before '.$timeline, function ($message) use ($user_email, $user_name, $title, $timeline) {
        //     $message->to($user_email, $user_name);
        //     $message->subject('[NEW CAPA] for '.$user_name.' ['.$title.']');
        // });
        return redirect('/dashboard/posts')->with('success', 'New Post has been added!');
        
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {   
        
        $users = User::all();
        foreach($users as $user){
            // Notification::send($user, new CapaNotification()); 
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    // edit itu untuk nampilin view
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            
            'post' => $post,
            'users' => User::all(),
            'departements' => Departement::all(),
            'classifications' => Classification::all(),
            'rootcauses' => Rootcause::all(),
            'statuses' => Status::all(),
            
        ]);
    }

    
    // update itu untuk update data
    public function update(Request $request, Post $post)
    {
        
        $rules = [
            'source_capa' => 'required|max:255',
            'title' => 'required|max:255',
            'finding' => 'required|max:255',
            'requirement' => 'required|max:255',
            'gap_analysis' => 'required|max:255',
            'corrective_action' => 'required|max:255',
            'preventive_action' => 'required|max:255',
            'departement_id' => 'required',
            'classification_id' => 'required',
            'rootcause_id' => 'required',
            'timeline' => 'required',
            'timeline1' => '',
            'timeline2' => '',   
            'user_id' => 'required',
            'modifikasi1' => 'mimes:pdf',
            'modifikasi2' => 'mimes:pdf',
            'approved' => '',
            'status_id' => 'required',
            'prove' => '',
            'justifikasi1approved' => '',
            'justifikasi2approved' => '',
        ];

        if($request->slug != $post->slug){
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = request()->user_id;
        $validatedData['departement_id'] = request()->departement_id;
        // $validatedData['departement_id'] = auth()->user()->departement_id;
        // $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 100, '...');

        // dd($validatedData);
        Post::where('id', $post->id)->update($validatedData);
        
        
        return redirect('/dashboard/posts')->with('success', 'CAPA has been updated!'); 

        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
        if($post->image){
            Storage::delete($post->image);
        }
        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    public function fetchUsers($departement_id = null) {
        $user_byDepartementId = \DB::table('users')->where('departement_id',$departement_id)->get();

        return response()->json([
            'user_byDepartementId' => $user_byDepartementId,
        ]);
    }
    public function fetchEmails($user_id = null) {
        $user_byUserId = User::where('id',$user_id)->get();

        return response()->json([
            'user_byUserId' => $user_byUserId,
        ]);
    }

}
