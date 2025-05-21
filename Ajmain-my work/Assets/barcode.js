function searchISBN() {
  const isbn = document.getElementById('isbnInput').value.trim();
  if (isbn) {
    const encodedISBN = encodeURIComponent(isbn);
    window.location.href = `quickResults.html?isbn=${encodedISBN}`;
  } else {
    alert("Please enter or scan an ISBN.");
  }
}