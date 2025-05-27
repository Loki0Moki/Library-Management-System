
function validateBorrowForm() {
    const borrowDate = document.querySelector('input[name="borrow_date"]').value;
    const returnDate = document.querySelector('input[name="return_date"]').value;

    if (!borrowDate || !returnDate) {
        alert("Please select both borrow and return dates.");
        return false;
    }

    if (new Date(returnDate) < new Date(borrowDate)) {
        alert("Return date must be after the borrow date.");
        return false;
    }

    return true;
}
