function showPermissions() {
    const role = document.getElementById("viewRole").value;
    const list = document.getElementById("permissionList");
    list.innerHTML = "";
  
    let permissions = [];
  
    if (role === "Admin") {
      permissions = ["Dashboard", "Manage Users", "Edit Content", "Settings"];
    } else if (role === "Editor") {
      permissions = ["Dashboard", "Edit Content"];
    } else if (role === "User") {
      permissions = ["Dashboard", "View Content"];
    }
  
    permissions.forEach(item => {
      const li = document.createElement("li");
      li.textContent = item;
      list.appendChild(li);
    });
  }
  