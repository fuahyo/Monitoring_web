@extends('layouts.main')

@section('container')
<div class="row justify-content-center mt-5">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                        <img class="col-lg-6 d-none d-lg-block" src="/img/MIL.jpeg"> 
                        <div class="col-lg-6">
                            <div class="p-5">
                                @if(session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{session('success')}}</strong> You should check in on some of those fields below.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if(session()->has('loginError'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('loginError') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <main class="form-signin">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Please Login</h1>
                                    </div>
                                <form action="/login" method="post" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email"  aria-describedby="emailHelp" placeholder="Enter Email Address..." autofocus required value="{{old('email')}}">
                                        @error('email')
                                            <div  class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password" required>
                                    </div>
                                    
                                    <!-- <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember Me</label>
                                        </div>
                                    </div> -->
                            
                                    
                                    <button class="w-100 btn btn-lg btn-danger rounded-pill" type="submit">Login</button>
                                </form>
                                <small class="d-block text-center mt-3">Bermasalah dengan akun? <a href="https://wa.me/6281221951242">Hubungi Admin!</a></small>
                                </main>       
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection