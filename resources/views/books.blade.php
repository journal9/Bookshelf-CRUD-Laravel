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
    <a type="submit" class="btn btn-success mb-2" href="{{route('books-create')}}">Add Book</a>
    <form class="form-inline" method="GET">
        <div class="form-group mb-2">
            <label for="filter" class="col-sm-2 col-form-label">Filter</label>
            <input type="text" class="form-control" id="filter" name="filter" placeholder="Book genre">
        </div>
        <button type="submit" class="btn btn-dark mb-2">Filter</button>
    </form>
    <div>
        @if(session()->has('success'))
            <span>
                {{session('success')}}
            </span>
        @endif
    </div>
    <div class="card_container">
    @if($books)
        @foreach($books as $book)
            <div class="card">
                <div class="card-header">
                    {{$book->title}}
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                    <p>{{$book->author_name}}</p>
                    <footer class="blockquote-footer">{{$book->genre}}<cite title="Source Title">{{$book->published_year}}</cite>
                    <a class="btn btn-warning" href="{{route('books-edit',['book'=>$book])}}">Edit</a>
                    <form method="post", action="{{route('books-del',['book'=>$book])}}">
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
        <!-- {!! $books->links() !!} -->
        {{ $books->links() }}
    </div>
    </div>
</body>
</html>