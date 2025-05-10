const availableBooks = [
    "Pride and Prejudice",
    "The Hobbit",
    "The Catcher in the Rye"
  ];
  
  const alertContainer = document.getElementById('alerts');
  
  availableBooks.forEach(book => {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert';
    alertDiv.textContent = `Good news! "${book}" is now available for pickup.`;
    alertContainer.appendChild(alertDiv);
  });
  