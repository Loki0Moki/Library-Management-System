function generateAcknowledgment() {
  const name = document.getElementById('ackName').value;
  const letterDiv = document.getElementById('acknowledgmentLetter');
  if (name) {
    letterDiv.style.display = 'block';
    letterDiv.innerHTML = `
      <h2>Thank You, ${name}!</h2>
      <p>We sincerely appreciate your generous book donation to our library. 
      Your support helps us enrich our collection and serve our community better.</p>
      <p>Sincerely,<br>The Library Team</p>
    `;
  } else {
    alert("Please enter the donor's name.");
  }
}