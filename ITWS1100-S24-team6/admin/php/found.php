<?php
    // Include the file that connects to the database
    require "../../connect.php";

    // Convert the 'q' parameter from the GET request to an integer
    $id = intval(trim($_GET['q'], "\""));

    // Prepare an SQL statement to update 'lost_items' table when an item is found
    $found = $db->prepare("UPDATE lost_items SET isFound = 1, foundTime = now() WHERE lost_items.id = ?");

    // Bind the item's ID as a parameter to the prepared statement
    $found->bind_param("s", $id);

    // Execute the prepared statement to mark the item as found and set the found time to the current time
    $found->execute();
?>
