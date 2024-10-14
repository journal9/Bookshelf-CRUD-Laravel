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
    <div class="box_container" style="margin-bottom:2rem;">
        <div class="display-3">
            {{$user->name}}'s Bookshelf
        </div>
        <div class="row">
            <div class="col-8">
            <div class="card_container">
                @if($all_books)
                    @foreach($all_books as $book)
                        <div class="card">
                            <div class="card-header">
                                {{$book->title}}
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                <p>{{$book->author_name}}</p>
                                <footer class="blockquote-footer">{{$book->genre}}<cite title="Source Title">{{$book->published_year}}</cite>
                                <a class="btn btn-primary">Add</a>
                                </footer>
                                </blockquote>
                            </div>
                        </div>
                    @endforeach
                @endif
                </div>
            </div>
            <div class="col-4">
                <div class="card_container">
                    @if($user)
                        @foreach($user->books as $mbook)
                            <div class="card">
                                <div class="card-header">
                                    {{$mbook->title}}
                                </div>
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                    <p>{{$mbook->author_name}}</p>
                                    <footer class="blockquote-footer">{{$mbook->genre}}>
                                    </footer>
                                    </blockquote>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>