function showPermissions() {
    const role = document.getElementById("viewRole").value;
    const list = document.getElementById("permissionList");
    list.innerHTML = "";

    if (!role) {
        alert("Error: No role selected. Please select a valid role.");
        return;
    }

    let permissions = [];

    if (role === "Admin") {
        permissions = ["Dashboard", "Manage Users", "Edit Content", "Settings"];
    } else if (role === "Editor") {
        permissions = ["Dashboard", "Edit Content"];
    } else if (role === "User") {
        permissions = ["Dashboard", "View Content"];
    } else {
        alert("Error: Invalid role selected. Please try again.");
        return;
    }

    if (permissions.length > 0) {
        permissions.forEach(item => {
            const li = document.createElement("li");
            li.textContent = item;
            list.appendChild(li);
        });
        alert(`Success: Permissions for the role "${role}" have been displayed.`);
    }
}
