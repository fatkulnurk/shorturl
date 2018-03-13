<?php
require_once 'include/config.php';
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    $sql = "SELECT * FROM links WHERE link_id='$id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $result = $result->fetch_array();
        $redir = $result['link_ori'];
        if(!empty($result['link_password'])){
            if(isset($_POST['password']) && ($result['link_password'] == $_POST['password'])){
                header("location:$redir");
            }else{

                echo '
                <!DOCTYPE html>
                <html>
                <head>
                <title>Link di Protect</title>
                <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css" />
                </head>
                <body>
                <section class="hero is-default is-fullheight">
                  <div class="hero-body">
                    <div class="container has-text-left">
                      <h1 class="title">
                        Masukan Password
                      </h1> 
                         <form action="" method="post">
                      <div class="field has-addons has-text-centered">
                          <div class="control">
                            <input class="input" name="password" type="password" placeholder="Enter Password">
                          </div>
                          <div class="control">
                            <input type="submit" class="button is-info" value="submit">
                          </div>
                        </div> 
                        </form>
                    </div>
                  </div>
                </section>
                </body>
                </html>
                ';
            }
        }else{
            header("location:$redir");
        }
    }else{
        die("<h1>Maaf link tidak tersedia.</h1>");
    }
}else{
    die('Halaman tidak ditemukan.');
}

// close connection from mysql database
mysqli_close($conn);