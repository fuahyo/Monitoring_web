@extends('dashboard.layouts.main')

@section('container')
<div class="row justify-content-center">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mx-5 pb-2 mb-3 border-bottom">
            <h1 class="h2">Create New CAPA</h1>
            <a href="/dashboard/posts" class="btn btn-success mb-3"><span data-feather="arrow-left"></span> Back To My CAPA</a>
    </div>

    <div class="col-lg-8">
        <!--untuk upload file => enctype="multipart/form-data" -->
        <!-- untuk enter kebawah => class = "d-block" -->
        <form method="post" action="/dashboard/posts" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="source_capa" class="form-label">Referensi (Sumber CAPA)</label>
                <input type="text" class="form-control @error('source_capa') is-invalid @enderror" id="source_capa" name="source_capa" required autofocus value="{{old('source_capa')}}">
                @error('source_capa')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{old('title')}}">
                @error('title')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="finding" class="form-label">Temuan</label>
                <input type="text" class="form-control @error('finding') is-invalid @enderror" id="finding" name="finding" required autofocus value="{{old('finding')}}">
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
                        @if( old('classification_id') == $classification->id)
                        <option value="{{ $classification->id }}" selected>{{ $classification->name }}</option>
                        @else
                        <option value="{{ $classification->id }}">{{ $classification->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="requirement" class="form-label">Requirement</label>
                <input type="text" class="form-control @error('requirement') is-invalid @enderror" id="requirement" name="requirement" required autofocus value="{{old('requirement')}}">
                @error('requirement')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="gap_analysis" class="form-label">GAP Analysis</label>
                <input type="text" class="form-control @error('gap_analysis') is-invalid @enderror" id="gap_analysis" name="gap_analysis" required autofocus value="{{old('gap_analysis')}}">
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
                        @if( old('rootcause_id') == $rootcause->id)
                        <option value="{{ $rootcause->id }}" selected>{{ $rootcause->name }}</option>
                        @else
                        <option value="{{ $rootcause->id }}">{{ $rootcause->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="corrective_action" class="form-label">Corrective Action</label>
                <input type="text" class="form-control @error('corrective_action') is-invalid @enderror" id="corrective_action" name="corrective_action" required autofocus value="{{old('corrective_action')}}">
                @error('corrective_action')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="preventive_action" class="form-label">Preventive Action</label>
                <input type="text" class="form-control @error('preventive_action') is-invalid @enderror" id="preventive_action" name="preventive_action" required autofocus value="{{old('preventive_action')}}">
                @error('preventive_action')
                        <div  class="invalid-feedback">
                            {{$message}}
                        </div>
                @enderror
            </div>

            
            <div class="mb-3">    
                <label for="departement" class="form-label">Departement</label>
                <select name="departement_id" id="departement_id" class="form-select">
                    <option value="">Select departement</option>
                    @if (!empty($departements))
                    @foreach ($departements as $departement)
                    
                    <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            
            <div class="mb-3">     
                <label for="user" class="form-label">User</label>
                <select name="user_id" id="user_id" class="form-select">
                    <option value="">Select User</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="timeline" class="form-label">Timeline</label>
                <input type="date" class="form-control @error('timeline') is-invalid @enderror" id="timeline" name="timeline" required autofocus value="{{old('timeline')}}">
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
            
            
            <div class="mb-3 invisible">
                <!-- <label for="status" class="form-label">Status</label> -->
                <select class="form-select" name="status_id" >
                    @foreach ($statuses as $status)
                        @if( old('status_id') == $status->id)
                            <option value="{{ $status->id }}" selected>{{ $status->name }}</option>
                        @else
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="w-100 btn btn-lg btn-outline-primary mt-4">Create Post</button>
            
            <!-- ini form input yg di hide -->
           
            <div class="mb-3 invisible">
                <input type="text" class="  @error('slug') is-invalid @enderror" id="slug" name="slug" aria-label="Disabled input example" disable readonly required value="{{old('slug')}}">
                <div class="mb-3">
                <select name="email" id="email" class="select">  
                </select>
                <select name="user_name" id="user_name" class="select">  
                </select>
            </div>

            
            
        </form>    
    </div>
</div>


    <!-- pakai fetch API -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){
                $("#departement_id").change(function(){
                    var departement_id = $(this).val();

                    if (departement_id == "") {
                        var departement_id = 0;
                    } 
                    console.log(departement_id);
                    $.ajax({
                        url: '{{ url("/dashboard/posts/fetch-users/") }}/'+departement_id,
                        type: 'get',
                        dataType: 'json',
                        success: function(data) {                    
                            $('#user_id').find('option:not(:first)').remove();
                            $('#email').find('option:not(:first)').remove(); //hapus data email pertama
                            
                            if (data['user_byDepartementId'].length > 0) {
                                $.each(data['user_byDepartementId'], function(key,value){
                                    
                                    $("#user_id").append("<option value='"+value['id']+"'>"+value['name']+"</option>");
                                });
                                console.log(data);
                                    
                            } 
                        }
                    });            
                });

                $("#user_id").change(function(){
                    var user_id=$(this).val();

                    if (user_id == "") {
                        var user_id = 0;
                    } 
                    console.log(user_id);
                    $.ajax({
                        url: '{{ url("/dashboard/posts/fetch-emails/") }}/'+user_id,
                        type:'get',
                        dataType:'json',
                        success:function(response){
                            $('#email').empty(); //hapus semua data email sebelumnya
                            $('#user_name').empty(); //hapus semua data email sebelumnya

                            if (response['user_byUserId'].length > 0) {
                                $.each(response['user_byUserId'], function(key,value){
                                        $("#email").append("<option value='"+value['email']+"'>"+value['email']+"</option>");
                                        $("#user_name").append("<option value='"+value['name']+"'>"+value['name']+"</option>");
                                });
                            } 
                        },
                    });
                });
                
        });

        // ambil ID yang udah kita buat yaitu title dan slug
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function(){
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        });
    </script>
@endsection