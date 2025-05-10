const shifts = [
  { name: "Ajmain", shift: "Morning", day: "Monday" },
  { name: "Shajid", shift: "Evening", day: "Tuesday" },
  { name: "Abrar", shift: "Night", day: "Friday" }
];

const shiftTable = document.getElementById('shiftTable');

shifts.forEach(staff => {
  const row = `<tr>
                <td>${staff.name}</td>
                <td>${staff.shift}</td>
                <td>${staff.day}</td>
              </tr>`;
  shiftTable.innerHTML += row;
});