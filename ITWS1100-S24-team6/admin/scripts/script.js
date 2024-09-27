// Declare global variables for dialog elements
let createDialog, editDialog, deleteDialog;

// Document ready function
$(document).ready(function () {
    // Get references to dialog elements
    createDialog = document.getElementById("addObject");
    editDialog = document.getElementById("editObject");
    deleteDialog = document.getElementById("deleteObject");

    // Event handlers
    // Show the add object modal when the plus button is clicked
    $('#plusButton').on("click", function() {
        createDialog.showModal();
    });

    // Show the archive table and hide the current table
    $('#archiveTableButton').on("click", function() {
        $('#archiveTable').show();
        $('#currentTable').hide();
    });

    // Show the current table and hide the archive table
    $('#currentTableButton').on("click", function() {
        $('#currentTable').show();
        $('#archiveTable').hide();
    });

    // Close the add object modal when the cancel button is clicked
    $('#cancelButton').on("click", function() {
        createDialog.close();
    });

    // Submit the form and close the add object modal when the submit button is clicked
    $('#submitButton').on("click", function() {
        createDialog.close();
    });

    // Load the tables on page load
    loadTable();

    // Form submission for creating a new object
    $('#createForm').on('submit', (e) => {
        e.preventDefault();
        const formData = $('#createForm').serialize();
        if (!$('#name').val() || !$('#imageLink').val()) {
            alert("There are fields that have not been filled out.");
            return;
        }
        $.ajax({
            type: 'post',
            url: 'php/create.php',
            data: formData,
            beforeSend: () => {
                createDialog.close();
                document.getElementById("createForm").reset();
            },
            success: (response) => {
                loadTable();
            }
        });
    });

    // Form submission for editing an object
    $('#editForm').on('submit', (e) => {
        e.preventDefault();
        // Remove disabled attribute from fields
        $(':disabled').each(function(e) {
            $(this).removeAttr('disabled');
        });
        const formData = $('#editForm').serialize();
        $.ajax({
            type: 'post',
            url: 'php/edit.php',
            data: formData,
            beforeSend: () => {
                editDialog.close();
            },
            success: (response) => {
                // Reload Table
                loadTable();
            }
        })
    });
});

// Function to close the create dialog
function closeCreate() {
    document.getElementById("addObject").close();
}

// Function to open the edit dialog for a specific ID
function openEdit(id) {
    $.ajax({
        url: `php/editTable.php?q="${id}"`,
        success: (response) => {
            $('#editForm')[0].innerHTML = response;
        }
    });
    editDialog.showModal();
}

// Function to open the delete dialog for a specific ID
function openDelete(id) {
    $.ajax({
        url: `php/deleteModal.php?q="${id}"`,
        success: (response) => {
            console.log(response);
            $('#deleteOptions')[0].innerHTML = response;
        }
    })
    deleteDialog.showModal();
}

// Function to mark an item as found
function foundItem(id) {
    $.ajax({
        url: `php/found.php?q="${id}"`,
        success: (response) => {
            loadTable();
        }
    });
}

// Function to delete an item
function deleteItem(id) {
    $.ajax({
        url: `php/delete.php?q="${id}"`,
        beforeSend: () => {
            deleteDialog.close();
        },
        success: (response) => {
            loadTable();
        }
    });
}

// Function to load the tables
function loadTable() {
    // Load the current table
    $.ajax({
        url: "php/lostRow.php",
        success: function (response) {
            $('#currentTable')[0].innerHTML = response;
        }
    });

    // Load the archive table
    $.ajax({
        url: "php/foundRow.php",
        success: function (response) {
            $('#archiveTable')[0].innerHTML = response;
        }
    })
}
