function assignRole() {
    const role = document.getElementById("userRole").value;

    
    if (!role) {
        alert("Error: No role selected. Please select a valid role.");
        return;
    }

    
    const validRoles = ["Admin", "Editor", "User"];
    if (!validRoles.includes(role)) {
        alert("Error: Invalid role selected. Please choose a valid role.");
        return;
    }

    
    alert(`Success: Role "${role}" has been assigned successfully.`);
}
