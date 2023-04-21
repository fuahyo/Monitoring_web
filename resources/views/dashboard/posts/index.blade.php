
@extends('dashboard.layouts.main')

@section('container')
<div class="row">
		<div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <h3 class="h2 m-0 font-weight-bold text-danger">All CAPA</h3>
                <a href="/dashboard/posts/create" class="btn btn-primary "><i class="fas fa-pen text-white-40"></i> Create new post</a>
             </div>
            <!-- Card Body -->
            <div class="card-body">
                <form action="/dashboard/posts">
                    <div class="input-group mb-3">
                        @if(request('departement'))
                            <input type="hidden" name="departement" value="{{ request('departement') }}">
                        @endif
                        <input value="{{ request('search') }}" type="text" class="form-control" placeholder="Search..." name="search">
                        <button class="btn btn-danger" type="submit" >Search</button>
                    </div>
                </form>
                @if(session()->has('success'))
                    <div class="alert alert-success col-lg-8" role="alert">
                      {{ session('success') }}
                    </div>
                @endif
                <!-- <div class="table-responsive "> -->
                @if ($posts->count())
                    <table class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr class="text-center col-md-auto">
                                <th scope="col">No.</th>
                                <th scope="col">Finding</th>
                                <th scope="col">Classification</th>
                                <th scope="col">PIC</th>
                                <th scope="col">Departement</th>
                                <th scope="col">Timeline</th>
                                <th scope="col">Download</th>
                                <th scope="col">Progress</th>
                                <th scope="col">Action</th>
                                <th scope="col">Status</th>    
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td class="text-center">{{ $post->id }}</td>
                                    <td>{{ $post->finding }}</td>
                                    <td class="text-center"><a href="/dashboard/posts?classification={{$post->classification->slug}}" class="text-decoration-none">
                                          {{$post->classification->name}} 
                                        </a></td>
                                    <td class="text-center">
                                          {{$post->user->name}} 
                                    </td>
                                    <td class="text-center">
                                        <a href="/dashboard/posts?departement={{$post->departement->slug}}" class="text-decoration-none">
                                          {{$post->departement->name}} 
                                        </a>
                                    </td>
                                    <td class="text-center">{{ $post->timeline->format('d M Y') }}</td>
                                    <td class="text-center">
                                        @if($post->modifikasi1 != null || $post->modifikasi2 != null || $post->image) 
                                          @if($post->image != null)
                                            <div>
                                              <a href="{{ asset('storage/'.$post->image) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i class="fas fa-download fa-sm text-black-50"></i>Proof</a>
                                              <!-- <a href="{{ asset('storage/'.$post->image) }}"><button class="btn btn-warning btn-sm" type="button">Proof</button></a> -->
                                            </div>
                                            <div class="my-1 text-center"> </div>

                                          @endif
                                          @if($post->modifikasi1 != null)
                                            <div>
                                              <a href="{{ asset('storage/'.$post->modifikasi1) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-60"></i> Mod(1)</a>
                                            </div>
                                            <div class="my-1 text-center"> </div>
                                          @endif
                                          @if($post->modifikasi2 != null)
                                            <div>
                                              <a href="{{ asset('storage/'.$post->modifikasi2) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-40"></i> Mod(2)</a>
                                              </div>
                                          @endif
                                        @else
                                          N/A
                                        @endif
                                    </td>
                                    <td class=" text-center">
                                        @if($currentdate <= $post->timeline)
                                            @if($post->prove == null)
                                                @if($post->modifikasi1 == null )
                                                    <button type="button" class="btn btn-outline-primary btn-sm mb-1" disabled>Need Action</button>
                                                @else
                                                  @if($post->justifikasi1approved != '1')
                                                    <button type="button" class="btn btn-outline-primary btn-sm mb-1" disabled>Waiting Mod(1) Approval</button>
                                                  @else
                                                    @if($post->modifikasi2 == null)
                                                      <button type="button" class="btn btn-outline-primary btn-sm mb-1" disabled>Need Action</button>
                                                    @else
                                                      @if($post->justifikasi2approved != '1')
                                                        <button type="button" class="btn btn-outline-primary btn-sm mb-1" disabled>Waiting Mod(2) Approval</button>
                                                      @else
                                                        <button type="button" class="btn btn-outline-primary btn-sm mb-1" disabled>Waiting for Upload</button>
                                                      @endif
                                                    @endif
                                                  @endif
                                                @endif
                                            @else
                                                @if($post->approved == '0')
                                                  <div>
                                                    <button type="button" class="btn btn-outline-dark btn-sm mb-1" disabled>Proof uploaded</button>
                                                  </div>
                                                  <div>
                                                    <button type="button" class="btn btn-outline-warning btn-sm mb-1" disabled>Waiting Mgr Approval</button>
                                                  </div>
                                                @else
                                                  <div>
                                                    <button type="button" class="btn btn-outline-success btn-sm mb-1" disabled>Approved</button>
                                                  </div>
                                                @endif
                                            @endif
                                        @else($currentdate > $post->timeline)
                                            @if($post->prove != null)
                                                <div>
                                                    <button type="button" class="btn btn-outline-dark btn-sm mb-1" disabled>Proof uploaded</button>
                                                </div>
                                                @if($post->approved == '0')
                                                  <div>
                                                    <button type="button" class="btn btn-outline-warning btn-sm mb-1" disabled>Waiting Mgr Approval</button>             
                                                  </div>
                                                  <button type="button" class="btn btn-outline-danger btn-sm mb-1" disabled>Out of Date</button>
                                                @else 
                                                  <div>
                                                    <button type="button" class="btn btn-outline-success btn-sm mb-1" disabled>Approved</button>
                                                  </div>                         
                                                @endif 
                                          @else   
                                            <button type="button" class="btn btn-outline-danger btn-sm mb-1" disabled>Out of Date</button>
                                          @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class=""> 
                                            <a href="/dashboard/posts/{{$post->slug}}/edit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-pen fa-sm text-white-40"></i></a>
                                            <form action="/dashboard/posts/{{$post->slug}}" method="post" class="d-inline">
                                              @method('delete')
                                              @csrf
                                              <button class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" onclick="return confirm('Are you sure want to delete this CAPA?')"><i class="fas fa-trash fa-sm text-white-40"></i></button>
                                            </form>
                                        </div>
                                    </td> 
                                    <td class="text-center"><a href="/dashboard/posts?status={{$post->status->slug}}" class="text-decoration-none">
                                          {{$post->status->name}} 
                                        </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-centre fs-4">CAPA Not Found</p>
                @endif
                <div class="d-flex justify-content-end">
                    {{$posts->links()}}
                </div>
              <!-- </div> -->
            </div>
        </div>
		</div>
</div>   
@endsection