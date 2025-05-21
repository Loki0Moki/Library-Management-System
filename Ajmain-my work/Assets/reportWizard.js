function generateReport() {
  const branch = document.getElementById('branch').value;
  const period = document.getElementById('period').value;

  if (branch && period) {
    alert(`Generating report for ${branch} during ${period}...`);
  } else {
    alert("Please select both branch and time period.");
  }
}