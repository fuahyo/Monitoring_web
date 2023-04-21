@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pb-2 mb-2 border-bottom">
        <h2 class=" m-0 font-weight-bold text-danger mb-3">Welcome Back, {{ auth()->user()->name }}</h1>
    </div>
    <!-- <div class="container" mt-4> -->
    @if(session()->has('success'))
        <div class="alert alert-success col-lg-10 ms-4" role="alert">
        {{ session('success') }}
        </div>
    @endif
    <div class="row">
		<div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h3 class="h3 m-0 font-weight-bold text-danger">My CAPA</h3>
                </div>
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
        
        <!-- Modal -->
        <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Event CAPA</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                        <label for="judul" class="col-form-label">Judul</label>
                        <div class="card" style="width: 28rem;">
                            <div class="card-body" id="title">  
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="temuan" class="col-form-label">Temuan</label>
                        <div class="card" style="width: 28rem;">
                            <div class="card-body" id="finding">  
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="timeline" class="col-form-label">Timeline</label>
                        <div class="card" style="width: 28rem;">
                            <div class="card-body" id="timeline">  
                            </div>
                        </div>
                    </div>
                    <table class=" invisible table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr class="text-center col-md-auto">
                            </tr>
                        </thead>

                        <tbody>
                                <tr>
                                    <td class="text-center" id="id_capa"></td>
                                </tr>  
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
                </div>
            </div>
        </div>
    <!-- </div> -->

    <script>
        $(document).ready(function() {
            var post = @json($events);
            // console.log(events);
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month',
                },
                events: post,
                selectable: true,
                selectHelper: true,
                
                // select: function(start, allDays) {
                //     $('#postModal').modal('toggle');
                // },
                eventClick: function(event) {
                    var id = event.id;
                    var title = event.title;
                    var timeline = moment(event.start).format('YYYY-MM-DD');
                    console.log(event)
                    $('#postModal').modal('toggle');
                    
                    const element_id = document.getElementById("id_capa");
                    element_id.innerHTML = event.id;
                    const element_title = document.getElementById("title");
                    element_title.innerHTML = event.title;
                    const element_finding = document.getElementById("finding");
                    element_finding.innerHTML = event.finding;
                    const element_timeline = document.getElementById("timeline");
                    element_timeline.innerHTML = moment(event.start).format('DD-MM-YYYY');

                },
            });
        });
    </script>           

@endsection