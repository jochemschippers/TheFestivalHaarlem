//Place code here if you want to add a function to every admin related page (e.g. code for the admin navbar, which is present in all admin pages) - Tayam
function updateModalContent(form) {
    dynamicFormModal.innerHTML = '';
    dynamicFormModal.appendChild(form);
}
function handleResponse(data, row, columnProperties) {
    if (data.status === 1) {
        updateTableRow(row, columnProperties);
        successMessage.classList.remove("d-none");
        successMessage.innerHTML = data.message;
        universalModal.hide();
    } else {
        showError(data.message);
    }
    if (data.status === 1) {
        alertMessage.classList.remove('alert-danger');
        alertMessage.classList.add('alert-success');
    }
}
function updateTableRow(row, columnProperties) {
    const columns = row.children;

    columnProperties.forEach((column, index) => {
        if (column.datasetKey) {
            row.dataset[column.datasetKey] = column.value;
        }
        if (column.columnIndex) {
            columns[column.columnIndex].textContent = column.value;
        }
    });
}
function showError(errorMessage) {
    alertMessage.classList.remove('d-none');
    if (alertMessage.classList.contains("success")) {
        alertMessage.classList.remove("alert-success")
    }
    alertMessage.classList.add("alert-danger");
    alertMessage.innerHTML = errorMessage;
}
function getSelectedOptionText(selectElement) {
    return selectElement.options[selectElement.selectedIndex].innerHTML;
}
function shortenString(str) {
    if (str.length > 80) {
        return str.slice(0, 80) + "...";
    }
    return str;
}
function goToLastPage(dataTable) {
    const perPage = dataTable.options.perPage;
    const rowCount = dataTable.data.length;
    const lastPageIndex = Math.ceil(rowCount / perPage);
    dataTable.page(lastPageIndex);
}
function removeRow(dataTable, row) {
    const pageIndex = dataTable.currentPage - 1;
    var rowIndex = Array.from(dataTable.table.rows).indexOf(row);
    rowIndex += (dataTable.options.perPage * pageIndex - 1);
    dataTable.rows().remove(rowIndex);
    dataTable.update();
}
function loadJsFilesFromFolder(url, fileNames) {
    fileNames.forEach((fileName) => {
        const scriptElement = document.createElement('script');
        scriptElement.src = `${url}${fileName}`;
        document.body.appendChild(scriptElement);
    });
}