<?php
require_once 'include/config.php';
$pesan = "";
if(isset($_SESSION['loginsukses'])){
    if(isset($_GET['keluar'])){
        session_destroy();
        header("location:./login.php");
    }
    echo '
    <!DOCTYPE html>
    <html>
    <head>
    <title>Admin Panel</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css" />
      <style>
      @charset "UTF-8";
    .hero .title a {
      text-decoration: underline;
    }
    
    h1 {
      font-size: 2em;
    }
    
    @media screen and (max-width: 800px) {
      .is-responsive {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        display: block;
        position: relative;
      }
      .is-responsive td:empty:before {
        content: " ";
      }
      .is-responsive th,
      .is-responsive td {
        margin: 0;
        vertical-align: top;
      }
      .is-responsive th {
        text-align: left;
      }
      .is-responsive thead {
        border-right: solid 2px #dbdbdb;
        display: block;
        float: left;
      }
      .is-responsive thead tr {
        display: block;
        padding: 0 10px 0 0;
      }
      .is-responsive thead tr th::before {
        content: " ";
      }
      .is-responsive thead td,
      .is-responsive thead th {
        border-width: 0 0 1px;
      }
      .is-responsive tbody {
        display: block;
        width: auto;
        position: relative;
        overflow-x: auto;
        white-space: nowrap;
      }
      .is-responsive tbody tr {
        display: inline-block;
        vertical-align: top;
      }
      .is-responsive th {
        display: block;
        text-align: right;
      }
      .is-responsive td {
        display: block;
        min-height: 1.25em;
        text-align: left;
      }
      .is-responsive th:last-child,
      .is-responsive td:last-child {
        border-bottom-width: 0;
      }
      .is-responsive tr:last-child td:not(:last-child) {
        border: 1px solid #dbdbdb;
        border-width: 0 0 1px;
      }
      .is-responsive.is-bordered td,
      .is-responsive.is-bordered th {
        border-width: 1px;
      }
      .is-responsive.is-bordered tr td:last-child,
      .is-responsive.is-bordered tr th:last-child {
        border-bottom-width: 1px;
      }
      .is-responsive.is-bordered tr:last-child td,
      .is-responsive.is-bordered tr:last-child th {
        border-width: 1px;
      }
}

    </style>

    </head><body>
    <section class="hero is-info">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            Admin Panel
          </h1>
          <h2 class="subtitle">
            Selamat Datang di Admin Panel.
          </h2>
        </div>
      </div>
    </section>
    <section class="section">
    ';
    if(isset($_GET['delete'])){
        $id = mysqli_real_escape_string($conn,$_GET['delete']);

        // sql to delete a record
        $sql = "DELETE FROM links WHERE link_no=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Link Sukses dihapus";
        } else {
            echo "Gagal dihapus: " . $conn->error;
        }
        echo "<hr>";
    }
    echo '
    <table class="table table-responsive is-responsive is-fullwidth is-striped is-bordered is-hoverable">
      <tr>
        <th>ID</th>
        <th>Unique</th>
        <th>Create</th>
        <th>Delete</th>
        <th>Link Original</th>
      </tr>
    ';
    $sql = "SELECT * FROM links";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '
              <tr>
                <td>'.$row["link_no"].'</td>
                <td><a href="'._URL.$row["link_id"].'">'.$row["link_id"].'</a> </td>
                <td>'.$row["link_date_create"].'</td>
                <td class="has-text-centered"><a href="?delete='.$row["link_no"].'" class="button is-danger">Delete</a></td>
                <td>'.$row["link_ori"].'</td>
              </tr>
            ';
        }
    } else {
        echo 'Short Link is Empty';
    }
    echo '
    </table>
    </section>
    <footer class="footer">
      <div class="container">
        <div class="content has-text-centered">
          <p>
            Dibuat oleh <strong>Aminatus</strong> Sa\'diyah. [ <a href="?keluar=yes">LogOut</a> ]
          </p>
        </div>
      </div>
    </footer>
    </body></html>
    ';
}else{
    header("location:./login.php");
}
