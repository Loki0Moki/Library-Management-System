function getISBNParam() {
  const params = new URLSearchParams(window.location.search);
  return params.get('isbn');
}

function displayResults(isbn) {
  const container = document.getElementById('resultsContainer');
  if (isbn) {
    container.innerHTML = `
      <div class="book-info">
        <h2>Book Found!</h2>
        <p><strong>ISBN:</strong> ${isbn}</p>
        <p><strong>Title:</strong> Example Book Title</p>
        <p><strong>Availability:</strong> Available</p>
      </div>
      <button onclick="addToCart('${isbn}')">Add to Cart</button>
    `;
  } else {
    container.innerHTML = "<p>No ISBN provided.</p>";
  }
}

function addToCart(isbn) {
  alert(`Book with ISBN ${isbn} added to your cart!`);
}

const isbn = getISBNParam();
displayResults(isbn);