<?php
require_once 'include/config.php';
if(!empty($_SESSION['loginsukses'])) {
    header("location:./admin.php");
}

if(isset($_POST['submit']) && isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(($username == _ADMINUSERNAME) && ($password == _ADMINPASSWORD)){
        $_SESSION['loginsukses'] = 'sukses';
        header("location:./admin.php?login=success");
    }else{
        $pesan='eror';
        header("location:./login.php?login=failed");
    }
} else{
    echo '
    <!DOCTYPE html>
    <html>
    <head>
    <title>Login Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <style>
    body{  
        background: linear-gradient(110deg, #8684f3 40%, rgba(0, 0, 0, 0) 30%), radial-gradient(farthest-corner at 0% 0%, #88ccc4 70%, #4cb7a8 70%);
        font-size: 1.2em;
        font-weight: 710; 
    }
    .container{
        padding: 13% 20% 20% 37%;
    }
    .box{
        max-width: 310px;
        background: white;
        padding: 30px 30px 30px 30px;
        border-radius: 3%; 
        box-shadow: 3px 3px 5px 6px #ccc;
    }
    * > input[type=text],input[type=password]{ 
        height: 35px;
        width: 100%;
        border: black solid 1px;
        font-size: 0.8em;
        border-radius: 4px;
    }
    input:hover{
        background: rgba(0,191,255,0.13);
    }
    * > input[type=submit]{
        background: linear-gradient(-90deg, #3a50ff, #ba00ba);
        color: white;
        font-weight: 600;
        font-size: 0.9em;
        height: 43px;
        width: 100%;
        border-radius: 7px;
    } 
    input[type=submit]:hover{
        background: linear-gradient(-90deg, #37479a, #a902ff);
    }
    </style>
    </head>
    <body>
    <div class="container">
        <div class="box"> ';
    if(isset($_GET['login'])){
        echo '<p><b>Login Gagal</b></p>';
    }
    echo '
        <form sction="" method="POST">
        <p>
        Username : <br>
        <input type="text" name="username" placeholder="Username"> <br/>
        </p>
        Password : <br>
        <input type="password" name="password" placeholder="Password"><br>
        <p>
            <input type="submit" name="submit" value="Login">
        </p>
        </form>
        </div>
    </div>
    </body>
    </html>
    ';
}