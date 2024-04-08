"use strict";

// Define the $() function
const $d = (selector) => document.querySelector(selector);

// Event handler for DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    
    // Display full date in the footer with slashes
    const currentDate = new Date();
    const day = currentDate.getDate().toString().padStart(2, '0');
    const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
    const year = currentDate.getFullYear();
    
    $d("footer div:last-child").innerHTML = `${month}/${day}/${year}`;
});
