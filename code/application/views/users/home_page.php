<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/stylesheets/style.css">
</head>
<body>
    <div class="container-fluid extend">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Test App</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                    </ul>
                    <a class="nav-link" href="sign-in">Sign In</a>
                </div>
            </div>
        </nav>

        <div class="bg-light p-5 rounded w-75 p-3 my-5 mx-auto">
            <h1>Welcome to the Test!</h1>
            <p class="lead">We're going to build a cool application using a MVC framework! This application was built with the Village88 Folks!</p>
            <a class="btn btn-lg btn-primary" href="sign-in" role="button">Start &raquo;</a>
        </div>

        <div class="row w-75 mx-auto">
            <div class="col-sm-4">
                <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Manage Users</h5>
                    <p class="card-text">
                        Using this application, you'll learn how to add, remove, and edit users for the application.
                    </p>
                </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Leave Messages</h5>
                    <p class="card-text">
                        Users will be able to leave a message to another using this application.
                    </p>
                </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Edit User Information</h5>
                    <p class="card-text">
                        Admins will be able to edit another user's information (email address, first name, last name, etc.).
                    </p>
                </div>
                </div>
            </div>
        </div>


    </div>
</body>
</html>