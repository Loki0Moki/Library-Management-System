function saveProfile() {
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();

  
  if (name === '') {
    alert("Error: Name cannot be empty. Please enter your full name.");
    document.getElementById('name').style.borderColor = 'red';
    return;
  } else {
    document.getElementById('name').style.borderColor = '#ccc';
  }

 
  if (!email.includes('@') || !email.includes('.')) {
    alert("Error: Invalid email address. Please enter a valid email.");
    document.getElementById('email').style.borderColor = 'red';
    return;
  } else {
    document.getElementById('email').style.borderColor = '#ccc';
  }

  
  alert(`Success: Profile updated successfully!\nName: ${name}\nEmail: ${email}`);
}

document.addEventListener('DOMContentLoaded', () => {
  const nameInput = document.getElementById('name');
  const emailInput = document.getElementById('email');

  
  nameInput.value = 'Ajmain Abrar';
  emailInput.value = 'ajmainabrar@example.com';

  
  nameInput.addEventListener('input', () => {
    if (nameInput.value.trim() === '') {
      nameInput.style.borderColor = 'red';
    } else {
      nameInput.style.borderColor = '#ccc';
    }
  });

  emailInput.addEventListener('input', () => {
    if (!emailInput.value.includes('@') || !emailInput.value.includes('.')) {
      emailInput.style.borderColor = 'red';
    } else {
      emailInput.style.borderColor = '#ccc';
    }
  });
});