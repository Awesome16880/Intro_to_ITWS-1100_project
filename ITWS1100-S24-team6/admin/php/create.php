<?php
    // Include the file that connects to the database
    require "../../connect.php";

    // Check if the 'name' field is set in the POST data
    if (isset($_POST['name'])) {
        // Trim and convert the 'priority' field to an integer
        $priority = intval(trim($_POST['priority'], "\""));

        // Prepare an SQL statement to insert a new item into the 'lost_items' table
        $newItem = $db->prepare("INSERT INTO lost_items (name, imageLink, priority) VALUES (?, ?, ?)");

        // Bind parameters to the prepared statement ('sss' indicates three string parameters)
        $newItem->bind_param("sss", $_POST['name'], $_POST['imageLink'], $priority);

        // Execute the prepared statement to insert the new item
        $newItem->execute();

        // Get the auto-generated ID (primary key) of the newly inserted item
        $newId = mysqli_insert_id($db);

        // Prepare an SQL statement to insert the item's location into the 'location_items' table
        $newLocation = $db->prepare("INSERT INTO location_items (location_name, item_id) VALUES (?, ?)");

        // Bind parameters to the prepared statement ('ss' indicates two string parameters)
        $newLocation->bind_param("ss", $_POST['currentLocation'], $newId);

        // Execute the prepared statement to insert the location of the new item
        $newLocation->execute();
    }
?>
