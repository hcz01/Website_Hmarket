<div id="popup" class="popup">
  <div class="popup-content">
    <div class="Page_close" onclick="closePopup()">X</div>
    <div id="log">
        <form action="./Database/ConfirmUser.php" method="post">
            <p2>Account Login/Regist</p2>
            <div class="form-group">
              <label for="user">Email address</label>
              <input type="username" name="user"class="form-control" id="InputEmail1" aria-describedby="emailHelp" placeholder="Enter username/email">
            </div>
            <div class="form-group">
              <label for="pass">Password</label>
              <input type="password" name="pass"class="form-control" id="InputPassword1" placeholder="Password">
            </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="Check1">
              <label class="form-check-label" for="eCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Login/Regist</button>
          </form>
    </div>
  </div>
</div>