//Is a Simple Version for get the data of Csgo Item 
//the complete version should use the project of VDF to manage the csgo items data and convert to a Object but i didnt find a way to get every picture of items  
//I have downloaded all data of Csgo Items from a API (thks Csgo-API) and add it on Database
let baseurl = window.location.origin + '/Hmarket';
let url = baseurl + '/app/Controller/Viewitems.php';
let urlObj = new URL(url);
let inputParams = new URLSearchParams(urlObj.search);
//ready for select items;
let selected = [];
let Coin="€";
$(document).ready(function(){
  var menuVisible = false;
  //work only on home page
  if (window.location.pathname === '/Hmarket/public/home') {
    
    //slides show 
    var slides = document.querySelectorAll('.slide-img');
    var dotsContainer = document.querySelector('.dots');

    var currentSlide = 0;
    var timer;
    function showSlide(index) {
      if (index >= slides.length) {
        currentSlide = 0;
      } else if (index < 0) {
        currentSlide = slides.length - 1;
      }

      slides.forEach(function(slide) {
        slide.style.display = 'none';
      });

      slides[currentSlide].style.display = 'block';

      var dots = document.querySelectorAll('.dot');
      dots.forEach(function(dot) {
        dot.classList.remove('active');
      });
      dots[currentSlide].classList.add('active');
    }

    function nextSlide() {
      currentSlide++;
      showSlide(currentSlide);
    }

    slides.forEach(function(slide, index) {
      var dot = document.createElement('span');
      dot.classList.add('dot');
      dot.addEventListener('click', function() {
        showSlide(index);
      });
      dotsContainer.appendChild(dot);
    });
    showSlide(currentSlide);
    timer = setInterval(nextSlide, 3000);



    
    
    //get cards
    $.ajax({url: RandomItems(), 
      success: function(result){
      var cards=[];
      var parsedData = JSON.parse(result);
      parsedData.forEach(element => {
          cards.push(element);
      });
      buildItem(cards);
}}
); 




  }



  //work only on inventory page
  if (window.location.pathname === '/Hmarket/public/inventory') {
    $.ajax(
      {url: 'ajax', 
      dataType: "json",
            method: 'POST',
            data: {
              request: 'refersh',
              userid: getUseridFromCookie()
            },
      success: function(result){
      buildInventoryItem(result);
}}
); 
  }

  if (window.location.pathname === '/Hmarket/public/goods') {
    // default of page, check input from page else return 404 page
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    $.ajax({
        url: 'ajax',
        dataType:'json',
        method: 'POST',
        data: {
            request: 'Get_Detagli_OF_Category',
            category_id: id
        },
        success: function(response) {
            var itemName = response[0].name;
            var itemImgSrc = response[0].image;
    
            var detailContDiv = document.createElement("div");
            detailContDiv.className = "text-overlay";
    
            var name = document.createElement("h1");
            name.textContent = itemName;
            detailContDiv.appendChild(name);
    
            var parentElement = document.getElementsByClassName("detail-pic")[0];
    
            var img = document.createElement("img");
            img.setAttribute("src", itemImgSrc);
            img.style.maxWidth = "269px";
            img.style.maxHeight = "176px";
    
            parentElement.appendChild(detailContDiv);
            parentElement.appendChild(img);
            getSellitems(id);
        },error: function(data) {
          window.location("404.php");
        }
    });
   
    
    
  }




  if (window.location.pathname === '/Hmarket/public/managesell') {
      ShowSell();
      Get_NumberToSend();
  
  }
  if (window.location.pathname === '/Hmarket/public/market') {
    
    GetRandomItemsByNumber(100)
    .then((data) => {

      BuildMarketTable(data);
    })
    .catch((error) => {
      console.error(error);
    });

  }

  if (window.location.pathname === '/Hmarket/public/setting') {
    $("#Settingname").text(getUseridFromCookie);
    $('#profilePage').show();
    $('#CreditPage').hide();
    getUserinfo();
    

  }

  $(document).on("click","#href_setting", function() {
      $("#href_setting").addClass('active');
      $("#href_credit").removeClass('active');
      $('#profilePage').show();
      $('#CreditPage').hide();
      getUserinfo();
  });

  $(document).on("click","#href_credit", function() {
    $("#href_credit").addClass('active');
    $("#href_setting").removeClass('active');
    $('#CreditPage').show();
    $('#profilePage').hide();
    printCredit();
});

     
      $( "#profileTemplete" ).on( "submit", function( event ) {
        event.preventDefault();
        var steamid=$("#edit-stemaid").val();
        var API_KEY=$("#edit-API_KEY").val();
        var tradeurl=$("#edit-tradeurl").val();
        var email=$("#edit-email").val();
        $array={"STEAM_ID": steamid,"API_key": API_KEY,"trade_offer_access_url": tradeurl,"email": email};
        $.ajax({
          url: 'ajax',
          dataType: 'json',
          method: 'POST',
           data: {
          request:'UpdateUserInfo',
          user_id: getUseridFromCookie(),
          data: JSON.stringify($array)
        },
        success: function(response) {
          location.reload();
          alert("Modified data");
        },
        error: function(error) {
         console.log(error);
          
        }
        });
        
      });

      $("#CreditTemplete" ).on( "submit", function( event ) {
        event.preventDefault();
        var cdkInput=$("#cdkInput").val();
        $.ajax({
          url: 'ajax',
          dataType: 'json',
          method: 'POST',
           data: {
          request:'AddCredit',
          user_id: getUseridFromCookie(),
          creditKey: cdkInput
        },
        success: function(response) {
          printCredit();
          alert("Sended charch");
        },
        error: function(error) {
         console.log(error);
          
        }
        });
        

      });
      //set toggle for class arrow (not work yet)
    $(document).on("click",".w-Order span", function() {
      $(this).find("i").toggleClass("bi-arrow-up-short bi-arrow-down-short");
    });


      $( "#login-form" ).on( "submit", function( event ) {
        event.preventDefault();
        //send request for have jwt;
        var username = $("#username").val();
        var password = $("#password").val();
          $.ajax({
            url: 'login',
            dataType: "json",
            method: 'POST',
            data: {
              username: username,
              password: password
            },
            success: function(response) {
              
              if(response.message!='User was successfully registered.'){

                try{
                  var jwt = response.jwt;
                  console.log(response.id);
                  document.cookie = `jwt=${jwt}`;
                  document.cookie=userid+"="+response.id;
                  VerifyJWT();
                }catch(err){
                  location.reload();
                }
               
              }else{
                //user was succesfully registered 
                location.reload();
                alert(response.message);

              }
                
             },
            error: function(data) {
              alert("Login failed");
            }
          });


      });

      $(document).on("click", "#inventory", function() {
        window.location = "inventory";
      });

      $(document).on("click", "#manageSell", function() {
        window.location = "managesell";
      });

      
      $(document).on("click", "#avatar-button", async function() {
        // Show/hide the avatar dropdown menu
        menuVisible = !menuVisible;
        if (menuVisible) {
          try {
            const response = await $.ajax({
              url: "ajax",
              dataType: "json",
              type: "POST",
              data: {
                request: 'GetCredit',
                user_id: getUseridFromCookie()
              }
            });
            await ShowCredit(response[0].credit);
          } catch (error) {
            console.error("Error retrieving credit:", error);
          }
        }

      });

 $(document).on("click", "#Setting-button", function() {
    window.location="setting";
 });
  // Handle logout button click
  $(document).on("click", "#logout-button", function(){
    removeCookie("jwt");
    window.location.reload();
  });
      //validate jwt
      VerifyJWT();
    
});

async function ShowCredit(credit) {
  try {
    await (async function(credit) {
      return new Promise((resolve) => {
        $("#user_credit").text("Credit: " + credit+Coin);
        resolve();
      });
    })(credit);
  } catch (error) {
    console.error("Error updating credit:", error);
  }
}

function printCredit(){
  $.ajax({
    url: "ajax",
    dataType: "json",
    type: "POST",
    data: {
      request: 'GetCredit',
      user_id: getUseridFromCookie()
    },
    success: function(response) {
      $("#AccountCredit").text(response[0].credit+Coin);
    },
    error: function(error) {
      $("#AccountCredit").text("error");
      
    }
  });

}
function getUserinfo(){
  $.ajax({
    url: 'ajax',
    dataType: 'json',
    method: 'POST',
     data: {
    request:'GetUserInfo',
    user_id: getUseridFromCookie()
  },
  success: function(response) {
    $("#edit-stemaid").val(response.STEAM_ID);
    $("#edit-API_KEY").val(response.API_key);
    $("#edit-tradeurl").val(response.trade_offer_access_url);
    $("#edit-email").val(response.email);
  },
  error: function(error) {
   console.log(error);
    
  }
  });
}



//GET ./Database/Viewitems.php?random=20  return 20 random items info
function RandomItems(){
    //default no params 
    if(inputParams !== null)
    {
        inputParams.set('random', 10);
        urlObj.search = inputParams.toString();
    }
    return urlObj.toString();
}

//GET ./Database/Viewitems.php?Category=Category
function FindCategory(Category){
    if(inputParams !== null)
    {
        inputParams.append('Category', Category);
        return inputParams;
    }
   
}

//GET ./Database/Viewitems.php?name=name
function FindSpecificItem(name){
    if(inputParams !== null)
    {
        inputParams.append('name', name);
        return inputParams;
    }
}


function buildItem(cards){
    var ul = $("<ul>");
    for (var i = 0; i < cards.length; i++) {
        var card = cards[i]; 
        //a redirect goods info
        var li = $("<li>").addClass("card").attr("width",208).attr("height",228);
        var img = $("<img>").attr("src", card.image).attr("width",210).attr("height",138);
        var h6 = $("<h6>").text(truncateText(card.name, 20));
        var p = $("<p>").text(card.id);
        li.append(img, h6, p);
        ul.append(li);
        if ((i + 1) % 5 == 0) {
            ul.append("<br>");
        }
        }
        $("#list_card").append(ul);
        

        
    }
    async function buildInventoryItem(cards) {
      var ul = $("<ul>");
      for (var i = 0; i < cards.length; i++) {
        var card = cards[i];
        var a = $("<a>").addClass("card-link");
        var li = $("<li>").addClass("card").attr("width", 208).attr("height", 228).attr("data-goods-info", JSON.stringify(card));
        var img = $("<img>").attr("src", "https://community.akamai.steamstatic.com/economy/image/" + card.icon_url).attr("width", 210).attr("height", 138);
        var h6 = $("<h6>").text(truncateText(card.market_name, 20));
        var p = $("<p>");
        a.append(img);
        li.append(a, h6, p);
        ul.append(li);
    
        li.click(selectItem);
    
        if ((i + 1) % 4 == 0) {
          ul.append("<br>");
        }
    
        try {
          await (function(categoryId) {
            return new Promise((resolve) => {
              getPrice(categoryId, (price) => {
                p.text(price + Coin);
                resolve();
              });
            });
          })(card['id_category']);
    
          (function(categoryId) {
            h6.click(function() {
              window.location.href = "goods?id=" + categoryId;
            });
          })(card['id_category']);

        } catch (error) {
          console.error("Error fetching price:", error);
          p.text("N/A");
        }
      }
      $("#list_card").append(ul);

    }
    
    function selectItem() {
      var $this = $(this);
      // Check if the element is already selected
      var isSelected = selected.some(function(item) {
        return item.is($this);
      });
      
      if (isSelected) {
        // Remove the element from the selected array
        selected = selected.filter(function(item) {
          return !item.is($this);
        });
    
        // Remove the "selected" class
        $this.removeClass("selected");
      } else {
        // Add the element to the selected array
        selected.push($this);
    
        // Add the "selected" class
        $this.addClass("selected");
      }
    }

function truncateText(text, maxLength) {
    if (text.length > maxLength) {
      text = text.substring(0, maxLength - 3) + "...";
    }
    return text;
  }

//Login page

    function openPopup() {
      var popup = document.getElementById("popup");
      popup.style.display = "block";
      popup.addEventListener("click", closePopupOutside);
      document.addEventListener("keydown", closePopupEsc);
    }

  
    function closePopupOutside(event) {
      var popup = document.getElementById("popup");
      if (event.target === popup) {
        closePopup();
      }
    }
  
    function closePopupEsc(event) {
      if (event.key === "Escape") {
        closePopup();
      }
    }
  
    function closePopup() {
      var popup = document.getElementById("popup");
      popup.style.display = "none";
  
      popup.removeEventListener("click", closePopupOutside);
      document.removeEventListener("keydown", closePopupEsc);
    }
  
  //sell page

  function openSellPopup() {
    if(selected.length>0){
      var popup = document.getElementById("open_pop_sell_table");
      popup.style.display = "block";
      //build data selected
      showSelectedtoSell(selected);
      popup.addEventListener("click", closeSellPopupOutside);
      document.addEventListener("keydown", closeSellPopupEsc);
    }else{
      alert("YOU NEED SELECTED ITEMS TO SELL");
    }
    

  }


  function closeSellPopupOutside(event) {
    var popup = document.getElementById("open_pop_sell_table");
    if (event.target === popup) {
      closeSellPopup();
    }
  }

  function closeSellPopupEsc(event) {
    if (event.key === "Escape") {
      closeSellPopup();
    }
  }

  function closeSellPopup() {
    var popup = document.getElementById("open_pop_sell_table");
    popup.style.display = "none";

    popup.removeEventListener("click", closeSellPopupOutside);
    document.removeEventListener("keydown", closeSellPopupEsc);
  }

  function showSelectedtoSell(data) {
    var table = document.createElement("table"); // Create a table element
  
    // Create table headers
    var headers = ["Item Name", "Icon", "Price (Market)", "Your Price"];
  var headerRow = document.createElement("tr");
  for (var h = 0; h < headers.length; h++) {
    var headerCell = document.createElement("th");
    headerCell.textContent = headers[h];
    headerRow.appendChild(headerCell);
  }
  table.appendChild(headerRow);

  // Create table rows for each selected item
  for (var i = 0; i < selected.length; i++) {
    var itemData = selected[i].data("goods-info"); // Extract data-goods-info attribute

    var row = document.createElement("tr");

    // Add cells with item data to the row
    var itemNameCell = document.createElement("td");
    itemNameCell.textContent = itemData.name;
    row.appendChild(itemNameCell);

    var iconCell = document.createElement("td");
    var iconImage = document.createElement("img");
    iconImage.src = "https://community.akamai.steamstatic.com/economy/image/" + itemData.icon_url;
    iconImage.width=72;
    iconImage.height=48;
    iconCell.appendChild(iconImage);
    row.appendChild(iconCell);

    var priceMarketCell = document.createElement("td");
    priceMarketCell.textContent = itemData.price_Market;
    row.appendChild(priceMarketCell);

    var yourPriceCell = document.createElement("td");
    var yourPriceInput = document.createElement("input");
    yourPriceInput.type = "number";
    yourPriceInput.required=true;
    yourPriceInput.value = itemData["Your-price"];
    yourPriceCell.appendChild(yourPriceInput);
    row.appendChild(yourPriceCell);

    table.appendChild(row);
  }
  
    // Append the table to a container element
    var container = document.getElementById("data_sell"); 
    container.innerHTML = ""; // Clear the container
    container.appendChild(table);

    var sellButton = document.createElement("button");
    sellButton.textContent = "Sell";
    // real sell button
    sellButton.addEventListener("click", function() {
      // Handle the sell action here
      var itemsToSell = [];
  
      // Retrieve the updated prices for each item
      var rows = table.getElementsByTagName("tr");
      var ALLpriceAreCorrect=true;
      //check the price is correct
      for (var D = 1; D < rows.length; D++) {
        var row = rows[D];
          var itemData = selected[D- 1].data("goods-info");

        var yourPriceInput = row.querySelector("input[type=number]");
        if(yourPriceInput.value==null || yourPriceInput.value==0){
          alert("the price not defined");
          ALLpriceAreCorrect=false;
          break;
        }
      }
      if(ALLpriceAreCorrect==true){
        
        for (var i = 1; i < rows.length; i++) { // Start from index 1 to skip the header row
          var row = rows[i];
          var itemData = selected[i - 1].data("goods-info");
          
          var yourPriceInput = row.querySelector("input[type=number]");
          var updatedPrice = yourPriceInput.value;
    
          // Create an object with the item's ID and the updated price
          var item = {
            id_good: itemData.id_good,
            id_user: itemData.id_user,
            assetid: itemData.assetid,
            classid: itemData.classid,
            instanceid: itemData.instanceid,
            market_name: itemData.market_name,
            name: itemData.name,
            icon_url: itemData.icon_url,
            icon_url_large: itemData.icon_url_large,
            link: itemData.link,
            id_category: itemData.id_category,
            date_insected: itemData.date_insected,
            updatedPrice: updatedPrice
          };
    
          itemsToSell.push(item);
        }
      }
      
  
      // Perform the sell action with the itemsToSell array
      // You can pass this array to your sell function or make an Ajax request to send it to the server
      
      const json=JSON.stringify(itemsToSell);
      AjaxSell(json);
    });
    // Append the sell button to the container
    container.appendChild(sellButton);

  }


  function AjaxSell(data){
      $.ajax({
    url: 'ajax',
    method: 'POST',
     data: {
    request:'sell',
    data: data
  },
  success: function(response) {
    closeSellPopup();
    alert("items in market now");
    location.reload();
  },
  error: function(error) {
    alert("error");
    console.error(error);
    location.reload();
    
  }
  });
  }

 // login user
  

function VerifyJWT(){
  var jwt = getJWTFromCookie();
// Make an AJAX request with the JWT token in the request header
$.ajax({
  url: 'protect',
  method: 'POST',
  headers: {
    'Authorization': 'Bearer ' + jwt
  },
  success: function(response) {
    if(isJson(response)!=false){
    var parsedData = JSON.parse(response);
    if(parsedData.message=="Access granted"){
      $("#nav-2").empty();
      $("#nav-2").html('<li><button id="inventory">Inventory</button></li> <li><button id="manageSell" ">Sell/Receive</button></li> <div id="avatar-dropdown" class="dropdown">' +
                                                        '<div id="avatar-button"><img src="picture/defaultUserAvatar.png" class="avatar-image"  width="32" height="32">'+parsedData.data.data.username+'</div>' +
                                                        '<ul id="menu" class="dropdown-menu">' +
                                                        '<li id="Setting-button">setting</li>' +
                                                        '<li id="user_credit">Credit</li>' +
                                                        '<li><button id="logout-button">log out</button></li>' +
                                                        '</ul>' +
                                                        '</div>'); 
                                                        document.cookie="userid="+parsedData.data.data.id;
                                                        closePopup();                                                     
      }
      }else{
  openPopup();
  }
   
  },
  error: function(error) {
    openPopup();
    console.error(error);
    
  }
});
}
function isJson(str){
  var jsonMatch = str.match(/\{.*\}/s); // Use regular expression to extract JSON

  if (jsonMatch) {
    var jsonStr = jsonMatch[0]; // Extract the matched JSON string
    try {
      JSON.parse(jsonStr); // Attempt to parse the JSON string
      return true; // Parsing succeeded, JSON is valid
    } catch (e) {
      return false; // Parsing failed, JSON is not valid
    }
  }
}


function getJWTFromCookie() {
  var cookies = document.cookie.split(';');
  for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i].trim();
    if (cookie.startsWith('jwt=')) {
      return cookie.substring(4);
    }
  }
  return null; // JWT token not found in the cookie
}
function getUseridFromCookie() {
  var cookies = document.cookie.split(';');
  for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i].trim();
    if (cookie.startsWith('userid=')) {
      return cookie.substring(7);
    }
  }
  return null; // 'userid' cookie not found
}


function checkCookie(){
  var cookies = document.cookie.split(';');
  if(cookies.length==0)
    return null;
    else 
    return cookies.length; 
  
}
function removeCookie(cookieName) {
  document.cookie = cookieName + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT';
}
//setting part
function checkSteamID($user_id){

}

function associateSteamAccount($steam_ID,$API_Key,$trade_offer_access_url){

}

function UserSetting($email){

}

//credit part
function getCredit($user_id){
  return new Promise(function(resolve, reject) {
    $.ajax({
      url: 'ajax',
      method: 'POST',
      dataType: 'json',
      data: {
        request: 'GetCredit',
        user_id: $user_id
      },
      success: function(response) {
        if (response.length > 0) {
          var credit = response[0].credit;
          resolve(credit); // Resolve the promise with the credit value
        } else {
          reject("Credit not found"); // Reject the promise if credit is not found
        }
      },
      error: function(error) {
        reject("Failed to retrieve credit"); // Reject the promise if there's an error
      }
    });
  });
}

function addCredit($key,$user_id){

  $.ajax({
    url: 'ajax',
    method: 'POST',
    dataType: 'json',
    data: {
      request: 'AddCredit',
      user_id: $user_id,
      creditKey:$key
    },
    success: function(response) {
      return response;
    },
    error: function(error) {
      return null;
    }
  });


}

function MomentCredit($user_id,$id_market){

}

function PassCredit($user_id,$value){

  $.ajax({
    url: 'ajax',
    method: 'POST',
    dataType: 'json',
    data: {
      request: 'UpdateCredit',
      user_id: $user_id,
      credit:$value
    },
    success: function(response) {
      return response;
    },
    error: function(error) {
      return null;
    }
  });

}


// goods page 

//find the specific category on market
function getSellitems($category_id) {
  var headers = ["picture","name", "seller", "price", "actions"];
  var headers2 = ["icon_url","market_name","username", "price","options"];
  $.ajax({
    url: 'ajax',
    dataType: 'json',
    method: 'POST',
    data: {
      request: 'GetItemsMarket',
      category_id: $category_id
    },
    success: function (response) {
      var table = document.createElement("table");
      table.className = "table table-striped";
      
      // Create table header row
      var thead = document.createElement("thead");
      var headerRow = document.createElement("tr");
      
      headers.forEach(function (header) {
        var th = document.createElement("th");
        th.setAttribute("scope", "col");
        th.textContent = header;
        headerRow.appendChild(th);
      });
      
      thead.appendChild(headerRow);
      table.appendChild(thead);
      
      // Create table body
      var tbody = document.createElement("tbody");
      
      response.forEach(function (item) {
        var row = document.createElement("tr");
        
        headers2.forEach(function (header, index) {
          
          var cell = document.createElement(index === 0 ? "th" : "td");

          // add picture 
          if (index === 0)
            {
              cell.setAttribute("scope", "row");
              var img=document.createElement("img");
              img.src="https://community.akamai.steamstatic.com/economy/image/"+item[header];
              img.height=53;
              img.length=53;
              cell.appendChild(img);
            }
            //default options 
            if(index === 1 || index === 2|| index === 3)
              cell.textContent = item[header];
            // options for buy
            if(index===4){
                var button=document.createElement("button");
                button.className="btn btn-primary";
                button.textContent="buy";
                button.setAttribute("data-sellerid",item["id_user"]);
                button.setAttribute("data-price",item["price"]);
                button.setAttribute("onclick", "ShowPayPage('" + item.id_market + "', '" + item["id_user"] + "', '" + item["price"] + "')");
                cell.appendChild(button);
            }

          row.appendChild(cell);
        });
        
        tbody.appendChild(row);
      });
      
      table.appendChild(tbody);
      
      // Append the table to a desired element on your page
      var parentElement = document.getElementById("market-items"); // Replace "table-container" with the actual ID of the parent element
      parentElement.appendChild(table);
    },
    error: function (data) {
      var table = document.createElement("table");
      table.className = "table table-striped";
      
      // Create table header row
      var thead = document.createElement("thead");
      var headerRow = document.createElement("tr");
      
      headers.forEach(function (header) {
        var th = document.createElement("th");
        th.setAttribute("scope", "col");
        th.textContent = header;
        headerRow.appendChild(th);
      });
      
      thead.appendChild(headerRow);
      table.appendChild(thead);
      var parentElement = document.getElementById("market-items"); // Replace "table-container" with the actual ID of the parent element
      parentElement.appendChild(table);
      //window.location.href = "404.php";
    }
  });
}

//find the specific category price on market
function getPrice(categoryId, callback) {
  $.ajax({
    url: 'ajax',
    method: 'POST',
    dataType: 'json',
    data: {
      request: 'Get_last_Price_of_Category',
      category_id: categoryId
    },
    success: function(response) {
      callback(response[0].price);
    },
    error: function(error) {
      console.error("Error fetching price:", error);
      callback("N/A");
    }
  });
}


//buy page 

function ShowPayPage($id_market,$seller_userid,$price){

  //verify user does logged
  VerifyJWT();
  //verify is not owner of skin searching username
 if(getUseridFromCookie()==$seller_userid){
      alert("You cant buy own skin");
      return 0;
    }
  //make sure he is buying this 
  //check credit of user
  openBuyBlockPopup();
  //printe items price
  $("#value_items_buy").text($price);
  $("#buyButton").attr("onclick", "buy('" + $id_market + "', '" + getUseridFromCookie() + "', '" + $seller_userid + "')");
}


function buy($id_market,$id_customer,$seller_userid){
  $.ajax({
    url: 'ajax',
    method: 'POST',
    dataType: 'json',
    data: {
      request: 'CreateOrder',
      id_market: $id_market,
      userid_customer: $id_customer,
      userid_seller:$seller_userid
    },
    success: function(response) {
      if(response=="1")
        {
          alert("you need send a request now");
          
        }
      else
        alert("failed buy");
    },
    error: function(error) {
      console.log(error);
    }
  });

}


function checkCredit() {
  var creditElement = document.getElementById("BuyBlock_showCredit");
  var itemValueElement = document.getElementById("value_items_buy");
  var buyButton = document.getElementById("buyButton");
  var buyMessage = document.getElementById("buyMessage");
  var credit = parseFloat(creditElement.textContent);
  var itemValue = parseFloat(itemValueElement.textContent);
  if (!isNaN(credit) && !isNaN(itemValue)) {
    if (credit >= itemValue) {
      buyButton.disabled = false;
      buyButton.classList.remove("disabled");
      buyMessage.textContent = "";
    } else {
      buyButton.disabled = true;
      buyButton.classList.add("disabled");
      buyMessage.textContent = "You don't have enough money to buy this item.";
    }
  } else {
    buyButton.disabled = true;
    buyButton.classList.add("disabled");
    buyMessage.textContent = "Invalid credit or item value.";
  }
}

// buy windows
function openBuyBlockPopup() {
    var popup = document.getElementById("open_pop_buy_table");
    popup.style.display = "block";
    getCredit(getUseridFromCookie()).then(function(credit) {
    $("#BuyBlock_showCredit").text(credit); 
    checkCredit();
  });

    popup.addEventListener("click", closeBuyBlockPopupOutside);
    document.addEventListener("keydown", closeBuyBlockopupEsc);

  
}

function closeBuyBlockPopupOutside(event) {
  var popup = document.getElementById("open_pop_buy_table");
  if (event.target === popup) {
    closeBuyBlockPopup();
  }
}

function closeBuyBlockopupEsc(event) {
  if (event.key === "Escape") {
    closeSellPopup();
  }
}

function closeBuyBlockPopup() {
  var popup = document.getElementById("open_pop_buy_table");
  popup.style.display = "none";
  popup.removeEventListener("click", closeBuyBlockPopupOutside);
  document.removeEventListener("keydown", closeBuyBlockopupEsc);
}

//selling and receive page
function ShowSell(){
  $user_id=this.getUseridFromCookie();
  $.ajax({
    url: 'ajax',
    dataType: 'json',
    method: 'POST',
    data: {
      request: 'ShowSellingMarket',
      user_id: $user_id
    },
    success: function (response) {
      $('#list_tb').empty();
      buildSellTable(response);
    }
  });

}


function ShowListToSend() {
  var user_id = getUseridFromCookie();
  $.ajax({
    url: 'ajax',
    dataType: 'json',
    method: 'POST',
    data: {
      request: 'GetOrderbyUser',
      user_id: user_id
    },
    success: function (response) {
      $("#list_tb").empty();
      ShowList(response);
      
    }
  });
}

function ShowList(data) {
  var headers = ["Picture", "Market Name", "Price", "Seller ID", "Pay Time", "Action"];
  var arrays = ["icon_url", "market_name", "price", "userid_seller","pay_time",""];
  var table = document.createElement("table");
  table.className = "table table-striped";

  // Create table header row
  var thead = document.createElement("thead");
  var headerRow = document.createElement("tr");

  headers.forEach(function (header) {
    var th = document.createElement("th");
    th.setAttribute("scope", "col");
    th.textContent = header;
    headerRow.appendChild(th);
  });

  thead.appendChild(headerRow);
  table.appendChild(thead);

  // Create table body
  var tbody = document.createElement("tbody");

  data.forEach(function (item) {
    var row = document.createElement("tr");

    arrays.forEach(function (header, index) {
      if(item.order_state=="ini" && getUseridFromCookie()==item.userid_seller){
        var cell = document.createElement(index === 0 ? "th" : "td");
      
      // Add picture
      if (index === 0) {
        cell.setAttribute("scope", "row");
        var img = document.createElement("img");
        img.src = "https://community.akamai.steamstatic.com/economy/image/" + item[header];
        img.height = 53;
        img.length = 53;
        cell.appendChild(img);
      }
      // Default options
      if (index === 1 || index === 2 || index === 3 ||index === 4) {
        cell.textContent = item[header];
        
      }
      // Options for send/receive
      if (index === 5) {
        
        var button = document.createElement("button");
        button.className = "btn btn-primary";
       
          button.textContent = "send";
          button.setAttribute(
          "onclick",
          "send('"+item.OrderID+"')"
        );
        cell.appendChild(button);
      }

      }else if(item.order_state=="sended" &&  getUseridFromCookie()==item.userid_customer){
        var cell = document.createElement(index === 0 ? "th" : "td");
      // Add picture
      if (index === 0) {
        cell.setAttribute("scope", "row");
        var img = document.createElement("img");
        img.src = "https://community.akamai.steamstatic.com/economy/image/" + item[header];
        img.height = 53;
        img.length = 53;
        cell.appendChild(img);
      }
      // Default options
      if (index === 1 || index === 2 || index === 3 ||index === 4) {
        cell.textContent = item[header];
        
      }
      // Options for send/receive
      if (index === 5) {
        var button = document.createElement("button");
        button.className = "btn btn-primary";
          button.textContent = "receive";
          button.setAttribute(
          "onclick",
          "receive('"+item.OrderID+"')"
        );
        cell.appendChild(button);
      }

      }

      

      row.appendChild(cell);
    });

    tbody.appendChild(row);
  });

  table.appendChild(tbody);

  // Append the table to a desired element on your page
  var parentElement = document.getElementById("list_tb");
  parentElement.appendChild(table);
}


function Get_NumberToSend(){
  $user_id=this.getUseridFromCookie();
  $.ajax({
    url: 'ajax',
    dataType: 'json',
    method: 'POST',
    data: {
      request: 'GetCountToSend',
      user_id: $user_id
    },
    success: function (response) {
      $("#current-game-to-deliver").text(response);
    }
  });

}


async function buildSellTable(cards) {
  var ul = $("<ul>");
  for (var i = 0; i < cards.length; i++) {
    var card = cards[i];
    var a = $("<a>").addClass("card-link");
    var li = $("<li>").addClass("card").attr("width", 208).attr("height", 228).attr("data-goods-info", JSON.stringify(card));
    var img = $("<img>").attr("src", "https://community.akamai.steamstatic.com/economy/image/" + card.icon_url).attr("width", 210).attr("height", 138);
    var h6 = $("<h6>").text(truncateText(card.market_name, 20));
    var p = $("<p>");
    a.append(img);
    li.append(a, h6, p);
    ul.append(li);

    li.click(selectItem);

    if ((i + 1) % 4 == 0) {
      ul.append("<br>");
    }

    try {
      await (function() {
        return new Promise((resolve) => {
            p.text(card.price + Coin);
            resolve();
          
        });
      })(card['id_category']);

      (function(categoryId) {
        h6.click(function() {
          window.location.href = "goods?id=" + categoryId;
        });
      })(card['id_category']);

    } catch (error) {
      console.error("Error fetching price:", error);
      p.text("N/A");
    }
  }
  $("#list_tb").append(ul);

}

function send($orderid){
  $.ajax({
    url: 'ajax',
    dataType: 'json',
    method: 'POST',
    data: {
      request: 'UpdateOrder',
      id_order: $orderid,
      state_order:'sended'
    },
    success: function (response) {
      alert("has been sended request,please wait for customer receive");
    }
  });
}

function receive($orderid){
  $.ajax({
    url: 'ajax',
    dataType: 'json',
    method: 'POST',
    data: {
      request: 'UpdateOrder',
      id_order: $orderid,
      state_order:'receive'
    },
    success: function (response) {
      CompleteOrder($orderid);
      alert("you receive the skin");
    }
  });
}

function CompleteOrder($orderid){
  $.ajax({
    url: 'ajax',
    dataType: 'json',
    method: 'POST',
    data: {
      request: 'CompleteOrder',
      id_order: $orderid,

    },
    success: function (response) {
      alert("the order is completed");
    }
  });

}
//MARKET PAGE
function GetRandomItemsByNumber($num) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: 'ajax',
      dataType: 'json',
      method: 'POST',
      data: {
        request: 'RandomItems',
        num_items: $num
      },
      success: function (response) {
        resolve(response);
      },
      error: function (error) {
        reject(new Error('AJAX request error: ' + error));
      }
    });
  });
}
function GetMarketitemsbyName($name){
  return new Promise((resolve, reject) => {
    $.ajax({
      url: 'ajax',
      dataType: 'json',
      method: 'POST',
      data: {
        request: 'GetMarketItemByname',
        name: $name
      },
      success: function (response) {
        resolve(response);
      },
      error: function (error) {
        reject(new Error('AJAX request error: ' + error));
      }
    });
  });

}

function searchInMarket() {
  var searchItem = document.getElementById("search-item").value;
  if (searchItem.trim() !== "") {
    // Call the AJAX function with the search item as a parameter
    GetMarketitemsbyName(searchItem)
      .then(function (cards) {
        $('#list_tb').empty();
        BuildMarketTable(cards);
      })
      .catch(function (error) {
        console.error("Error searching in market:", error);
      });
  }else{
    alert("you cant sent null");
  }
}
// 100 default
async function BuildMarketTable(cards){
  var ul = $("<ul>");
  for (var i = 0; i < cards.length; i++) {
    var card = cards[i];
    var a = $("<a>").addClass("card-link");
    var li = $("<li>").addClass("card").attr("width", 208).attr("height", 228).attr("data-goods-info", JSON.stringify(card));
    var img = $("<img>").attr("src", "https://community.akamai.steamstatic.com/economy/image/" + card.icon_url).attr("width", 210).attr("height", 138);
    var h6 = $("<h6>").text(truncateText(card.market_name, 20));
    var p = $("<p>");
    a.append(img);
    li.append(a, h6, p);
    ul.append(li);

    li.click(selectItem);

    if ((i + 1) % 4 == 0) {
      ul.append("<br>");
    }

    try {
      await (function(categoryId) {
        return new Promise((resolve) => {
          getPrice(categoryId, (price) => {
            p.text(price + Coin);
            resolve();
          });
        });
      })(card['id_category']);

      (function(categoryId) {
        h6.click(function() {
          window.location.href = "goods?id=" + categoryId;
        });
      })(card['id_category']);

    } catch (error) {
      console.error("Error fetching price:", error);
      p.text("N/A");
    }
  }
  $("#list_tb").append(ul);

}

function buildProfilTable(){
  
}



 