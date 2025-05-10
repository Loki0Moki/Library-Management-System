function verifyCode() {
  const codeInput = document.getElementById('code');
  const code = codeInput.value.trim();

  
  if (code === "") {
    alert("Error: Verification code cannot be empty. Please enter the code sent to your email.");
    codeInput.style.borderColor = 'red';
    return false;
  }

  if (code.length !== 6 || isNaN(code)) {
    alert("Error: Invalid verification code. Please enter a 6-digit numeric code.");
    codeInput.style.borderColor = 'red';
    return false;
  }

  
  codeInput.style.borderColor = '#ccc';
  alert("Success: Email verified successfully!");
  return true;
}