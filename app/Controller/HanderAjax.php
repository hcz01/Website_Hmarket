<?php
namespace app\Controller;
use app\Controller\HanderUser;
include "Inventory.php";
include "HanderItems.php";
include "HandlerCreditTable.php";
include "HandlerOrder.php";
require_once(__DIR__ . "../../../vendor/autoload.php");

class HanderAjax {
   public function HanderRequest(){
    $request = $_POST['request'];
    switch ($request) {
        case 'user':
    $HanderUser=new HanderUser();
    $username=$_POST['username'];
    $password=$_POST['password'];
    $result=$HanderUser->VerifyUser($username,$password);
    echo $result;
            break;
        case 'refersh':
            if(isset($_POST['userid']))
            {
                $userid=$_POST['userid'];
                //user object
                $Data = new HanderUser();
                //item object
                $Handleritem=new Handleritem();
                
                $steamid=$Data->getSTEAMID($userid);
                $inventoryUrl = "https://steamcommunity.com/inventory/" . $steamid . "/730/2?l=en&count=1000";
                $inventory = new CSGOInventory($inventoryUrl);
                $json=$inventory->getInventory();
               
                $results=null;
                if($json!=null){
                    $results = $inventory->getAllItems($json);
                }
                //verify the items hasva data in database ,if not exist check inventory then add all items in database and end pass json
                if ($results != null) {

                    $results = json_decode($results, true);
                    $insertSql = "INSERT INTO goods (id_user,assetid,classid, instanceid, market_name, name, icon_url, icon_url_large,id_category, link) ";
                    $insertValues = ""; 

                    
                    foreach ($results as $item) {
                        //verify does exist this item in db ,if not add it
                        $sql = "SELECT assetid FROM goods WHERE assetid = '$item[asset]'";
                        $result = $Handleritem->SelectQuery($sql);
                        //find category id 

                        $category=$Handleritem->searchForid_category($item['name']);
                        if($category===null)
                                $category=0;

                        if ($result === false) {
                            // The item does not exist, add its value to the INSERT query
                            $values = "('$userid', '$item[asset]',
                            '$item[classid]',
                             '$item[instanceid]',
                            '$item[market_name]', 
                            '$item[name]', 
                            '$item[icon_url]', 
                            '$item[icon_url_large]',
                            '$category[id]',
                            '$item[link]')";
                            if (!empty($insertValues)) {
                                $insertValues .= ", "; // Add comma if there are already values
                            }

                            $insertValues .= $values;
                        }
                    }


                    $insertSql .= "VALUES " . $insertValues;
                    if (!empty($insertValues)) {
                        // At least one item needs to be inserted, execute the INSERT query
                        $result=$Handleritem->Insertquery($insertSql);
                        if ($result!==null) {
                            echo $Handleritem->getItemsById_user($userid);
                        } else {
                            //failed adding data
                            echo $Handleritem->getItemsById_user($userid);
                        }
                    } else {
                        //all items already exist
                        echo $Handleritem->getItemsById_user($userid);
                       
                    }
                }else{
                    
                    //inventory failed load
                    echo $Handleritem->getItemsById_user($userid);
                }
           
            }else{
                echo "failed by lost request";
            }
           
            break;


        case 'sell':
           
            $Handleritem = new Handleritem();

            $data = $_POST['data'];
            $i=0;
            // Decode the JSON data
            $data = json_decode($data, true);
            
            // Verify if the data is not null
            if ($data !== null) {
                // Prepare the SQL statement
                $insertSql = "INSERT INTO market (id_good, price) VALUES ";
                $updateSql = "UPDATE market SET price = CASE id_good ";
                $values = array();
            
                // Loop through the data
                foreach ($data as $item) {
                    $idGood = $item['id_good'];
                    $updatePrice = $item['updatedPrice'];
                    
                    // Check if the id_good already exists in the database
                    $sql = "SELECT id_good FROM market WHERE id_good = '$idGood'";
                    $result = $Handleritem->SelectQuery($sql);
            
                    if ($result === false || $result === null) {
                        // Insert a new record
                        $values[] = "('$idGood', '$updatePrice')";
                    } else {
                        $i++;
                        // Update the price for existing record
                        $updateSql .= "WHEN '$idGood' THEN '$updatePrice' ";
                    }
                }
                if(count(($values))!=0){
                    $insertValues = implode(', ', $values);
                    $insertSql .= $insertValues;
                    $Handleritem->Insertquery($insertSql);
                }
                
                
                if($i>0){
                    $updateSql .= "END WHERE id_good IN (" . implode(', ', array_column($data, 'id_good')) . ")";
                    $Handleritem->Insertquery($updateSql);
                }
                http_response_code(200);
                echo "success";

            } else {
                http_response_code(400);
                // Handle the case when data is null
                echo "Error: Invalid data.";
            }
              
            break;
            //use for get all items on market
        case 'GetItemsMarket':
                if(isset($_POST['category_id']))
                {
                $Handleritem=new Handleritem();
                $result=$Handleritem->Get_price_Of_category($_POST['category_id']);

                if (!empty($result)) {
                    http_response_code(200);
                    echo $result;
                } else {
                    http_response_code(400);
                    echo "No results found.";
                }                
                }

                break;
            //use for get details for a item
        case 'Get_Detagli_OF_Category':
                    if(isset($_POST['category_id']))
                    {
                    $Handleritem=new Handleritem();
                    $result=$Handleritem->Get_details_category($_POST['category_id']);
                    if (!empty($result)) {
                        http_response_code(200);
                        echo $result;
                    } else {
                        http_response_code(400);
                        echo "No results found.";
                    }                
                    }
    
                    break;
        case 'Get_last_Price_of_Category':
            if(isset($_POST['category_id']))
                    {
                        $Handleritem=new Handleritem();
                        $result=$Handleritem->Get_Last_price_Of_category($_POST['category_id']);
                        if (!empty($result)) {
                            http_response_code(200);
                            echo $result;
                        } else {
                            http_response_code(400);
                            echo "No results found.";
                        }        

                    }
            break;


        //return true/false
        case 'CreateCreditKey':
                if(isset($_POST['user_id'])){
                    if($_POST['user_id']=='admin'){
                        $HanderUser=new HanderUser();
                        $HandlerCredit=new HandlerCredit();
                        $result=$HandlerCredit->CreateKey('abc','50');
                        if(isset($result['row_id']) && $result['row_id'] !== false){
                            $arr = array( 'row_id' => $result['row_id'] );
                            http_response_code(200);
                            echo json_encode( $arr, JSON_NUMERIC_CHECK );
                        } else {
                            $arr = array( 'row_id' => $result['row_id'] );
                            http_response_code(400);
                            echo json_encode( $arr, JSON_NUMERIC_CHECK );
                        }
                    }
                }  
                break;

        //return [{"credit":"0"}]   
        case 'GetCredit':
            if(isset($_POST['user_id'])){
            $HanderUser=new HanderUser();
            $result=$HanderUser->GetCredit($_POST['user_id']);
            if(!empty($result)){
                http_response_code(200);
                echo $result;
            }else{
                http_response_code(400);
                echo "Get Credit failed";
            }
        }  
            break;
        //use only for validate key
        case 'AddCredit':
            if(isset($_POST['user_id']) && isset($_POST['creditKey'])){
                $HanderUser=new HanderUser();
                $HandlerCredit=new HandlerCredit();
                $creditKey=$_POST['creditKey'];
                $response=$HandlerCredit->ValidateKey($creditKey);//back credit of key
                $response=json_decode($response,true);
                $Credit = isset($response['credit']) ? $response['credit'] : 0;
                $result=$HanderUser->UpdateCredit($Credit,$_POST['user_id']); //add credit

                if(!empty($result)){
                    http_response_code(200);
                    echo $result;//truer or false
                }else{
                    http_response_code(400);
                    echo "Get Credit failed";
                }
            }  
            break;
            
        //use for switch credit between users
        case 'UpdateCredit':
            if(isset($_POST['user_id']) && isset($_POST['credit'])){
                $HanderUser=new HanderUser();
                $result=$HanderUser->UpdateCredit($_POST['credit'],$_POST['user_id']); //add credit

                if(!empty($result)){
                    http_response_code(200);
                    echo $result;
                }else{
                    http_response_code(400);
                    echo "Get Credit failed";
                }
            } 
                break;          
                    
            //Create a order
        case 'CreateOrder':
            
            if(isset($_POST['id_market']) && isset($_POST['userid_customer']) && isset($_POST['userid_seller'])){
                $Handlerorder=new Handlerorder();
                $Handleritem=new Handleritem();
                $result=$Handlerorder->Create($_POST['id_market'],$_POST['userid_customer'],$_POST['userid_seller']); 
                
                if(!empty($result)){
                    $Handleritem->UpdateState($_POST['id_market'],"false");//change status of market make others cant see it
                    http_response_code(200);
                    echo $result;
                }else{
                    http_response_code(400);
                    echo "Action failed";
                }
            } 
                break; 
            //get a order by id order
        case 'GetOrder':
                    if(isset($_POST['id_order'])){
                        $Handlerorder=new Handlerorder();
                        $result=$Handlerorder->Get($_POST['id_order']);
                        if(!empty($result)){
                            http_response_code(200);
                            echo json_encode($result);
                        }else{
                            http_response_code(400);
                            echo "Action failed";
                        }
                    } 
                        break; 
            //Update state of a order working
        case 'UpdateOrder':
        
           if(isset($_POST['id_order']) && isset($_POST['state_order'])){
                               
                                $Handlerorder=new Handlerorder();
                                $result=$Handlerorder->Update($_POST['id_order'], $_POST['state_order']);
                                if(!empty($result)){
                                    http_response_code(200);
                                    echo $result;
                                }else{
                                    http_response_code(400);
                                    echo "Action failed";
                                }
                            } 
            break; 
        
        case 'CompleteOrder':
            if(isset($_POST['id_order'])){
                //before need check all condition of order to start Complete order 
                $Handlerorder=new Handlerorder();
                $HandlerUser = new HanderUser();
                //Manage Credit customer and seller
                $result=$Handlerorder->Get($_POST['id_order']);
                if(!empty($result)){
                    $userid_customer = $result['userid_customer'];
                    $userid_seller = $result['userid_seller'];
                    $price = $result['price'];
                    // version with transaction thks tips from my Grand Friend Oscar
                    $result=$Handlerorder->CompleteOrder($_POST['id_order'],"completed",$userid_customer,$userid_seller,$price);
                    // without transaction version 
                    /*
                    $HandlerUser->UpdateCredit("-".$price,$userid_customer);
                    $HandlerUser->UpdateCredit("+".$price,$userid_seller);
                    $result=$Handlerorder->Update($_POST['id_order'],"completed");
                    */
                    http_response_code(200);
                    echo $result;
                }else{
                    http_response_code(400);
                    echo "Action failed";
                }
                
            }
            break;
        

        case 'ShowSellingMarket':
            if(isset($_POST['user_id'])){
                $Handleritem=new Handleritem();
                $result=$Handleritem->getMarketItemsById_user($_POST['user_id']);       
                if(!empty($result)){
                http_response_code(200);
                echo $result;
                }else{
                http_response_code(400);
                echo "Get Credit failed";
                }
            } 
            break;  
        
        case 'GetCountToSend':
            if(isset($_POST['user_id'])) {
                $Handleritem=new Handleritem();
                $result=$Handleritem->GetCountToSend($_POST['user_id']);
                if(!empty($result)){
                    http_response_code(200);
                    echo $result;
                }else{
                    http_response_code(400);
                    echo "Action failed";
                }
            }

            break;

        case 'GetOrderbyUser':
                if(isset($_POST['user_id'])){
                    $Handlerorder=new Handlerorder();
                    $result=$Handlerorder->GetOrderByUser($_POST['user_id']);
                    if(!empty($result)){
                        http_response_code(200);
                        echo json_encode($result);
                    }else{
                        http_response_code(400);
                        echo "Action failed";
                    }
                }
                break;
        case 'RandomItems' :
            if(isset($_POST['num_items'])){

                $num=intval($_POST['num_items']);
                $Handleritem=new Handleritem();
                $result=$Handleritem->GetMarketWithStatus1($num);
                if(!empty($result)){
                    http_response_code(200);
                    echo $result;
                }else{
                    http_response_code(400);
                    echo "Action failed";
                }
            }
               
                    break;
                
        case 'GetMarketItemByname' :
            if(isset($_POST['name'])){


                $Handleritem=new Handleritem();
                $result=$Handleritem->GetMarketByNameWithStatus1($_POST['name']);
                if(!empty($result)){
                    http_response_code(200);
                    echo $result;
                }else{
                    http_response_code(400);
                    echo "Action failed";
                }
            }
            break;
        case 'UpdateUserInfo':
           if(isset($_POST['user_id'])&& isset($_POST['data'])){
                    $HanderUser=new HanderUser();
                    $data=$_POST['data'];
                   $result= $HanderUser->UpdateUserInfo($data,$_POST['user_id']);
                    if(!empty($result)){
                        http_response_code(200);
                        echo json_encode($result);
                    }else{
                        http_response_code(400);
                        echo "Action failed";
                    } 
           }
                break;
        case 'GetUserInfo':
                if(isset($_POST['user_id'])) {
                    $HanderUser=new HanderUser();
                    $result=$HanderUser->getUserInfo($_POST['user_id']);
                    if(!empty($result)){
                        http_response_code(200);
                        echo json_encode($result);
                    }else{
                        http_response_code(400);
                        echo "Action failed";
                    } 
                }
                break;
        
    }

        
        
        
       

    
   
   
   
}




}
?>