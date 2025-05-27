function validateNameLocally(name, msgDiv) {
    // Clear previous messages
    msgDiv.innerText = '';

    if (name === "") {
        msgDiv.innerText = "Donor name is required.";
        return false;
    }
    if (name.length < 2) {
        msgDiv.innerText = "Donor name must be at least 2 characters.";
        return false;
    }
    if (!/^[a-zA-Z\s]+$/.test(name)) {
        msgDiv.innerText = "Donor name must only contain letters and spaces.";
        return false;
    }
    if (name.length > 50) {
        msgDiv.innerText = "Donor name must not exceed 50 characters.";
        return false;
    }
    return true;
}

// Event listener for form submission
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('acknowledgmentForm');
    const nameInput = document.getElementById('ackName');
    const letterDiv = document.getElementById('acknowledgmentLetter');
    const msgDiv = document.getElementById('ack-messages');

    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        const name = nameInput.value.trim();

        // Clear previous messages and hide letter
        msgDiv.innerText = '';
        letterDiv.style.display = 'none';
        letterDiv.innerHTML = '';

        // Perform client-side validation first
        if (!validateNameLocally(name, msgDiv)) {
            return; // Stop if client-side validation fails
        }

        // Make an actual fetch call to the PHP validation file
        fetch('acknowledgement-validation.php', { // Path to your PHP file
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded' // Important for PHP to parse $_POST
            },
            body: 'ackName=' + encodeURIComponent(name) // Send the name as URL-encoded data
        })
        .then(response => {
            // Check if the response is OK (status 200)
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json(); // Parse the JSON response
        })
        .then(result => {
            if (result.success) {
                letterDiv.style.display = 'block';
                letterDiv.innerHTML = result.letter; // Use the letter HTML from the PHP response
            } else {
                msgDiv.innerText = result.error || 'An unexpected error occurred on the server.';
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            msgDiv.innerText = 'Server error. Please try again later.';
        });
    });
});