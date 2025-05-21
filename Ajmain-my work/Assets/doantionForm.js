function submitDonation() {
  const donorName = document.getElementById('donorName').value.trim();
  const email = document.getElementById('email').value.trim();
  const bookTitle = document.getElementById('bookTitle').value.trim();
  const condition = document.getElementById('condition').value;

 
  if (!donorName) {
    alert("Please enter the donor's name.");
    return;
  }
  if (!email || !validateEmail(email)) {
    alert("Please enter a valid email address.");
    return;
  }
  if (!bookTitle) {
    alert("Please enter the book title.");
    return;
  }
  if (!condition) {
    alert("Please select the book condition.");
    return;
  }

  
  alert("Donation submitted successfully! Thank you for your support.");
  document.getElementById('donationForm').reset();
}

function validateEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}