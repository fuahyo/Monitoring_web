@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">All User</h1>
            <a href="/dashboard/users/create" class="btn btn-primary mb-3">Create New User</a>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success col-lg-6" role="alert">
          {{ session('success') }}
        </div>
    @endif

    <!-- <div class="table-responsive col-lg-6"> -->
    <div class="table-responsive " style="width: 100%;">
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
                            
                            <!-- <a href="/dashboard/users/{{ $user->id }}/edit" class="btn btn-success btn-sm border-0 ">edit</a> -->
                            <a href="/dashboard/users/{{$user->id}}/edit" class="btn btn-success border-0 btn-sm">
                                <i class="lnr lnr-pencil  "></i><span data-feather="edit"></span> Edit</a>
                            <form action="/dashboard/users/{{ $user->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <!-- <button class="btn btn-danger border-0 btn-sm" onclick="return confirm('Are you sure?')"><i class="lnr lnr-trash">delete</button> -->
                                <button class="btn btn-danger border-0 btn-sm" onclick="return confirm('Are you sure?')"><i class="lnr lnr-trash  "> Delete</i></button>
                            </form>
                        </div>

                      </td>
                </tr>
            @endforeach
            
          </tbody>
        </table>
      </div>
@endsection