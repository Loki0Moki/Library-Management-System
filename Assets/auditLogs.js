const logs = [
  { date: "2025-04-25 10:30AM", staff: "Ajmain", action: "Checked out book to patron" },
  { date: "2025-04-25 11:00AM", staff: "Shajid", action: "Updated inventory records" },
  { date: "2025-04-25 02:15PM", staff: "Abrar", action: "Assigned new role to staff" }
];

const logTable = document.getElementById('auditLogs');

logs.forEach(log => {
  const row = `<tr>
                <td>${log.date}</td>
                <td>${log.staff}</td>
                <td>${log.action}</td>
              </tr>`;
  logTable.innerHTML += row;
});