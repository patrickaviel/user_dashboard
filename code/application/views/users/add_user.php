<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User</title>
    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/stylesheets/style.css">
</head>
<body>
    <div class="container-fluid extend">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/users/showDashboard">Test App</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/users/showDashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/users/edit">Profile</a>
                        </li>
                    </ul>
                    <a class="nav-link" href="logoff">Log Off</a>
                </div>
            </div>
        </nav>

        <div class="container my-5 w-50 p-3 ">
            <div class="d-flex justify-content-between align-items-center ">
                <h1 class="w-75">Add a New User</h1>
                <a class="btn btn-primary btn-sm" href="/users/showDashboard">Return to Dashboard</a>
            </div>
            <form action="/users/create_user_admin" method="POST" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" >First Name: </label>
                    <input type="text" name="first_name" class="form-control" placeholder="First Name">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Last Name: </label>
                    <input type="text" name="last_name"class="form-control" placeholder="Last Name">
                </div>
                <div class="col-12">
                    <label class="form-label">Email Address: </label>
                    <input type="email" name="email" class="form-control" placeholder="Email Address">
                </div>
                <div class="col-12">
                    <label class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="col-12">
                    <label class="form-label">Password Confirmation:</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-primary" value="Create">
                </div>
            </form>
        </div>
        
    </div>
</body>
</html>