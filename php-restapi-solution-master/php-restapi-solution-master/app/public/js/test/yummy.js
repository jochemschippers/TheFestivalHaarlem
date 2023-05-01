// ----------------- HIER DE TABEL FILTER ------------------
const table = document.querySelector('timeSlotsTable');
const select = document.querySelector('#rows-per-page');

select.addEventListener('change', () => {
  const rowsPerPage = select.value;
  const rows = table.querySelectorAll('tbody tr');

  for (let i = 0; i < rows.length; i++) {
    if (i < rowsPerPage) {
      rows[i].style.display = 'table-row';
    } else {
      rows[i].style.display = 'none';
    }
  }
});
// ----------------- EINDE TABEL FILTER ------------------