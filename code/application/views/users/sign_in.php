<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/stylesheets/style.css">
</head>
<body>
    <div class="container-fluid extend">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= base_url(); ?>">Test App</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Home</a>
                        </li>
                    </ul>
                    <a class="nav-link" href="sign-in">Sign In</a>
                </div>
            </div>
        </nav>

        <div class="container my-5 w-50 p-3 border">
            <h1>Sign In</h1>
            <form action="users/validate" method="POST">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email address:</label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Password: </label>
                    <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="Password">
                </div>
                <div class="mb-3">
                    <input type="submit" value="Sign In" class="btn btn-primary">
                </div>
                <div class="mb-3">
                    <a class="" href="sign-up">Don't have an account? Register</a>
                </div>
            </form>
        </div>


    </div>
</body>
</html>