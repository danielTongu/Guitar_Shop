"use strict";


// Define the $() function
const $ = (selector) => document.querySelector(selector);


// Define the calculate function
function calculate() {
    // Parse the product cost
    const productCost = parseFloat($('#productCost').value);

    // Check if the product cost is a valid number greater than zero
    if (!isNaN(productCost) && productCost > 0) {
        // Call calculateShipping function and update the total cost field
        $('#totalCost').value = calculateShipping(productCost);
    } else {
        // Display an alert for an invalid product cost
        alert('Please enter a valid product cost greater than zero.');
    }
    // Leave focus on the product cost text box
    $('#productCost').focus();
}


// Define the calculateShipping function
function calculateShipping(productCost) {
    let shippingCostPercentage = 0;

    // Determine the shipping cost percentage based on the product cost range
    if (productCost > 0 && productCost < 50) {
        shippingCostPercentage = 20;
    } else if (productCost >= 50 && productCost < 200) {
        shippingCostPercentage = 18;
    } else if (productCost >= 200 && productCost < 500) {
        shippingCostPercentage = 15;
    } else if (productCost >= 500 && productCost < 1000) {
        shippingCostPercentage = 12;
    } else {
        shippingCostPercentage = 8;
    }

    // Calculate the shipping cost
    const shippingCost = (shippingCostPercentage / 100) * productCost;

    // Return the sum of the product cost and shipping cost
    return (productCost + shippingCost).toFixed(2);
}


// Event handler for DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    // Move focus to the product cost text box
    $('#productCost').focus();

    // Attach the calculate function to the click event of the Calculate button
    $('#calculate').addEventListener('click', calculate);
});
