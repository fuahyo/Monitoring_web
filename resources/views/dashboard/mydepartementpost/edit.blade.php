
@extends('dashboard.layouts.main')

@section('container')
    
    <div class="col-lg-8">
        <a href="/dashboard/mydepartementpost" class="btn btn-success mb-3"><span data-feather="arrow-left"></span> Back To My CAPA</a>
        <form method="post" action="/dashboard/mydepartementpost/{{$post->slug}}" class="mb-3" enctype="multipart/form-data">
            @method('put')
            @csrf

            <div class="card  mb-4">
                <div class="card-header text-center font-weight-bold">
                    <strong>Upload Bukti Closing CAPA</strong>
                </div>
                <div class="card-body">
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
                        <input type="text" class="form-control @error('prove') is-invalid @enderror" id="prove" name="prove" value="{{old('prove', $post->prove)}}">
                        @error('prove')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>                                           
                </div>
                <div class="card-footer text-muted text-center">
                    <button type="submit" class="btn btn-outline-primary btn-sm">Upload</button>
                </div>
            </div>
            
            @if(auth()->user()->role_id != '1')
                @if($post->prove != null)
                    <div class="card mb-3 text-center">
                        <div class="card-header ">
                            Please Click checkbox below if you approved: 
                        </div>
                        <div class="card-body text-center">
                            <input type="hidden" name="approved" value="0">
                            <!-- <input class="form-check-input" type="checkbox" name="approved" value="1" @if(old('approved', $post->approved)== "1") checked  @endif> -->
                            <!-- <input class="form-check-input" type="radio" name="approved" value="1" {{ $post->approved || old('approved', 0) === 1 ? 'checked' : '0' }}> -->
                            <input class="form-check-input" type="radio" name="approved" value="1" >
                            <label class="form-check-label mr-5" for="approved">Approved</label>
                            <input class="form-check-input " type="radio" name="image" value="" >
                            <label class="form-check-label" for="approved">Not Approved</label>
                        </div>
                        <div class="card-footer text-muted text-center">           
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                @endif
            @endif
            @if(auth()->user()->role_id != '2')
                @if($reminder > $post->timeline)
                    @if($currentdate <= $post->timeline)
                        @if($post->timeline1 == null && $post->prove == null)
                            <div class="card mb-3">
                                <div class="card-header">
                                    Add your Justification (1): 
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <input class="mb-1" type="hidden" name="oldModifikasi1" value="{{ $post->modifikasi1 }}" >               
                                        <input type="hidden" name="oldModifikasi1" value="{{ $post->modifikasi1 }}" >
                                        
                                        <input class="form-control @error('modifikasi1') is-invalid @enderror" type="file" id="modifikasi1" name="modifikasi1" onchange="previewImage()">
                                        @error('modifikasi1')
                                        <div  class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-2">
                                        <label for="timeline1" class="form-label">New Timeline (1)</label>
                                        <input type="date" class="form-control @error('timeline1') is-invalid @enderror" id="timeline1" name="timeline1" value="{{old('timeline1',optional($post->timeline1)->format('Y-m-d') ) }}">
                                        @error('timeline1')
                                                <div  class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">           
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        @endif
                    @endif
                @endif
                @if($reminder > $post->timeline1)
                    @if($currentdate <= $post->timeline1)
                        @if($post->timeline2 == null && $post->prove == null)
                            <div class="card mb-3">
                                <div class="card-header">
                                    Add your Justification (2): 
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <input class="mb-1" type="hidden" name="oldModifikasi2" value="{{ $post->modifikasi2 }}" >               
                                        <input type="hidden" name="oldModifikasi2" value="{{ $post->modifikasi2 }}" >
                                        
                                        <input class="form-control @error('modifikasi2') is-invalid @enderror" type="file" id="modifikasi2" name="modifikasi2" onchange="previewImage()">
                                        @error('modifikasi2')
                                        <div  class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="mb-2">
                                        <label for="timeline2" class="form-label">New Timeline (2)</label>
                                        <input type="date" class="form-control @error('timeline2') is-invalid @enderror" id="timeline2" name="timeline2" value="{{old('timeline2',optional($post->timeline2)->format('Y-m-d') ) }}">
                                        @error('timeline2')
                                                <div  class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">           
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        @endif
                    @endif
                @endif
            @endif


            <div class="mb-2 invisible">
                <div class="mb-2">
                    <label for="source_capa" class="form-label">Referensi (Sumber CAPA)</label>
                    <input type="text" class="form-control @error('source_capa') is-invalid @enderror" id="source_capa" name="source_capa" required autofocus value="{{old('source_capa', $post->source_capa)}}" aria-label="Disabled input example" disable readonly required>
                    @error('source_capa')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{old('title', $post->title)}}" aria-label="Disabled input example" disable readonly required>
                    @error('title')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="finding" class="form-label">Temuan</label>
                    <input type="text" class="form-control @error('finding') is-invalid @enderror" id="finding" name="finding" required autofocus value="{{old('finding', $post->finding)}}" aria-label="Disabled input example" disable readonly required>
                    @error('finding')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="classification" class="form-label">Classification</label>
                    <input type="text" class="form-control @error('classification_id') is-invalid @enderror" id="classification_id" name="classification_id" required autofocus value="{{old('classification->name', $post->classification->name)}}" aria-label="Disabled input example" disable readonly required>
                    @error('classification_id')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror
                </div>
                
                <div class="mb-2">
                    <label for="requirement" class="form-label">Requirement</label>
                    <input type="text" class="form-control @error('requirement') is-invalid @enderror" id="requirement" name="requirement" required autofocus value="{{old('requirement', $post->requirement)}}" aria-label="Disabled input example" disable readonly required>
                    @error('requirement')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="gap_analysis" class="form-label">GAP Analysis</label>
                    <input type="text" class="form-control @error('gap_analysis') is-invalid @enderror" id="gap_analysis" name="gap_analysis" required autofocus value="{{old('gap_analysis', $post->gap_analysis)}}" aria-label="Disabled input example" disable readonly required>
                    @error('gap_analysis')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror
                </div>
                <div class="mb-2 disabled" aria-label="Disabled select example" disable readonly required>
                    <label for="rootcause_id" class="form-label">Rootcause</label>
                    <input type="text" class="form-control @error('rootcause_id') is-invalid @enderror" id="rootcause_id" name="rootcause_id" required autofocus value="{{old('rootcause->name', $post->rootcause->name)}}" aria-label="Disabled input example" disable readonly required>
                    @error('rootcause_id')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="corrective_action" class="form-label">Corrective Action</label>
                    <input type="text" class="form-control @error('corrective_action') is-invalid @enderror" id="corrective_action" name="corrective_action" required autofocus value="{{old('corrective_action', $post->corrective_action)}}" aria-label="Disabled input example" disable readonly required>
                    @error('corrective_action')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="preventive_action" class="form-label">Preventive Action</label>
                    <input type="text" class="form-control @error('preventive_action') is-invalid @enderror" id="preventive_action" name="preventive_action" required autofocus value="{{old('preventive_action', $post->preventive_action)}}" aria-label="Disabled input example" disable readonly required>
                    @error('preventive_action')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="timeline" class="form-label">Timeline</label>
                    <input type="date" class="form-control @error('timeline') is-invalid @enderror" id="timeline" name="timeline" required autofocus value="{{old('timeline',optional($post->timeline)->format('Y-m-d') ) }}"  aria-label="Disabled input example" disable readonly required>
                    @error('timeline')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror
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
                <div class="mb-2">
                    <label for="user" class="form-label">User</label>
                    <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required autofocus value="{{old('user->name', $post->user->name)}}" aria-label="Disabled input example" disable readonly required>
                    @error('user_id')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror
                </div>

                
                <div class="mb-2 invisible">
                    <input type="text" class="form-control @error('rootcause_id') is-invalid @enderror" id="rootcause_id" name="rootcause_id" required autofocus value="{{old('rootcause_id', $post->rootcause_id)}}" aria-label="Disabled input example" disable readonly required>
                    <input type="text" class="form-control @error('classification_id') is-invalid @enderror" id="classification_id" name="classification_id" required autofocus value="{{old('classification_id', $post->classification_id)}}" aria-label="Disabled input example" disable readonly required>
                    <input type="text" class="form-control @error('departement_id') is-invalid @enderror" id="departement_id" name="departement_id" required autofocus value="{{old('departement_id', $post->departement_id)}}" aria-label="Disabled input example" disable readonly required>
                    <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required autofocus value="{{old('user_id', $post->user_id)}}" aria-label="Disabled input example" disable readonly required>
                
                </div> 
                <div class="mb-2 invisible">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control  @error('slug') is-invalid @enderror" id="slug" name="slug" aria-label="Disabled input example" disable readonly required value="{{old('slug', $post->slug)}}">
                    @error('slug')
                            <div  class="invalid-feedback">
                                {{$message}}
                            </div>
                    @enderror
                </div>
            
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status_id">
                    @foreach ($statuses as $status)
                        @if( old('status_id', $post->status_id) == $status->id)
                        <option value="{{ $status->id }}" selected>{{ $status->name }}</option>
                        @else
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            

        </form>    
    </div>

    <!-- pakai fetch API -->
    <script>
        $(document).ready(function() {
        $("input[type=radio]").prop("checked", false);
        $("input[type=radio]:first").prop("checked", false);

        $("input[type=radio]").click(function(event) {
            $("input[type=radio]").prop("checked", false);
            $(this).prop("checked", true);

            //event.preventDefault();
        });
        });
       
        // ambil ID yang udah kita buat yaitu title dan slug
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function(){
            fetch('/dashboard/mydepartementpost/checkSlug?title=' + title.value)
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