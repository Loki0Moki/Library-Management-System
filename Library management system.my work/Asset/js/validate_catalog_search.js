
function validateCatalogSearchForm() {
    const keyword = document.querySelector('input[name="keyword"]').value.trim();
    const category = document.querySelector('select[name="category"]').value;

    if (keyword === "" && category === "") {
        alert("Please enter a keyword or select a category.");
        return false;
    }

    return true;
}
