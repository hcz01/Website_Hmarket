<div id="popup" class="popup">
  <div class="popup-content">
    <div class="Page_close" onclick="closePopup()">X</div>
    <div id="log">

    <?php



use Firebase\JWT\JWT;

require_once('../vendor/autoload.php');
?>

        <form action="home" method="post">
            <p2>Account Login/Regist</p2>
            <div class="form-group">
              <label for="user">Email address</label>
              <input type="username" name="user"class="form-control" id="username" aria-describedby="emailHelp" placeholder="Enter username/email" >
            </div>
            <div class="form-group">
              <label for="pass">Password</label>
              <input type="password" name="pass"class="form-control" id="password" placeholder="Password" >
            </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="Check1">
              <label class="form-check-label" for="eCheck1">Check me out</label>
            </div>
            <button type="submit" id="login" onclick="verifyUser()" class="btn btn-primary">Login/Regist</button>
          </form>
    </div>
  </div>
</div>