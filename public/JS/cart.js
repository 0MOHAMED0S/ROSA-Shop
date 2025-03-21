    // Initialize overall total on page load
    updateOverallTotal();

    function incrementQuantity(button) {
        var inputElement = button.parentNode.querySelector('.quantity-input');
        inputElement.value = parseInt(inputElement.value) + 1;
        updateTotal(inputElement);
    }

    function decrementQuantity(button) {
        var inputElement = button.parentNode.querySelector('.quantity-input');
        if (parseInt(inputElement.value) > 1) { // Ensure value never goes below 1
            inputElement.value = parseInt(inputElement.value) - 1;
            updateTotal(inputElement);
        }
    }

    function updateTotal(inputElement) {
        var quantity = Math.max(1, parseInt(inputElement.value)); // Ensure min value is 1
        inputElement.value = quantity; // Prevent manual input below 1

        var pricePerUnit = parseFloat(inputElement.closest('tr').querySelector('.price').textContent);
        var total = quantity * pricePerUnit;

        // Update the total price cell
        var row = inputElement.closest('tr');
        var totalCell = row.querySelector('.total-price');
        totalCell.textContent = total.toFixed(2) + ' EGP';

        // Update the overall total
        updateOverallTotal();
    }

    function updateOverallTotal() {
        var overallTotal = 0;

        // Iterate through each row in the table
        var rows = document.querySelectorAll('tr');
        rows.forEach(function(row) {
            var totalCell = row.querySelector('.total-price');
            if (totalCell) {
                overallTotal += parseFloat(totalCell.textContent);
            }
        });

        // Update the overall total in the HTML
        var overallTotalElement = document.getElementById('overall-total');
        overallTotalElement.textContent = overallTotal.toFixed(2) + ' EGP';
    }
