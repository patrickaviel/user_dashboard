<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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
                        <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Profile</a>
                        </li>
                    </ul>
                    <a class="nav-link" href="/users/logoff">Log Off</a>
                </div>
            </div>
        </nav>

        <div class="container my-2 w-75 p-3 ">
            <div class="d-flex justify-content-between align-items-center ">
                <h1 class="w-75">Edit User #<?= $user_id ?></h1>
                <a class="btn btn-primary" href="/users/showDashboard">Return to Dashboard</a>
            </div>
            <div class="container">
                <div class="row d-flex justify-content-around">
                    <div class="col-5 border p-3">
                        <h3>Edit Information</h3>
                        <form action="/users/editADescription" method="POST">
                            <input type="hidden" name="user_id" value="<?= $user_id ?>">
                            <label class="form-label">Email Address: </label>
                            <input type="email" name="email" class="form-control" value="<?= $email ?>" placeholder="Email Address">
                            <label class="form-label" >First Name: </label>
                            <input type="text" name="first_name" class="form-control" value="<?= $first_name ?>" placeholder="First Name">
                            <label class="form-label">Last Name: </label>
                            <input type="text" name="last_name" class="form-control" value="<?= $last_name ?>" placeholder="Last Name">
                            <div class="input-group mb-3 my-4">
                                <label class="input-group-text" for="inputGroupSelect01">User Level</label>
                                <select class="form-select" name="user_level">
                                    <option selected><?= $user_level ?></option>
                                    <option value="normal">Normal</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <input type="submit" class="btn btn-success btn-sm float-end w-25 my-2" value="Save">
                        </form>
                    </div>
                    <div class="col-5 border p-3">
                        <h3>Change Password</h3>
                        <form action="/users/editAPassword" method="POST">
                            <label class="form-label">Password:</label>
                            <input type="hidden" name="user_id" value="<?= $user_id ?>">
                            <input type="hidden" name="email" value="<?= $email ?>">
                            <input type="password" name="password" value="<?= $password ?>" class="form-control" placeholder="Password">
                            <label class="form-label">Password Confirmation:</label>
                            <input type="password" name="confirm_password" value="<?= $password ?>" class="form-control" placeholder="Confirm Password">
                            <input type="submit" class="btn btn-success btn-sm float-end w-50 my-2" value="Update Password">
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</body>
</html>