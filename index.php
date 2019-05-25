<?php 
    require 'core.php'; 
    if(isset($_POST['login'])){
        $username = filter_var(mysql_real_escape_string(htmlspecialchars($_POST['username'])), FILTER_SANITIZE_STRING);
        $password = $_POST['password'];

        if(empty($username) && empty($password)){
            $msg = "<center><span style='color: red;'>Fields plsss man</span></center><br>";
        } else {
            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
            $result = $conn->query($sql);

            if($result->num_rows > 0){
                foreach ($result as $k) {
                    $_SESSION['id'] = $k['id'];
                    header("Location: $site");
                }
            } else {
                $msg = "<center><span style='color: red;text-align:'>Error username or password</span></center><br>";
            }
        }
    }

    if($_GET['action'] == 'logout'){
        session_destroy();
        header("Location: $site");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel login</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <style>
    body {
        background: <?php echo $colorsv; ?>;
        margin: 60px 0px 0px 0px;
    }
    .card-title {
        color: #444;
        font-weight: 300 !important;
    }
    .mybutton {
        width: 70%;
        background: <?php echo $colorsv; ?> !important;
        box-shadow: none !important;
        border-radius: 0px;
    }
    .card {
        box-shadow: none !important;
        border-radius: 0px !important;
    }
    </style>
</head>
<body>
<div class="container">
<div class="row">
    <div class="col s12 m8 offset-m2 l4 offset-l4">
      <div class="card">
        <div class="card-content black-text">
          <span class="card-title center">Simple login</span>
          <?php 
          if(isset($_SESSION['id'])){
              echo "<center><span style='color: green;text-align:'>Hello ". $user[username] ."!</span><br><a href='index.php?action=logout'>Logout</a></center>";
              
          } else {
            if($msg){ echo $msg; }
          }
          ?>
          <?php if(!isset($_SESSION['id'])){ ?>
          <div class="row">
            <form method="POST" class="col s12">
              <div class="row">
              <div class="input-field col s12">
                <input id="username" name="username" type="text" class="validate" required autofocus autocomplete="off">
                <label for="username">Username</label>
              </div>
              <div class="input-field col s12">
                <input id="password" name="password" type="password" class="validate" required>
                <label for="password">Password</label>
              </div>
              <div class="input-field col s12">
              <center>
              <button class="btn waves-effect waves-light mybutton" type="submit" name="login">Login
                <i class="material-icons right">send</i>
              </button>
              </center>
              </div>
              </div>
            </form>
        </div>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>