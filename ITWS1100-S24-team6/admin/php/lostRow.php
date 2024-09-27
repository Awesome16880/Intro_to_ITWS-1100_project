<?php
    // Include the file that connects to the database
    require '../../connect.php';

    // Query to get 20 most recent lost items that are not found, ordered by time reported
    $lost = $db->query("SELECT * FROM lost_items WHERE lost_items.isFound = 0 ORDER BY lost_items.timeReported DESC LIMIT 20");

    // Query to get 20 most recent found items, ordered by time reported
    $found = $db->query("SELECT * FROM lost_items WHERE lost_items.isFound = 1 ORDER BY lost_items.timeReported DESC LIMIT 20");

    // Prepare a query to retrieve the name and room of a lost item's location
    $lostQuery = $db->prepare("SELECT name, room FROM location_items, locations WHERE location_items.item_id = ? AND location_items.location_name = locations.name;");

    // Fetch the first row from the 'lost' result
    $lostRow = $lost->fetch_assoc();

    // Display table header
    echo "<tr><th>ID</th><th>Name</th><th>Location</th><th>Time Reported</th><th>Actions</th></tr>";

    // Loop through each row of the 'lost' result
    do {
        // Bind the item's ID as a parameter to the prepared statement
        $lostQuery->bind_param("s", $lostRow["id"]);
        // Execute the prepared statement
        $lostQuery->execute();
        // Get the result of the executed query
        $lostResult = $lostQuery->get_result()->fetch_assoc();

        // Display table row for the current lost item
        echo "<tr><td>".$lostRow['id']."</td>";
        echo "<td>".$lostRow['name']."</td>";
        // Display the location if it exists, otherwise show "No Location"
        echo "<td>".($lostResult != NULL ? $lostResult["name"] : 'No Location')."</td>";
        // Format and display the time reported
        echo "<td>".date( 'm/d/y g:i A', strtotime($lostRow['timeReported']))."</td>";
        // Display action buttons for the item (Mark as Found, Edit, Delete)
        echo "<td>
                <button class='found' onclick='foundItem(".$lostRow['id'].")'>Mark as Found</button>
                <button class='editBtn' type='button' onclick='openEdit(".$lostRow['id'].")'>Edit</button>
                <button class='deleteBtn' type='button' onclick='openDelete(".$lostRow['id'].")' id='deleteButton'>Delete</button>
              </td>
              </tr>";
    } while ($lostRow = $lost->fetch_assoc()); // Move to the next row in the 'lost' result

?>
