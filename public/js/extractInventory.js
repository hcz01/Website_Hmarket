
//https://steamcommunity.com/inventory/76561199125042505/730/2?l=english&count=1000

function extract(urlInventoryJson){
fetch('urlInventoryJson')
.then((response)> response.json())
.then((json) => console.log(json));
}