function resetPassword() {
  const newPassInput = document.getElementById('newPass');
  const confirmPassInput = document.getElementById('confirmPass');
  const newPass = newPassInput.value.trim();
  const confirmPass = confirmPassInput.value.trim();

  // Validate new password
  if (newPass === '') {
    alert("Error: New password cannot be empty. Please enter a password.");
    newPassInput.style.borderColor = 'red';
    return false;
  }
  if (newPass.length < 6) {
    alert("Error: Password must be at least 6 characters long.");
    newPassInput.style.borderColor = 'red';
    return false;
  } else {
    newPassInput.style.borderColor = '#ccc';
  }

  // Validate confirm password
  if (confirmPass === '') {
    alert("Error: Confirm password cannot be empty. Please re-enter your password.");
    confirmPassInput.style.borderColor = 'red';
    return false;
  }
  if (newPass !== confirmPass) {
    alert("Error: Passwords do not match. Please try again.");
    confirmPassInput.style.borderColor = 'red';
    return false;
  } else {
    confirmPassInput.style.borderColor = '#ccc';
  }

  // Success message
  alert("Success: Password reset successfully!");
  return true;
}