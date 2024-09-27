<?php
    // Include the file that connects to the database
    require "../../connect.php";

    // Convert the 'q' parameter from the GET request to an integer
    $id = intval(trim($_GET['q'], "\""));

    // Display a "Yes" button that calls a JavaScript function to delete the item with the given ID
    echo "<button type='button' id='deleteYes' onclick='deleteItem(".$id.")'>Yes</button>";

    // Display a "No" button that closes the delete confirmation dialog
    echo "<button type='button' value='Cancel' id='deleteNo' onclick='deleteDialog.close()'>No</button>";
?>
