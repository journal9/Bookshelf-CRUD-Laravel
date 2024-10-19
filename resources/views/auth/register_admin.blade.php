<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Document</title>
        <link rel="stylesheet" href="/public/css/login.css">
    </head>
    <body>
        <div class="container">
        <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center text-dark mt-5">Register Admin User</h2>
            <div class="card my-5">
            <form method="post" action="{{route('register')}}">
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
                        <input type="text" class="form-control" id="validationDefault03" name="role_id" placeholder="role" required>
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
            </div>

        </div>
        </div>
    </div>
    </body>
</html>