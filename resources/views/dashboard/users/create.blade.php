@extends('dashboard.layouts.main')

@section('container')
<div class="row justify-content-center">
    <div class="d-flex justify-content-between flex-wrap align-items-center ms-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Registration Form:</h1>
            <a href="/dashboard/users" class="btn btn-success mb-3"><span data-feather="arrow-left"></span> Back To All User</a>
    </div>

    <div class="col-lg-8">
        <main class="form-registration"> 
            <form action="/dashboard/users" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-2" >
                    <label for="name">Photo Profil</label>
                    <input class="form-control @error('photo_profil') is-invalid @enderror" type="file" id="photo_profil" name="photo_profil" onchange="previewImage()">
                    @error('photo_profil')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror
                </div>

                <div class="mb-2" >
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control rounded @error('name') is-invalid @enderror" id="name" placeholder="Name" required value="{{old('name')}}">
                    @error('name')
                    <div  class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control rounded @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{old('username')}}">
                    @error('username')
                    <div  class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-1">
                    <label for="departement" class="form-label">Departement</label>
                    <select class="form-select" name="departement_id">
                        <option value="">Select departement</option>
                        @foreach ($departements as $departement)
                            @if( old('departement_id') == $departement->id)
                            <option value="{{ $departement->id }}" selected>{{ $departement->name }}</option>
                            @else
                            <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-1">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" name="role_id">
                        <option value="">Select role</option>
                        @foreach ($roles as $role)
                            @if( old('role_id') == $role->id)
                            <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                            @else
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control rounded @error('email') is-invalid @enderror" id="email" placeholder="ename@example.com" required value="{{old('email')}}">
                    @error('email')
                    <div  class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control rounded @error('password') is-invalid @enderror" id="password" placeholder="Password" required >
                    @error('password')
                    <div  class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>    
                <button class="w-100 btn btn-lg btn-outline-primary mt-4" type="submit">Register</button>
            </form>
        </main>       
        
    </div>

    <script>
        // ambil ID yang udah kita buat yaitu name dan slug
        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function(){
            fetch('/dashboard/users/checkSlug?name=' + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });

        function previewImage(){
            const image = document.querySelector('#photo_profil');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            //mengambil data gambar
            const oFReader = new FileReader();
            oFReader.readAsDataURL(photo_profil.files[0]);

            //ketika di load, jalankan sebuah fungtion oFREvent
            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }

    </script>

@endsection