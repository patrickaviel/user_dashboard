<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
                    <a class="nav-link" href="logoff">Log Off</a>
                </div>
            </div>
        </nav>

        <div class="container my-2 w-75 p-3 ">
            <h1 class="w-75">Edit Profile</h1>
            <div class="container">
                <div class="row d-flex justify-content-around">
                    <div class="col-5 border p-3">
                        <h3>Edit Information</h3>
                        <form action="/users/editInformation" method="POST">
                            <label class="form-label">Email Address: </label>
                            <input type="text" name="email" class="form-control" value="<?= $this->session->userdata('email')?>" placeholder="Email Address">
                            <label class="form-label" >First Name: </label>
                            <input type="text" name="first_name" class="form-control" value="<?= $this->session->userdata('first_name')?>" placeholder="First Name">
                            <label class="form-label">Last Name: </label>
                            <input type="text" name="last_name" class="form-control" value="<?= $this->session->userdata('last_name')?>" placeholder="Last Name">
                            <input type="submit" class="btn btn-primary btn-sm float-end w-25 my-2" value="Save">
                        </form>
                    </div>
                    <div class="col-5 border p-3">
                        <h3>Change Password</h3>
                        <form action="/users/editPassword" method="POST">
                            <label class="form-label">Password:</label>
                            <input type="password" name="password" class="form-control" value="<?= $this->session->userdata('first_name')?>placeholder="Password">
                       
                            <label class="form-label">Password Confirmation:</label>
                            <input type="password" name="confirm_password" class="form-control" value="<?= $this->session->userdata('first_name')?> placeholder="Confirm Password">
                            <input type="submit" class="btn btn-primary btn-sm float-end w-50 my-2" value="Update Password">
                        </form>
                    </div>
                    <div class="col-11 border p-3 my-3">
                        <h3>Edit Description</h3>
                        <form action="/users/editDescription" method="POST">
                            <textarea class="form-control" name="description" placeholder="Edit your description" style="height: 100px"><?= $this->session->userdata('description')?></textarea>
                            <input type="submit" class="btn btn-primary btn-sm float-end w-25 my-2" value="Save">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</body>
</html>