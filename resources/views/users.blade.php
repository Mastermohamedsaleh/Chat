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
    

<style>
        /* إزالة الـ border وإضافة استايل أنيق */
        body {
    background-color: #f0f2f5;
    font-family: 'Arial', sans-serif;
}

.container {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #075e54;
}

.btn-primary {
    background-color: #25d366;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    font-weight: bold;
}

.btn-primary:hover {
    background-color: #1ebea5;
}

.user-list {
    list-style: none;
    padding: 0;
}

.user-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.user-list li:last-child {
    border-bottom: none;
}

.user-name {
    color: #075e54;
    font-weight: bold;
    text-decoration: none;
}

.user-name:hover {
    text-decoration: underline;
}

.status {
    background: gray;
    color: white;
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 12px;
}
    </style>
    
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
                <input type="text" style="border: none;   outline: none;" value="{{ $user->name }}" readonly class="custom-input">
                <input type="checkbox" name="user_ids[]" value="{{ $user->id }}">
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

            @foreach($groups as $group)
            <li class="list-group-item d-flex justify-content-between align-items-center"> <a href="{{ url('/group/'.$group->id) }}">{{ $group->name }}</a></li>
        @endforeach
        </ul>
    </div>
</body>
</html>