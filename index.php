<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/styles.css">  
    </head>
    <body>
        <form form action="./index.php" method="get" >
            <label>Enter a Name Filter</label>
            <input type="text" name="name" placeholder="Name Filter">
            <br>
            <label>Enter a Type Filter</label>
            <input type="text" name="type" placeholder="Type Filter">
            <br>
            <label>Select Availibility Filter</label>
            <select name = "av">
                <option value = "">Avalibility Filter</option>
                <option value = "available" >Available</option>
                <option value = "checkedout">CheckedOut</option>
            </select>
            <br>
            <label>Select Sorting</label>
            <select name = "sort">
                <option value = "deviceName">Select sorting method</option>
                <option value = "deviceName">Sort by Name</option>
                <option value = "price">Sort by Price</option>
            </select>
            <br>
            <input type="submit" value="Submit">
        </form>
        <form form action="./index.php" method="get" >
            <input type="submit" value="Press For Fresh Data">
        </form>
    </body>
    <?php
        $servername = "us-cdbr-iron-east-05.cleardb.net";
        $username = "b5fd7e721a6e84";
        $password = "4acba240";
        $dbname = "heroku_3a83060270e607d"; 
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
         
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT * FROM device WHERE 1";
        if(!empty($_GET['name'])){
            $name = $_GET['name'];
            $sql .= " AND deviceName = '{$name}' ";
        }
        if(!empty($_GET['type'])){
            $type = $_GET['type'];
            $sql .= " AND deviceType = '{$type}' ";
        }
        if(!empty($_GET['av'])){
            $av = $_GET['av'];
            $sql .= " AND status = '{$av}' ";
        }
        if($_GET['sort'] == "price"){
            $sort = "price";
        }else{
            $sort = "deviceName";
        }
        $sql .= " ORDER BY {$sort} ASC";

        
        echo $sql;
        $result = $conn->query($sql);
    ?>
    <table>
        <tr>
            <th>Device ID</th>
            <th>Device Name</th>
            <th>Device Type</th>
            <th>Price</th>
            <th>Status</th>
        </tr>
    <?php
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>";echo $row["deviceId"];echo "</td>";
                echo "<td>";echo $row["deviceName"];echo "</td>";
                echo "<td>";echo $row["deviceType"];echo "</td>";
                echo "<td>";echo $row["price"];echo "</td>";
                echo "<td>";echo $row["status"];echo "</td>";
                echo "</tr>";
            }
        } else {
            echo '<br>';
            echo "0 results";
        }
        $conn -> close();
    ?>
    </table>
</html>