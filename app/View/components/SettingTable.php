
<div class="conta_main">
      <!-- Left Panel -->
    <div class="cont_panel">
    <ul>
    <li id="profileItem">
        <div id="avatar-button"><img src="picture/defaultUserAvatar.png" class="avatar-image"  width="60" height="60">
                <p id="Settingname"></p>
            </li>
  <li><a id="href_setting" class="active">Setting</a></li>
  <li><a id="href_credit">Credit</a></li>
</ul>
    </div>
      <!-- Right Context Page -->
    <div  class="contextPage" >
    <div id="profilePage">
        <form id="profileTemplete">
        <label for="steamid">STEAMID</label>
        <input class="form-control my-2 text-center" name="steamid" id="edit-stemaid">  
        <label for="API_KEY">API KEY</label>
        <input class="form-control my-2 text-center" name="API_KEY" id="edit-API_KEY">
        <label for="tradeurl">trade offer access url</label>
        <input class="form-control my-2 text-center" name="tradeurl" id="edit-tradeurl">
        <label for="email">email</label>
        <input class="form-control my-2 text-center" name="email" id="edit-email">
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div id="CreditPage" >
        <div>Your credit :<p id="AccountCredit">0</p></div>
    <form id="CreditTemplete">
        Using the CDK (Card Key) To load the coin purse.<br>
        <label for="CDK">CDK</label>
        <input class="form-control my-2 text-center" name="CDK" id="cdkInput"> 
        
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
</div>