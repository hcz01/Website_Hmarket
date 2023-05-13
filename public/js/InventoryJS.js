var jsonData;
$(document).ready(function(){
   
     
});

function refresh(){
    // go to database get the real url profil with session or coockie 
    $.ajax({
        url: './Database/HanderDatabase.php',
        type: "POST",
        success: function (data) {
            jsonData=data;
        }
    });
    // will back a json file from database 
    jsonData.each(function(){
        
    });
    // go into json inventory url and extract the data 
  
    //put all data into database goods 
}

function extract(urlInventoryJson){
    fetch('urlInventoryJson')
    .then((response)> response.json())
    .then((json) => console.log(json));
    }