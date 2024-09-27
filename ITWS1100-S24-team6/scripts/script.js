// Admin Login
// Get the admin login modal element
const adminLoginModal = document.getElementById("adminLogin");

// Show admin login modal when adminBtn is clicked
document.getElementById("adminBtn").addEventListener("click", () => {
    adminLoginModal.showModal();
});

// Close admin login modal when clicking outside of it
adminLoginModal.addEventListener('click', (event) => {
    if (event.target.id === 'adminLogin') 
        adminLoginModal.close();
});

// Filter Modal
// Get the filter modal element
const filterModal = document.getElementById("filterForm");

// Show filter modal when filter button is clicked
document.getElementById("filter").addEventListener("click", () => {
    filterModal.showModal();
});

// Search
// Variables to store filter and search data
let filterData = $("#filterFormPopup").serialize();
let searchData = $("#searchForm").serialize();

// Event listener for filter form submission
document.getElementById("filterFormPopup").addEventListener("submit", (e) => {
    e.preventDefault();
    // Update filterData with form input
    filterData = $("#filterFormPopup").serialize();
    // Close the filter modal
    document.getElementById("filterForm").close();
});

// Event listener for search form submission
document.getElementById("searchForm").addEventListener("submit", (e) => {
    e.preventDefault();
    // Update searchData with form input
    searchData = $("#searchForm").serialize();
    // AJAX request to search/results.php
    $.ajax({
        url: "search/results.php",
        type: "post",
        data: `${searchData}&${filterData}`,
        success: (response) => {
            // Display search results in searchContainer
            if (!response) {
                $("#searchContainer")[0].innerHTML = "<h1 class='noResults'>No Results Found</h1>";
            } else {
                $("#searchContainer")[0].innerHTML = response;
            }
        }
    });
});

// Function to reset search results
function reset() {
    $("#searchContainer")[0].innerHTML = "";
}
