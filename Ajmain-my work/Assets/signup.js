function validateSignup() {
  const fullNameInput = document.getElementById('signupFullName');
  const emailInput = document.getElementById('signupEmail');
  const passInput = document.getElementById('signupPass');
  const confirmInput = document.getElementById('signupConfirm');

  const fullName = fullNameInput.value.trim();
  const email = emailInput.value.trim();
  const pass = passInput.value.trim();
  const confirm = confirmInput.value.trim();

  if (fullName === '' || fullName.length < 2) {
    alert("Error: Full Name must be at least 2 characters long.");
    fullNameInput.style.borderColor = 'red';
    return false;
  } else {
    fullNameInput.style.borderColor = '#ccc';
  }

  
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
    alert("Error: Password field cannot be empty. Please enter a password.");
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

  
  if (confirm === '') {
    alert("Error: Confirm password field cannot be empty. Please re-enter your password.");
    confirmInput.style.borderColor = 'red';
    return false;
  }
  if (pass !== confirm) {
    alert("Error: Passwords do not match. Please try again.");
    confirmInput.style.borderColor = 'red';
    return false;
  } else {
    confirmInput.style.borderColor = '#ccc';
  }

  // Success message
  alert("Success: Signup successful! Check your email for verification.");
  return true;
}