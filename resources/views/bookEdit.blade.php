<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Document</title>
    </head>
    <body>
        <h1>
            Create a book entry
        </h1>
        <div>
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $err)
                        <li>
                            {{$err}}
                        </li>
                    @endforeach
                </ul>
            @endif
        <form method="post" action="{{route('books-update',['book'=>$book])}}">
            @csrf
            @method('put')
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>Book Title</label>
                    <input type="text" class="form-control" id="validationDefault01" name="title" value="{{$book->title??''}}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>Author Name</label>
                    <input type="text" class="form-control" id="validationDefault02" name="author_name" value="{{$book->author_name??''}}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label>Book Genre</label>
                    <input type="text" class="form-control" id="validationDefault03" name="genre" value="{{$book->genre??''}}" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label>Published Year</label>
                    <input type="text" class="form-control" id="validationDefault04" name="published_year" value="{{$book->published_year??''}}" required>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </body>
</html>