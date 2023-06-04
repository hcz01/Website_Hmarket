<?php
namespace app\Controller;

use mysqli;

class Handleritem
{
   
    public function getItemsById_user($id_user)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "hmarket";
        $connection = new mysqli($servername, $username, $password, $db);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $sql = "SELECT * FROM `goods` WHERE `id_user` = $id_user LIMIT 0,32";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            $items = [];
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
            $connection->close();
            return json_encode($items);
        } else {
            $connection->close();
            return null;
        }
    }
    public function getMarketItemsById_user($id_user){
      $servername = "localhost";
      $username = "root";
      $password = "";
      $db = "hmarket";
      $connection = new mysqli($servername, $username, $password, $db);
      if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
      }
      $sql = "SELECT *
      FROM market m
      JOIN goods g ON m.id_good = g.id_good
      JOIN `user-viewer` s ON s.id_user = g.id_user
      WHERE g.id_user = $id_user AND m.status = 1 AND m.price!=0
      LIMIT 0, 20;";
      $result = $connection->query($sql);
      if ($result->num_rows > 0) {
          $items = [];
          while ($row = $result->fetch_assoc()) {
              $items[] = $row;
          }
          $connection->close();
          return json_encode($items);
      } else {
          $connection->close();
          return null;
      }
    }

    public function searchForid_category($name){
      $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "hmarket";
        $connection = new mysqli($servername, $username, $password, $db);
        if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
      }
      if (strpos($name, "★") === 0) {
        $name = str_replace("★ ", "", $name);
    }
      //if table can be split by , make 3 different query for riduce time
      $sql = "SELECT * FROM (
        SELECT id, name, image FROM agents
        UNION ALL
        SELECT id, name, image FROM collectibles
        UNION ALL
        SELECT id, name, image FROM collections
        UNION ALL
        SELECT id, name, image FROM crates
        UNION ALL
        SELECT id, name, image FROM graffiti
        UNION ALL
        SELECT id, name, image FROM `keys`
        UNION ALL
        SELECT id, name, image FROM `music-kits`
        UNION ALL
        SELECT id, name, image FROM patches
        UNION ALL
        SELECT id, name, image FROM skins
        UNION ALL
        SELECT id, name, image FROM stickers
    ) AS combined_tables
    WHERE `name` LIKE '%$name%' LIMIT 1";


        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            $connection->close();
            return null;
        }
      
    }

    public function Get_details_category($id_category){
        $servername = "localhost";
          $username = "root";   
          $password = "";
          $db = "hmarket";
          $connection = new mysqli($servername, $username, $password, $db);
          if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $sql = "SELECT * FROM (
            SELECT id, name, image FROM agents
            UNION ALL
            SELECT id, name, image FROM collectibles
            UNION ALL
            SELECT id, name, image FROM collections
            UNION ALL
            SELECT id, name, image FROM crates
            UNION ALL
            SELECT id, name, image FROM graffiti
            UNION ALL
            SELECT id, name, image FROM `keys`
            UNION ALL
            SELECT id, name, image FROM `music-kits`
            UNION ALL
            SELECT id, name, image FROM patches
            UNION ALL
            SELECT id, name, image FROM skins
            UNION ALL
            SELECT id, name, image FROM stickers
        ) AS combined_tables
        WHERE `id` = '$id_category' LIMIT 1";
  
          $result = $connection->query($sql);
          if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            $connection->close();
            return json_encode($rows);
          } else {
              $connection->close();
              return null;
          }
      }

    public function GetCategory_in_Market($id_category){
        $servername = "localhost";
          $username = "root";   
          $password = "";
          $db = "hmarket";
          $connection = new mysqli($servername, $username, $password, $db);
          if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $sql = "SELECT * FROM market m join goods g on m.id_good=g.id_good
            WHERE `id_category` = $id_category LIMIT 1";
  
          $result = $connection->query($sql);
          if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            $connection->close();
            return json_encode($rows);
          } else {
              $connection->close();
              return null;
          }
        
      }



      public function Get_Last_price_Of_category($id_category){
        $servername = "localhost";
          $username = "root";   
          $password = "";
          $db = "hmarket";
          $connection = new mysqli($servername, $username, $password, $db);
          if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $sql = "SELECT *
        FROM market m
        JOIN goods g ON m.id_good = g.id_good
        WHERE id_category = '$id_category'
        GROUP BY m.price
        ORDER BY m.price ASC
        LIMIT 0,1";
  
          $result = $connection->query($sql);
          if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;
            }
            $connection->close();
            return json_encode($rows);
          } else {
              $connection->close();
              return null;
          }
        
      }


      public function Get_price_Of_category($id_category){
        $servername = "localhost";
          $username = "root";   
          $password = "";
          $db = "hmarket";
          $connection = new mysqli($servername, $username, $password, $db);
          if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $sql = "SELECT *
        FROM market m
        JOIN goods g ON m.id_good = g.id_good
        JOIN `user-viewer` s ON s.id_user=g.id_user
        WHERE id_category = '$id_category' and m.status=1
        GROUP BY m.price
        ORDER BY m.price ASC
        LIMIT 0,10";
    
          $result = $connection->query($sql);
          if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            $connection->close();
            return json_encode($rows);
          } else {
              $connection->close();
              return null;
          }
        
      }

      public function UpdateState($id_marekt,$status){
          $servername = "localhost";
          $username = "root";   
          $password = "";
          $db = "hmarket";
          $connection = new mysqli($servername, $username, $password, $db);
          if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        
        $sql = "UPDATE market
        SET status = $status
        WHERE id_market = $id_marekt";

        $result="false";
          try{
            $result = $connection->query($sql); 
          }catch(\mysqli_sql_exception $e){
            $connection->close();
          }finally{
            return $result;
          }
      }
    
      public function GetCountToSend($id_user){
        $servername = "localhost";
        $username = "root";   
        $password = "";
        $db = "hmarket";
        $connection = new mysqli($servername, $username, $password, $db);
        if ($connection->connect_error) 
          die("Connection failed: " . $connection->connect_error);
          
      
        $sql = "SELECT COUNT(*) AS countOfEvent
              FROM `market` m 
              JOIN `goods` g ON m.id_good = g.id_good 
              JOIN `user-viewer` s ON s.id_user = g.id_user 
              WHERE `status`=0 and g.id_user = $id_user";
     
            $result="false";
            try {
              $queryResult = $connection->query($sql);
              $row = $queryResult->fetch_assoc();
              $result = $row['countToSend'];
          } catch (\mysqli_sql_exception $e) {
              // Handle the exception if needed
          } finally {
              $connection->close();
              return json_encode($result);
          }
      }
      public function GetMarketWithStatus1($num){
        $servername = "localhost";
          $username = "root";   
          $password = "";
          $db = "hmarket";
          $connection = new mysqli($servername, $username, $password, $db);
          if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $sql = "SELECT *
        FROM market m
        JOIN goods g ON m.id_good = g.id_good
        WHERE m.status = 1 AND g.id_category IS NOT NULL
        LIMIT 0, $num";

          $result = $connection->query($sql);
          if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            $connection->close();
            return json_encode($rows);
          } else {
              $connection->close();
              return null;
          }
        
      }
      public function GetMarketByNameWithStatus1($name){
        $servername = "localhost";
          $username = "root";   
          $password = "";
          $db = "hmarket";
          $connection = new mysqli($servername, $username, $password, $db);
          if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $sql = "SELECT *
        FROM market m
        JOIN goods g ON m.id_good = g.id_good
        WHERE m.status = 1 AND g.id_category IS NOT NULL AND g.market_name LIKE '%$name%'
        LIMIT 0, 100";
        
          $result = $connection->query($sql);
          if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            $connection->close();
            return json_encode($rows);
          } else {
              $connection->close();
              return null;
          }
        
      }
      

      public function Insertquery($query)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "hmarket";
        $connection = new mysqli($servername, $username, $password, $db);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        if ($connection->query($query) === true) {
            $connection->close();
            return  "New record created successfully";
        } else {
            $connection->close();
            return "Error";
        }
    }
    public function SelectQuery($query)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "hmarket";
        $connection = new mysqli($servername, $username, $password, $db);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return  false;
        }

    }


    

}




?>





