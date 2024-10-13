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
            Add User
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
        <form method="post" action="{{route('users-add')}}">
            @csrf
            @method('post')
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label>User Name</label>
                    <input type="text" class="form-control" id="validationDefault01" name="name" placeholder="user name" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label>User Email</label>
                    <input type="text" class="form-control" id="validationDefault02" name="email" placeholder="email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label>User Age</label>
                    <input type="text" class="form-control" id="validationDefault03" name="age" placeholder="age" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label>Role</label>
                    <input type="text" class="form-control" id="validationDefault03" name="role" placeholder="role" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label>Password</label>
                    <input type="text" class="form-control" id="validationDefault03" name="password" placeholder="password" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label>Phone Number</label>
                    <input type="text" class="form-control" id="validationDefault04" name="phone_number" placeholder="number" required>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </body>
</html>