@extends('dashboard.layouts.main')

@section('container')
<div class="row">
		<div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header align-items-center text-center">
                <h3 class="h3 m-0 font-weight-bold text-danger">My Department CAPA</h3>
            </div>
            <div class="card-body">
                
                <form action="/dashboard/mydepartementpost">
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
                @if ($posts->count())
                <table class="table table-striped table-bordered" style="width: 100%;">
                  <thead>
                    <tr class="text-center col-md-auto">
                        <th scope="col">No.</th>
                        <th scope="col">Finding</th>
                        <th scope="col">Classification</th>
                        <th scope="col">Root Cause</th>
                        <th scope="col">Timeline</th>
                        <th scope="col">Action</th>
                        <th scope="col">CAPA Status</th>    
                        <th scope="col">New Timeline 1</th>    
                        <th scope="col">New Timeline 2</th>    
                        <th scope="col">Progress</th>
                    </tr>
                  </thead>
                  
                 
                  <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            
                            <td>{{ $post->finding }}</td>
                            <td class="text-center">{{ $post->classification->name }}</td>
                            <td class="text-center">{{ $post->rootcause->name }}</td>
                            <td class="text-center">{{ $post->timeline->format('d M Y') }}</td>
                            <td class="text-center">
                                <div>
                                  <a href="/dashboard/mydepartementpost/{{$post->slug}}" class="btn btn-primary border-0 btn-sm mb-1 mr-1"><i class="fa fa-search"></i><span data-feather="edit"></span> Show</a>                    
                                </div>
                                  <!-- <a href="/dashboard/mydepartementpost/{{$post->slug}}/edit" class="btn btn-secondary border-0 btn-sm mb-1 mr-1"><i class="fa fa-upload"></i><span data-feather="edit"></span> Upload</a> -->
                                @if(auth()->user()->role_id != '2')
                                    @if($reminder > $post->timeline)
                                        @if($currentdate <= $post->timeline)
                                          @if($post->prove == null && $post->modifikasi1 == null)
                                            <div>
                                              <a href="/dashboard/mydepartementpost/{{$post->slug}}/edit" class="btn btn-warning border-0 btn-sm mb-1 mr-1"><i class="fa fa-upload"></i><span data-feather="edit"></span> Justifikasi 1</a>
                                            </div>
                                          @endif
                                        @endif
                                    @endif
                                    @if($reminder > $post->timeline1)
                                        @if($currentdate <= $post->timeline1)
                                          @if($post->prove == null && $post->modifikasi2 == null)
                                            <div>
                                              <a href="/dashboard/mydepartementpost/{{$post->slug}}/edit" class="btn btn-warning border-0 btn-sm mb-1 mr-1"><i class="fa fa-upload"></i><span data-feather="edit"></span> Justifikasi 2</a>
                                            </div>
                                          @endif
                                        @endif
                                    @endif
                                @endif

                              
                                  @if($currentdate <= $post->timeline)
                                    @if(auth()->user()->role_id != '1')
                                      @if($post->image != null)
                                        @if($post->approved == '0')
                                        <div>
                                          <a href="/dashboard/mydepartementpost/{{$post->slug}}/edit" class="btn btn-success border-0 btn-sm mb-1 mr-1"><i class="fa fa-thumbs-up"></i><span data-feather="edit"></span>Approve</a>
                                        </div>
                                        @endif 
                                      @endif
                                    @endif
                                    @if(auth()->user()->role_id != '2')
                                      <div>
                                        <a href="/dashboard/mydepartementpost/{{$post->slug}}/edit" class="btn btn-secondary border-0 btn-sm mb-1 mr-1"><i class="fa fa-upload"></i><span data-feather="edit"></span> Upload</a>
                                      </div>
                                    @endif
                                  @else
                                    @if(auth()->user()->role_id != '1' && $post->image != null)
                                      @if($post->approved == '0')
                                      <div>
                                        <a href="/dashboard/mydepartementpost/{{$post->slug}}/edit" class="btn btn-success border-0 btn-sm mb-1 mr-1"><i class="fa fa-thumbs-up"></i><span data-feather="edit"></span> Approve</a>
                                      </div>
                                      @endif 
                                    @endif
                                  @endif
                            </td>        
                            <td class="text-center">{{ $post->status->name }}</td>     
                            <td class="text-center">
                              @if($post->timeline1 != null && $post->justifikasi1approved == '1')
                                  {{ $post->timeline1->format('d M Y') }}
                              @else
                                  N/A 
                              @endif
                            </td> 
                            <td class="text-center">
                              @if($post->timeline2 != null && $post->justifikasi2approved == '1')
                                  {{ $post->timeline2->format('d M Y') }}
                              @else
                                  N/A 
                              @endif
                            </td> 

                            <td class=" text-center">
                                @if($currentdate <= $post->timeline)
                                    @if($post->image == null)
                                        @if($post->prove != null )
                                          <button type="button" class="btn btn-outline-warning btn-sm mb-1" disabled>Reupload Proof</button>
                                        @endif
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
                                        <div>
                                          <button type="button" class="btn btn-outline-dark btn-sm mb-1" disabled>Proof uploaded</button>
                                        </div>
                                        @if($post->approved == '0' )
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
                                    @if($post->image != null)
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

                        </tr>
                    @endforeach
                    
                  </tbody>
                </table>
                @else
                    <p class="text-centre fs-4">No Post Found</p>
                @endif
            </div>
        </div>
		</div>
</div>   
@endsection