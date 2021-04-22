<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/stylesheets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
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

        <div class="container my-5 w-75 p-3">
<?php   if($this->session->userdata('user_level') =="admin"){               ?>                       
            <div class="d-flex justify-content-between align-items-center ">
                <h1 class="w-75">Manage Users</h1>
                <a class="btn btn-primary" href="/users/new"><i class="fas fa-user-plus p-1"></i>Add New</a>
            </div>   
<?php   }else{                                                              ?>
            <h1 class="w-75">All Users</h1>
<?php           }                                                           ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">email</th>
                    <th scope="col">created_at</th>
                    <th scope="col">user_level</th>
<?php           if($this->session->userdata('user_level') =="admin"){       ?>                       
                    <th scope="col">actions</th>    
<?php           }                                                           ?>
                    </tr>
                </thead>
                <tbody>
<?php       for($i=0;$i<count($users);$i++){                                ?>
                    <tr>
                        <th scope="row"><?=$users[$i]['user_id']?></th>
                        <td><a href="/users/goToWall/<?=$users[$i]['user_id']?>"><?=$users[$i]['first_name']?> <?=$users[$i]['last_name']?></a></td>
                        <td><?=$users[$i]['email']?></td>
                        <td><?=$users[$i]['created_at']?></td>
                        <td><?=$users[$i]['user_type']?></td>
<?php               if($this->session->userdata('user_level') =="admin"){   ?>                       
                        <td class="text-center d-flex justify-content-around"><a href=""><i class="fas fa-user-edit"></i></a>|<a href=""><i class="fas fa-trash-alt"></i></a></td>
<?php               }                                                       ?> 
                    </tr>
<?php       }                                                               ?>                     
                </tbody>
            </table>
        </div>


    </div>
</body>
</html>