@extends('dashboard.layouts.main')

@section('container')
<div class="row">
		<div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
          <!-- Card Header - Dropdown -->
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <h3 class="h2 m-0 font-weight-bold text-danger">All User</h3>
                <a href="/dashboard/users/create" class="btn btn-primary "><i class="fas fa-pen text-white-40"></i> Create new User</a>
             </div>

            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success col-lg-6" role="alert">
                      {{ session('success') }}
                    </div>
                @endif
                <table class="table table-striped  " style="width: 100%;">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Departement</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">{{ $user->departement->name }}</td>
                                <td class="text-center">{{ $user->role->name }}</td>
                                <td class="text-center">
                                    <div class=""> 
                                        <a href="/dashboard/users/{{$user->id}}/edit" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-pen fa-sm text-white-40"></i> Edit</a>
                                        <form action="/dashboard/users/{{ $user->id }}" method="post" class="d-inline" id="delete-form">
                                            @method('delete')
                                            @csrf
                                            <button type="submit " class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm deleteButton" id="deleteButton" onclick="return confirm('Anda yakin ingin menghapus user ini?')"><i class="fas fa-trash fa-sm text-white-40"></i> Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
		</div>
</div>

<script src="/js/sweetalert2.all.min.js"></script>
<script src="/js/mscript.js"></script>
<script>
    
    
    // $('.deleteButton').on('click', function(e){
    //     e.preventDefault(); 
    //     // const href = $(this).attr('href');
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!'
    //         }).then((result) => {
    //         // if (result.isConfirmed) {
    //         //     document.location.href=href;
    //         // }
    //         if (result.isConfirmed) {
    //         //Submit the form
    //         // document.querySelector('form').submit();
    //         document.getElementById('delete-form').submit();
    //     }
    //     })
    // });
    // const deleteButton = document.querySelector('#deleteButton');
    // name.addEventListener('click', function(){
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!'
    //         }).then((result) => {
    //         if (result.isConfirmed) {
    //             Swal.fire(
    //             'Deleted!',
    //             'Your file has been deleted.',
    //             'success'
    //             )
    //         }
    //     })
    // });
</script>
@endsection