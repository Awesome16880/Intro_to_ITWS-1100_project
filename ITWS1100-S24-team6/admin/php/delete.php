<?php
    // Include the file that connects to the database
    require "../../connect.php";

    // Convert the 'q' parameter from the GET request to an integer
    $id = intval(trim($_GET['q'], "\""));

    // Prepare an SQL statement to delete the item's location from the 'location_items' table
    $deleteItemLoc = $db->prepare("DELETE FROM location_items WHERE location_items.item_id = ?");

    // Bind the item's ID as a parameter to the prepared statement
    $deleteItemLoc->bind_param("s", $id);

    // Execute the prepared statement to delete the item's location
    $deleteItemLoc->execute();

    // Prepare an SQL statement to delete the item from the 'lost_items' table
    $deleteItem = $db->prepare("DELETE FROM lost_items WHERE lost_items.id = ?");

    // Bind the item's ID as a parameter to the prepared statement
    $deleteItem->bind_param("s", $id);

    // Execute the prepared statement to delete the item
    $deleteItem->execute();
?>
