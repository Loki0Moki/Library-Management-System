
function validateContactForm() {
    const name = document.querySelector('input[name="name"]').value.trim();
    const email = document.querySelector('input[name="email"]').value.trim();
    const message = document.querySelector('textarea[name="message"]').value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!name || !email || !message) {
        alert("Please fill in all fields.");
        return false;
    }

    if (!emailPattern.test(email)) {
        alert("Invalid email format.");
        return false;
    }

    return true;
}
