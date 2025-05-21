function updatePassword() {
    const passwordInput = document.getElementById('password');
    const password = passwordInput.value.trim();

    
    if (password.length < 6) {
        alert("Error: Password must be at least 6 characters long.");
        passwordInput.style.borderColor = 'red';
        return;
    }

    
    const hasNumber = /\d/.test(password);
    if (!hasNumber) {
        alert("Error: Password must include at least one number.");
        passwordInput.style.borderColor = 'red';
        return;
    }

    
    passwordInput.style.borderColor = '#ccc';
    alert("Success: Password updated successfully!");
}