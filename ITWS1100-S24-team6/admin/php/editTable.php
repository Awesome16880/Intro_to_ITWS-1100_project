<?php
    // Include the file that connects to the database
    require "../../connect.php";

    // Convert the 'q' parameter from the GET request to an integer
    $id = intval(trim($_GET['q'], "\""));

    // Query the database to get the item with the given ID from 'lost_items' table
    $item = $db->query("SELECT * FROM lost_items WHERE lost_items.id = $id")->fetch_assoc();

    // Query the database to get the item's location from 'location_items' and 'locations' tables
    $itemLocation = $db->query("SELECT * FROM location_items, locations
        WHERE location_items.item_id = ".$id." AND location_items.location_name = locations.name;")->fetch_assoc();

    // Query the database to get all locations from 'locations' table
    $locations = $db->query("SELECT * FROM locations");

    // Display an HTML table for editing the item
    echo "<table id='editTable'>";
    echo "<tr><th>ID</th><th><input name='itemId' value='".$item['id']."' type='number' disabled></th></tr>";
    echo "<tr><th>Name</th><th><input name='itemName' value='".$item['name']."' type='text'></th></tr>";
    echo "<tr><th>Image Link</th><th><input name='itemImage' value='".$item['imageLink']."' type='text'></th></tr>";
    echo "<tr><th>Priority</th><th><select name='itemPriority'>";

    // Check item's priority to select the appropriate option in the dropdown
    if ($item['priority'] == 1) {
        echo "<option selected='selected' value='1'>High</option>";
        echo "<option value='0'>Low</option>";
    } else {
        echo "<option value='1'>High</option>";
        echo "<option selected='selected' value='0'>Low</option>";
    }

    echo "</select></tr>";
    echo "<tr><th>Location</th><th><select name='itemLocation'>";

    // Loop through all locations to populate the location dropdown
    while ($location = $locations->fetch_assoc()) {
        // Check if the location matches the item's current location
        if ($location['name'] == $itemLocation['name'])
            echo "<option selected='selected' value='".$location['name']."'>".$location['name']."</option>";
        else
            echo "<option value='".$location['name']."'>".$location['name']."</option>";
    }

    echo "</select></th></tr></table>";

    // Display a submit button for editing
    echo "<input class='editSubmitBtn' type='submit' value='Edit'></input>";
?>
