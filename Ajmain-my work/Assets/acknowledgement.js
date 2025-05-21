function validateDonorName(name) {
  return fetch('../Controller/acknowledgement-validation.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'ackName=' + encodeURIComponent(name)
  })
  .then(response => response.json());
}

function generateAcknowledgment() {
  const name = document.getElementById('ackName').value.trim();
  const letterDiv = document.getElementById('acknowledgmentLetter');

  if (!validateNameLocally(name)) {
    return;
  }

  validateDonorName(name).then(result => {
    if (result.valid) {
      letterDiv.style.display = 'block';
      letterDiv.innerHTML = `
        <h2>Thank You, ${name}!</h2>
        <p>We sincerely appreciate your generous book donation to our library. 
        Your support helps us enrich our collection and serve our community better.</p>
        <p>Sincerely,<br>The Library Team</p>
      `;
    } else {
      letterDiv.style.display = 'none';
      alert(result.message);
    }
  });
}

// Local form validation before submission
function validateNameLocally(name) {
  if (name === "") {
    alert("Donor name is required.");
    return false;
  }
  if (name.length < 2) {
    alert("Donor name must be at least 2 characters.");
    return false;
  }
  if (!/^[a-zA-Z\s]+$/.test(name)) {
    alert("Donor name must only contain letters and spaces.");
    return false;
  }
  return true;
}

function validateForm() {
  const name = document.getElementById('ackName').value.trim();
  return validateNameLocally(name);
}

// Load result from query string
document.addEventListener('DOMContentLoaded', function() {
  function getParam(name) {
    const url = new URL(window.location.href);
    return url.searchParams.get(name);
  }

  const error = getParam('error');
  const success = getParam('success');
  const donorName = getParam('name');

  if (donorName) {
    document.getElementById('ackName').value = donorName;
  }

  if (error) {
    document.getElementById('ack-messages').innerHTML = '<div class="ack-error">' + decodeURIComponent(error) + '</div>';
    document.getElementById('acknowledgmentLetter').style.display = 'none';
  } else if (success && donorName) {
    document.getElementById('acknowledgmentLetter').style.display = 'block';
    document.getElementById('acknowledgmentLetter').innerHTML = `
      <h2>Thank You, ${donorName}!</h2>
      <p>We sincerely appreciate your generous book donation to our library. Your support helps us enrich our collection and serve our community better.</p>
      <p>Sincerely,<br>The Library Team</p>
    `;
    document.getElementById('ack-messages').innerHTML = '';
  } else {
    document.getElementById('acknowledgmentLetter').style.display = 'none';
    document.getElementById('ack-messages').innerHTML = '';
  }
});
