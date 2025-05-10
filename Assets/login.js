function loginUser() {
    const emailInput = document.getElementById('loginEmail');
    const passInput = document.getElementById('loginPass');
    const email = emailInput.value.trim();
    const pass = passInput.value.trim();

    
    if (email === '') {
        alert("Error: Email field cannot be empty. Please enter your email.");
        emailInput.style.borderColor = 'red';
        return false;
    }
    if (!email.includes('@') || !email.includes('.')) {
        alert("Error: Invalid email address. Please enter a valid email.");
        emailInput.style.borderColor = 'red';
        return false;
    } else {
        emailInput.style.borderColor = '#ccc';
    }

    
    if (pass === '') {
        alert("Error: Password field cannot be empty. Please enter your password.");
        passInput.style.borderColor = 'red';
        return false;
    }
    if (pass.length < 6) {
        alert("Error: Password must be at least 6 characters long.");
        passInput.style.borderColor = 'red';
        return false;
    } else {
        passInput.style.borderColor = '#ccc';
    }

    
    localStorage.setItem('userEmail', email);
    localStorage.setItem('userName', 'Ajmain Abrar'); 
    alert("Success: Login successful!");
    return true;
}