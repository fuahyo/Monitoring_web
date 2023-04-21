
@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2 class="h3">No. CAPA : {{ $post->id }}: {{ $post->title }}</h2>
            <h3 class="h4">Author : {{ $post->user->name }} ({{ $post->departement->name }})</h3>
        </div>
        
        
        <div class="col-lg-8">
            <a href="/dashboard/posts" class="btn btn-success mb-3"><span data-feather="arrow-left"></span> Back To All CAPA</a>
            <form method="post" action="/dashboard/posts/{{$post->slug}}" class="mb-3" enctype="multipart/form-data">
                @method('put')
                @csrf
                
                
                <div class='row mb-3 ms-1'>
                    <div class='card '>
                        <div class="card-body">
                            <div class="d-flex justify-content-between text-center mb-3 border-bottom">
                                <h3 class="h4">Upload Bukti Closing CAPA</h3>
                                @if($post->image)
                                    <a href="{{ asset('storage/'.$post->image) }}" class="btn btn-primary border-0 btn-sm mb-1 mr-1"><i class="fa fa-search"></i><span></span> Show</a>
                                @endif
                            </div>
                            <input class="mb-1" type="hidden" name="oldImage" value="{{ $post->image }}">               
                            <input type="hidden" name="oldImage" value="{{ $post->image }}">
                            @if($post->image)
                                <img src="{{ asset('storage/'.$post->image) }}"class="img-preview img-fluid mb-2 col-sm-5 d-block">
                            @else
                                <img class="img-preview img-fluid mb-2 col-sm-5">   
                            @endif

                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                            @error('image')
                                    <div  class="invalid-feedback">
                                        {{$message}}
                                    </div>
                            @enderror

                            <div class="mt-2 mb-2">
                                <label for="prove" class="form-label mt-1">Keterangan:</label>
                                <input type="text" class="form-control @error('prove') is-invalid @enderror" id="prove" name="prove"  value="{{old('prove', $post->prove)}}">
                                @error('prove')
                                    <div  class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>                                           
                        </div>
                    </div>
                        
            </div>
            @if($post->image != null)
                <div class='card mb-3 text-center'>
                    <div class="card-header">
                        <h4 class="h5">Approval by: Admin</h4>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="approved" value="0">
                        <input class="form-check-input" type="checkbox" name="approved" value="1" {{ $post->approved || old('approved', 0) === 1 ? 'checked' : '0' }}>
                        <label class="form-check-label" for="approved">Approved</label>
                        <input class="form-check-input ms-4" type="checkbox" name="approved" value="1" {{ $post->approved || old('approved', 0) === 1 ? 'checked' : '0' }}>
                        <label class="form-check-label ms-5" for="approved">Not Approved</label>
                    </div>  
                    <div class="card-footer">
                        <button type="submit" class="btn btn-outline-primary">Submit</button>  
                    </div>                    
                </div> 
            @endif
            @if($post->approved != null)
                <div class='card mb-3'>
                    <div class="card-header">
                        Kembalikan Bukti Perbaikan By: Admin
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="image" value="{{$post->image}}">
                        <input class="form-check-input" type="checkbox" name="image" value="" {{ $post->image === 'NULL' ? 'checked' : '$post->image' }}>
                        <label class="form-check-label" for="image"> Centang checkbox jika bukti perbaikan tidak sesuai</label>
                    </div>
                    <div class="card-footer">           
                        <button type="submit" class="btn btn-outline-primary">Submit</button>                          
                    </div>
                </div>
            @endif

            @if($post->timeline1 != null)
                <div class="mb-3">
                    <label for="timeline1" class="form-label">New Timeline (1) --> Approval: </label>
                    <input type="hidden" name="justifikasi1approved" value="0">
                    <input class="form-check-input" type="checkbox" name="justifikasi1approved" value="1" {{ $post->justifikasi1approved || old('justifikasi1approved', 0) === 1 ? 'checked' : '0' }}>
                    <input type="date" class="form-control @error('timeline1') is-invalid @enderror" id="timeline1" name="timeline1" required autofocus value="{{old('timeline1',optional($post->timeline1)->format('Y-m-d') )}}">                   
                    @error('timeline1')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror
                    @error('timeline1')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror      
                </div>
            @endif

            @if($post->timeline2 != null)
                <div class="mb-3">
                    <label for="timeline2" class="form-label">New Timeline (2) --> Approval: </label>
                    <input type="hidden" name="justifikasi2approved" value="0">
                    <input class="form-check-input" type="checkbox" name="justifikasi2approved" value="1" {{ $post->justifikasi2approved || old('justifikasi2approved', 0) === 1 ? 'checked' : '0' }}>
                    
                    <input type="date" class="form-control @error('timeline2') is-invalid @enderror" id="timeline2" name="timeline2" required autofocus value="{{old('timeline2',optional($post->timeline2)->format('Y-m-d') )}}">
                    @error('timeline2')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror
                    @error('timeline2')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror      
                </div>
            @endif
            
            <div class="mb-3">
                <label for="source_capa" class="form-label">Referensi (Sumber CAPA)</label>
                <input type="text" class="form-control @error('source_capa') is-invalid @enderror" id="source_capa" name="source_capa" required autofocus value="{{old('source_capa', $post->source_capa)}}">
                @error('source_capa')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{old('title', $post->title)}}">
                @error('title')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="finding" class="form-label">Temuan</label>
                <input type="text" class="form-control @error('finding') is-invalid @enderror" id="finding" name="finding" required autofocus value="{{old('finding', $post->finding)}}">
                @error('finding')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="classification" class="form-label">Classification</label>
                <select class="form-select" name="classification_id">
                    <option value="">Select Classification</option>
                    @foreach ($classifications as $classification)
                        @if( old('classification_id', $post->classification_id) == $classification->id)
                        <option value="{{ $classification->id }}" selected>{{ $classification->name }}</option>
                        @else
                        <option value="{{ $classification->id }}">{{ $classification->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="requirement" class="form-label">Requirement</label>
                <input type="text" class="form-control @error('requirement') is-invalid @enderror" id="requirement" name="requirement" required autofocus value="{{old('requirement', $post->requirement)}}">
                @error('requirement')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="gap_analysis" class="form-label">GAP Analysis</label>
                <input type="text" class="form-control @error('gap_analysis') is-invalid @enderror" id="gap_analysis" name="gap_analysis" required autofocus value="{{old('gap_analysis', $post->gap_analysis)}}">
                @error('gap_analysis')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="rootcause" class="form-label">Root Cause</label>
                <select class="form-select" name="rootcause_id">
                <option value="">Select Root Cause</option>
                    @foreach ($rootcauses as $rootcause)
                        @if( old('rootcause_id', $post->rootcause_id) == $rootcause->id)
                        <option value="{{ $rootcause->id }}" selected>{{ $rootcause->name }}</option>
                        @else
                        <option value="{{ $rootcause->id }}">{{ $rootcause->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="corrective_action" class="form-label">Corrective Action</label>
                <input type="text" class="form-control @error('corrective_action') is-invalid @enderror" id="corrective_action" name="corrective_action" required autofocus value="{{old('corrective_action', $post->corrective_action)}}">
                @error('corrective_action')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="preventive_action" class="form-label">Preventive Action</label>
                <input type="text" class="form-control @error('preventive_action') is-invalid @enderror" id="preventive_action" name="preventive_action" required autofocus value="{{old('preventive_action', $post->preventive_action)}}">
                @error('preventive_action')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>

            
            
            <div class="mb-3">
                <label for="timeline" class="form-label">Timeline</label>
                <input type="date" class="form-control @error('timeline') is-invalid @enderror" id="timeline" name="timeline" required autofocus value="{{old('timeline',optional($post->timeline)->format('Y-m-d') )}}">
                @error('timeline')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
                @error('timeline')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status_id" >
                    @foreach ($statuses as $status)
                    @if( old('status_id', $post->status_id) == $status->id)
                    <option value="{{ $status->id }}" selected>{{ $status->name }}</option>
                    @else
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
           
            <div class="mb-2">
                <label for="departement" class="form-label">Departement</label>
                <input type="text" class="form-control @error('departement_id') is-invalid @enderror" id="departement_id" name="departement_id" required autofocus value="{{old('departement->name', $post->departement->name)}}" aria-label="Disabled input example" disable readonly required>
                @error('departement_id')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="user" class="form-label">User</label>
                <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required autofocus value="{{old('user->name', $post->user->name)}}" aria-label="Disabled input example" disable readonly required>
                @error('user_id')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>

            <div class="mb-3">
                <button type="submit" class="w-100 btn btn-lg btn-outline-primary ">Update</button>
            </div>
          
            <div class="mb-2 invisible">
                <input type="text" class="form-control @error('departement_id') is-invalid @enderror" id="departement_id" name="departement_id" required autofocus value="{{old('departement_id', $post->departement_id)}}" aria-label="Disabled input example" disable readonly required>
                <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required autofocus value="{{old('user_id', $post->user_id)}}" aria-label="Disabled input example" disable readonly required>
            </div> 
            
            <!-- ini form input yg di hide -->
            <div class="mb-3 invisible">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control  @error('slug') is-invalid @enderror" id="slug" name="slug" aria-label="Disabled input example" disable readonly required value="{{old('slug', $post->slug)}}">
                @error('slug')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>

            

        </form>    
    </div>

    <!-- pakai fetch API -->
    <script>
       
        // ambil ID yang udah kita buat yaitu title dan slug
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function(){
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });

        function changename(){
        document.getElementById('rootcause_id').name = "aku";
        } 

        // disable fungsi upload file kaya di email
        document.addEventListener('trix-file-accept', function(e) {
           e.preventDefault(); 
        });

        function previewImage(){
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            //mengambil data gambar
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            //ketika di load, jalankan sebuah fungtion oFREvent
            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }

    </script>
@endsection