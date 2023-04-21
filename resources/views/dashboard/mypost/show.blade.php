
@extends('dashboard.layouts.main')

@section('container')
    <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-end pb-2 ">
            
        </div> -->
        
    <div class="col-lg-10">
        <a href="/dashboard/mypost" class="btn btn-success mb-3"><span data-feather="arrow-left"></span> Back To My CAPA</a>
        
        <div class="card mb-3">
            <div class="card-header text-center text-uppercase">
                Lihat CAPA
            </div>
            <div class="card-body">
                @if($post->image != null)
                    <form method="post" action="/dashboard/mypost/{{$post->slug}}" class="mb-3" enctype="multipart/form-data">
                        @method('put')
                        @csrf   
                        <div class="card mb-3">
                            <div class="card-header text-center text-uppercase">
                                Bukti Closing CAPA: 
                            </div>
                            <div class="card-body">
                                <input class="mb-1" type="hidden" name="oldImage" value="{{ $post->image }}">
                                <input type="hidden" name="oldImage" value="{{ $post->image }}">
                                @if($post->image)
                                    <img src="{{ asset('storage/'.$post->image) }}"class="img-preview img-fluid mb-2 col-sm-5 d-block">
                                @else
                                    <img class="img-preview img-fluid mb-2 col-sm-5">   
                                @endif 
                            </div>
                        </div>      
                    </form> 
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Keterangan:</label>
                        <div class="col-sm-9">
                            <input type="text" disabled readonly class="form-control bg-light" id="" value="{{$post->prove}}">
                        </div>
                    </div>
                @endif 
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Reference (Sumber CAPA):</label>
                    <div class="col-sm-9">
                        <input type="text" disabled readonly class="form-control bg-light" id="inputPassword" value="{{$post->source_capa}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Title:</label>
                    <div class="col-sm-9">
                        <input type="text" disabled readonly class="form-control bg-light" id="" value="{{$post->title}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Finding (Temuan):</label>
                    <div class="col-sm-9">
                        <input type="text" disabled readonly class="form-control bg-light" id="" value="{{$post->finding}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Classification:</label>
                    <div class="col-sm-9">
                        <input type="text" disabled readonly class="form-control bg-light" id="" value="{{$post->classification->name}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Requirement:</label>
                    <div class="col-sm-9">
                        <input type="text" disabled readonly class="form-control bg-light" id="" value="{{$post->requirement}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">GAP Analysis:</label>
                    <div class="col-sm-9">
                        <input type="text" disabled readonly class="form-control bg-light" id="" value="{{$post->gap_analysis}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Root Cause:</label>
                    <div class="col-sm-9">
                        <input type="text" disabled readonly class="form-control bg-light" id="" value="{{$post->rootcause->name}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Corrective Action:</label>
                    <div class="col-sm-9">
                        <input type="text" disabled readonly class="form-control bg-light" id="" value="{{$post->corrective_action}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Preventive Action:</label>
                    <div class="col-sm-9">
                        <input type="text" disabled readonly class="form-control bg-light" id="" value="{{$post->preventive_action}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Timeline:</label>
                    <div class="col-sm-9">
                        <input type="text" disabled readonly class="form-control bg-light" id="" value="{{$post->timeline->format('d M Y') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Departement:</label>
                    <div class="col-sm-9">
                        <input type="text" disabled readonly class="form-control bg-light" id="" value="{{$post->departement->name}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">User:</label>
                    <div class="col-sm-9">
                        <input type="text" disabled readonly class="form-control bg-light" id="" value="{{$post->user->name}}">
                    </div>
                </div>
                  
                
            </div>
        </div>
        
        
    </div>

    <!-- pakai fetch API -->
    <script>
       
        // ambil ID yang udah kita buat yaitu title dan slug
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function(){
            fetch('/dashboard/mypost/checkSlug?title=' + title.value)
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