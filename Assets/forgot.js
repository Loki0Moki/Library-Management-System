function sendReset() {
  const emailInput = document.getElementById('forgotEmail');
  const email = emailInput.value.trim();

  
  if (email === '') {
    alert("Error: Email field cannot be empty. Please enter your email.");
    emailInput.style.borderColor = 'red';
    return false;
  }

  if (!email.includes('@') || !email.includes('.')) {
    alert("Error: Invalid email address. Please enter a valid email.");
    emailInput.style.borderColor = 'red';
    return false;
  }

  
  emailInput.style.borderColor = '#ccc';
  alert("Success: Reset link has been sent to your email.");
  return true;
}