function assignRole() {
  const staff = document.getElementById('staffName').value;
  const role = document.getElementById('roleSelect').value;

  if (staff && role) {
    alert(`${staff} has been assigned the role of ${role}.`);
    document.getElementById('staffName').value = '';
    document.getElementById('roleSelect').value = '';
  } else {
    alert("Please enter staff name and select a role.");
  }
}