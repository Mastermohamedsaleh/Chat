<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/js/app.js'])
</head>
<body>
    
<div class="container mt-5">
   
<a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      create Group
</a>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Groupe</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{url('creategroup')}}" method="post">
       
      @csrf
    
      <div class="modal-body">

      <label for="">name Group :</label>
      <input type="text" name="name" class="form-control mb-2">
           
      @foreach ($users as $user)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <input  class="text-primary" value="{{ $user->id }}" name="namemembers"  placeholder="{{ $user->name }}" >
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                </li>
            @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
      </form>
    </div>
  </div>
</div>



    <div class="container mt-5">
        <h1>Chat Users</h1>
        <ul class="list-group mt-3">
            @foreach ($users as $user)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('chat', $user->id) }}">{{ $user->name }}</a>
                    <span class="badge {{ $user->isOnline() ? 'bg-success' : 'bg-secondary' }}">
                        {{ $user->isOnline() ? 'Online' : 'Offline' }}
                    </span> 
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>