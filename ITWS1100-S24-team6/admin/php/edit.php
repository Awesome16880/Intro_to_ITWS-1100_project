<?php
    // Include the file that connects to the database
    require "../../connect.php";

    // Check if the 'itemId' is set in the POST data
    if (isset($_POST['itemId'])) {
        // Prepare an SQL statement to update data in the 'lost_items' table
        $newData = $db->prepare("UPDATE lost_items SET name = ?, imageLink = ?, priority = ? WHERE lost_items.id = ?");
        
        // Bind parameters to the prepared statement ('ssss' indicates four string parameters)
        $newData->bind_param("ssss", $_POST['itemName'], $_POST['itemImage'], $_POST['itemPriority'], $_POST['itemId']);
        
        // Execute the prepared statement to update the item data in 'lost_items'
        $newData->execute();

        // Prepare an SQL statement to update location data in the 'location_items' table
        $newLocation = $db->prepare("UPDATE location_items SET location_name = ? WHERE location_items.item_id = ?");
        
        // Bind parameters to the prepared statement ('ss' indicates two string parameters)
        $newLocation->bind_param("ss", $_POST['itemLocation'], $_POST['itemId']);
        
        // Execute the prepared statement to update the item's location in 'location_items'
        $newLocation->execute();
        
        // Output the updated item's ID
        echo $_POST['itemId'];
    }
?>
