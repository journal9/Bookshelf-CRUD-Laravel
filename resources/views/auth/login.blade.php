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
            <h2 class="text-center text-dark mt-5">Login Form</h2>
            <div class="text-center mb-5 text-dark">Made with bootstrap</div>
            <div class="card my-5">

            <form class="card-body cardbody-color p-lg-5" method="POST" action="{{Route('login-route')}}">
                @csrf
                @method("POST")
                <div class="text-center">
                <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                    width="200px" alt="profile">
                </div>

                <div class="mb-3">
                <input type="text" class="form-control" name="email" aria-describedby="emailHelp"
                    placeholder="User Email">
                </div>
                <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="password">
                </div>
                <div class="text-center"><button type="submit" class="btn btn-dark px-5 mb-5 w-100">Login</button></div>
            </form>
            </div>

        </div>
        </div>
    </div>
    </body>
</html>