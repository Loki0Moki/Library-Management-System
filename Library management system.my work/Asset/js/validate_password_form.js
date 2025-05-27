
function validatePasswordForm() {
    const current = document.getElementById("current_password").value;
    const newPass = document.getElementById("new_password").value;
    const confirm = document.getElementById("confirm_password").value;

    if (!current || !newPass || !confirm) {
        alert("All password fields are required.");
        return false;
    }

    if (newPass !== confirm) {
        alert("New password and confirmation do not match.");
        return false;
    }

    return true;
}
