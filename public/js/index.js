//Is a Simple Version for get the data of Csgo Item 
//the complete version should use the project of VDF to manage the csgo items data and convert to a Object but i didnt find a way to get every picture of items  
//I have downloaded all data of Csgo Items from a API (thks Csgo-API) and add it on Database
let baseurl = window.location.origin + '/Hmarket';
let url = baseurl + '/app/Controller/Viewitems.php';
let urlObj = new URL(url);
let inputParams = new URLSearchParams(urlObj.search);

$(document).ready(function(){
    $.ajax({url: RandomItems(), success: function(result){
            var cards=[];
            var parsedData = JSON.parse(result);
            parsedData.forEach(element => {
                cards.push(element);
            });
            buildItem(cards);
      }});  
     
});

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
  
  function redirect_inventory(){
    window.location="./Inventory.php";
  }
   
 