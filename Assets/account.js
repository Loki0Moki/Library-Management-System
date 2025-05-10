document.addEventListener('DOMContentLoaded', () => {
  localStorage.setItem('userName', 'Ajmain'); 
  const userName = localStorage.getItem('userName');
  const userEmail = localStorage.getItem('userEmail');
  const statusMessage = document.getElementById('statusMessage');

  if (!userName || !userEmail) {
    statusMessage.textContent = "Error: User data is missing. Please log in again.";
    statusMessage.style.color = "red";
    return;
  }

  statusMessage.textContent = `Welcome, ${userName}! Your email is ${userEmail}.`;
  statusMessage.style.color = "lightgreen";
});