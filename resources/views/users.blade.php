<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
    <div class="box_container">
    <div class="display-3">
        Admin Page
    </div>
    <div>
        <a href="{{Route('books-admin-index')}}">Books</a>
        <a href="{{Route('users-index')}}">Users</a>
    </div>
    <a type="submit" class="btn btn-success mb-2" href="{{route('users-create')}}">Add User</a>
    <form class="form-inline" method="GET">
        <div class="form-group mb-2">
            <label for="filter" class="col-sm-2 col-form-label">Email</label>
            <input type="text" class="form-control" id="filter" name="filter" placeholder="user email">
        </div>
        <button type="submit" class="btn btn-dark mb-2">Search</button>
    </form>
    <div>
        @if(session()->has('success'))
            <span>
                {{session('success')}}
            </span>
        @endif
    </div>
    <div class="card_container">
    @if($users)
        @foreach($users as $user)
            <div class="card">
                <div class="card-header">
                    {{$user->name}}
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                    <p>{{$user->email}}</p>
                    <footer class="blockquote-footer">{{$user->age}}<cite title="Source Title">{{$user->subscription_over}}</cite>
                    <a class="btn btn-warning" href="{{route('users-edit',['user'=>$user])}}">Edit</a>
                    <form method="post", action="{{route('users-del',['user'=>$user])}}">
                        @csrf
                        @method('delete')
                        <input class="btn btn-danger" type="submit" value="Remove"/>
                    </form>
                    </footer>
                    </blockquote>
                </div>
            </div>
        @endforeach
    @endif
    </div>
    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        <!-- {!! $users->links() !!} -->
        {{ $users->links() }}
    </div>
    </div>
</body>
</html>