document.getElementById("scheduleExport").addEventListener("change", function () {
  const scheduleOptions = document.getElementById("scheduleOptions");
  scheduleOptions.style.display = this.checked ? "block" : "none";
});

document.getElementById("exportForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const dataRange = document.getElementById("dataRange").value;
  const format = document.getElementById("format").value;
  const isScheduled = document.getElementById("scheduleExport").checked;
  const scheduleDate = document.getElementById("scheduleDate").value;
  const statusMessage = document.getElementById("statusMessage");

  if (isScheduled) {
    statusMessage.textContent = `Export (${dataRange}, ${format.toUpperCase()}) scheduled for ${scheduleDate}.`;
  } else {
    statusMessage.textContent = `Downloading ${dataRange} data as ${format.toUpperCase()}...`;
  }
});
