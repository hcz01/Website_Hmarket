<div id="popup" class="popup">
  <div class="popup-content">
    <div class="Page_close" onclick="closePopup()">X</div>
    <div id="log">

  

        <form id="login-form">
            <p2>Account Login/Regist</p2>
            <div class="form-group">
              <label for="user">username</label>
              <input type="username" name="user"class="form-control" id="username" aria-describedby="emailHelp" placeholder="Enter username/email" >
            </div>
            <div class="form-group">
              <label for="pass">Password</label>
              <input type="password" name="pass"class="form-control" id="password" placeholder="Password" >
            </div>
            <input type="checkbox" onclick="ShowPass()">Show Password<br>
            <button type="submit" id="login" class="btn btn-primary">Login/Regist</button>
          </form>
    </div>
  </div>
</div>