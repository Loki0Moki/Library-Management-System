function buildFilter() {
  const type = document.getElementById('materialType').value;
  const start = document.getElementById('startDate').value;
  const end = document.getElementById('endDate').value;

  if (type && start && end) {
    alert(`Filtering ${type} between ${start} and ${end}`);
  } else {
    alert("Please complete all filter options.");
  }
}