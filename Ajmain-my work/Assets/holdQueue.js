const holdQueue = [
    "The Great Gatsby",
    "To Kill a Mockingbird",
    "1984",
    "Harry Potter and the Sorcerer's Stone"
  ];
  
  const queueList = document.getElementById('holdQueue');
  
  holdQueue.forEach((book, index) => {
    const listItem = document.createElement('li');
    listItem.textContent = `${index + 1}. ${book}`;
    queueList.appendChild(listItem);
  });
  