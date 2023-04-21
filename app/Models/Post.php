<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    // untuk ngasih tau field mana saja yang boleh diisi dengan 'create'
    // protected $fillable = ['title', 'excerpt', 'body'];
    
    //kebalikan dari fillable, 'id' gaboleh diisi, sisanya (title, excerpt, body) bisa diisi
    protected $guarded = ['id'];
    protected $with = ['category', 'user','departement','role', 'classification', 'rootcause',  'status' ];
    protected $dates = ['timeline', 'timeline1', 'timeline2'];

    public function scopeFilter($query, array $filters){
        // if(isset($filters['search'])?$filters['search']:false){
        //     //'%' digunakan untuk mencari apapun yang ada di depannya atau apapun yg dibelakangnya
        //     return $query->where('title', 'like', '%'.$filters('search'). '%')
        //                  ->orWhere('body', 'like', '%'.$filters('search'). '%');
        // }

        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('title', 'like', '%'.$search. '%')
                         ->orWhere('body', 'like', '%'.$search. '%');
        });
        
        //category versi call back
        $query->when($filters['category'] ?? false, function($query, $category){
            return $query->whereHas('category', function($query) use ($category){
                $query->where('slug', $category);
            });
        });
        $query->when($filters['departement'] ?? false, function($query, $departement){
            return $query->whereHas('departement', function($query) use ($departement){
                $query->where('slug', $departement);
            });
        });
        $query->when($filters['classification'] ?? false, function($query, $classification){
            return $query->whereHas('classification', function($query) use ($classification){
                $query->where('slug', $classification);
            });
        });
        $query->when($filters['rootcause'] ?? false, function($query, $rootcause){
            return $query->whereHas('rootcause', function($query) use ($rootcause){
                $query->where('slug', $rootcause);
            });
        });
        $query->when($filters['status'] ?? false, function($query, $status){
            return $query->whereHas('status', function($query) use ($status){
                $query->where('slug', $status);
            });
        });
        $query->when($filters['role'] ?? false, function($query, $role){
            return $query->whereHas('role', function($query) use ($role){
                $query->where('slug', $role);
            });
        });
        // $query->when($filters['timeline'] ?? false, function($query, $timeline){
        //     return $query->whereHas('timeline', function($query) use ($timeline){
        //         $query->where('slug', $timeline);
        //     });
        // });

        //user versi arrow function
        $query->when($filters['user'] ?? false, fn($query, $user)=>
            $query->whereHas('user', fn($query)=>
                $query->where('username', $user)
            )
        );
    }


    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function classification(){
        return $this->belongsTo(Classification::class);
    }
    public function rootcause(){
        return $this->belongsTo(Rootcause::class);
    }
    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function user(){
        //satu post ini milik/belongs to 1 user
        return $this->belongsTo(User::class, 'user_id');
    }
  
    public function departement(){
        return $this->belongsTo(Departement::class, 'departement_id');
    }
    public function role(){
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ],
            'departement_id' => [
                'source' => 'user_id'
            ]

        ];
    }

}

//contoh create:    
    // Post::create([
    // 'title' => 'Judul Ke empaaaaaaaaaaaaat',
    // 'category_id' => 3,
    // 'slug' => 'Judul-empat',
    // 'excerpt' => 'Lorem ke 4',
    // 'body' => '<p>Lorem,  </p><p> ipsum</p>'])

    // Post::where('category_id', 1)->get()
