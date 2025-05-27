document.addEventListener("DOMContentLoaded", function () {
    const keywordInput = document.getElementById("keyword");
    const categorySelect = document.getElementById("category");
    const resultContainer = document.getElementById("book-results");

    function fetchResults() {
        const keyword = keywordInput.value.trim();
        const category = categorySelect.value;

        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../Controller/search_book_ajax.php?keyword=" + encodeURIComponent(keyword) + "&category=" + encodeURIComponent(category), true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                resultContainer.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }

    keywordInput.addEventListener("input", fetchResults);
    categorySelect.addEventListener("change", fetchResults);

    // Load results initially
    fetchResults();
});
