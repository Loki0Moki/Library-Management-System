document.addEventListener('DOMContentLoaded', () => {
    const userName = localStorage.getItem('userName');
    const userEmail = localStorage.getItem('userEmail');

    if (!userName || !userEmail) {
        alert("Error: User data is missing. Please log in again.");
        document.getElementById('userName').textContent = '[User Name]';
        document.getElementById('userEmail').textContent = '[user@example.com]';
        return;
    }

    document.getElementById('userName').textContent = userName;
    document.getElementById('userEmail').textContent = userEmail;
    alert("Success: Profile data loaded successfully.");
});