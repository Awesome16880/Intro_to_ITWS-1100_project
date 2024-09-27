<?php
    // Include the file that connects to the database
    require "../../connect.php";

    // Prepare and execute query to retrieve found items with their details
    $foundQuery = $db->prepare("SELECT lost_items.id, lost_items.name, lost_items.foundTime, location_items.location_name
                                FROM lost_items
                                JOIN location_items ON lost_items.id = location_items.item_id
                                WHERE lost_items.isFound = 1");
    $foundQuery->execute();

    // Get the result of the query
    $result = $foundQuery->get_result();

    // Display the table header
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Location</th><th>Date Returned</th></tr>";

    // Check if there are any found items
    if ($result->num_rows === 0) {
        echo "<tr><td colspan='4'>No found items</td></tr>";
    } else {
        // Loop through each found item and display its details
        while ($foundRow = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $foundRow['id'] . '</td>';
            echo '<td>' . $foundRow['name'] . '</td>';
            echo '<td>' . $foundRow['location_name'] . '</td>';
            
            // Format the foundTime to a readable date format
            $formattedTime = date('m/d/y g:i A', strtotime($foundRow['foundTime']));
            echo '<td>' . $formattedTime . '</td>';
            echo '</tr>';
        }
    }

    echo "</table>";
?>
