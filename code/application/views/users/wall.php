<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
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
            <div class="container">
                <h2><?= $this->session->userdata('full_name') ?></h2>
                <p> Created At: <?= $this->session->userdata('created_at') ?></p>
                <p>User ID: <?= $this->session->userdata('user_id') ?></p>
                <p>Email Address: <?= $this->session->userdata('email') ?></p>
                <p>Description: <?= $this->session->userdata('description') ?></p>
            </div>
            
            <div class="container">
                <div class="row d-flex justify-content-around">
                    <div class="col-11 border p-3 my-3">
                        <h3>Leave a message for <?= $this->session->userdata('full_name') ?></h3>
                        <form action="<?=base_url();?>wall/add_message" method="post">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                            <textarea class="form-control" name="message_input" placeholder="Edit your description" style="height: 100px"></textarea>
                            <input type="submit" class="btn btn-primary btn-sm float-end w-25 my-2" value="Post">
                        </form>
                        <div class="col-11 border p-3 my-5 mx-auto">
                            <h5>John Wrote</h5>
                            <textarea class="form-control" placeholder="Edit your description" id="floatingTextarea2" style="height: 100px"></textarea>
                            <div class="col-11 border p-3 my-5 mx-auto">
                                <h5>John Wrote</h5>
                                <form action="">
                                    <textarea class="form-control" placeholder="Edit your description" id="floatingTextarea2" style="height: 100px"></textarea>
                                </form>
                                <div class="col-11 border p-3 my-5 mx-auto">
                                    <h5>John Wrote</h5>
                                    <form action="">
                                        <textarea class="form-control" placeholder="Edit your description" id="floatingTextarea2" style="height: 100px"></textarea>
                                        <input type="submit" class="btn btn-primary btn-sm text-right w-25 my-2" value="Post">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <?php   
                    
                    
                    foreach( $param['inbox'] as $message) {
            ?>
                        <h3><?=$message["message_sender_name"]?> - <?=$message["message_date"]?></h3>
                        <p><?=$message["message_content"]?></p>
                            
            <?php       foreach($message['comments'] as $comment) {
            ?>              <h4><?=$comment['comment_sender_name']?> - <?=$comment['comment_date']?></h4>
                            <p><?=$comment['comment_content']?></p>
            <?php       }
            ?>          <form action="<?=base_url();?>wall/add_comment" method="post" class="comment_form">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                            <input type="hidden" name="message_id" value="message_id"/>

                            <label for="comment_input">Post a comment</label>
                            <textarea name="comment_input"></textarea>               

                            <input type="submit" value="Post a comment"/>
                        </form> 
            <?php   }
            ?>




        </div>
        
    </div>
</body>
</html>