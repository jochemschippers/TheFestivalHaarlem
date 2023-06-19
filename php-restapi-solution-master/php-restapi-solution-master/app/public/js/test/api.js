let dataTable = new DataTable("#dataTableApis", {
    searchable: true,
    perPage: 10,
    perPageSelect: [10, 25, 50, 100],
    fixedHeight: true
});

function sanitize(input) {
    const div = document.createElement("div");
    div.textContent = input;
    return div.innerHTML;
}

function createApi() {
    let createAPIID = 0;
    let createAPIName = sanitize(document.getElementById('createAPIName').value);
    let createAPIKey = sanitize(document.getElementById('createAPIKey').value);

    if (!createAPIName || !createAPIKey) {
        alert("Please fill in all the fields.");
        return;
    }

    let data = {
        APIID: createAPIID,
        APIName: createAPIName,
        APIKEY: createAPIKey,
    };

    fetch('/test/apiCreate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Network error: ${response.statusText}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.status === 1) {
                // Handle success, e.g., reload the page or display a success message
            } else {
                // Handle error, e.g., display an error message
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

function editApi(apiId) {
    let editAPIName = sanitize(document.getElementById(`editAPIName-${apiId}`).value);
    let editAPIKey = sanitize(document.getElementById(`editAPIKey-${apiId}`).value);

    if (!editAPIName || !editAPIKey) {
        alert("Please fill in all the fields.");
        return;
    }

    let data = {
        ApiID: apiId,
        APIName: editAPIName,
        APIKEY: editAPIKey,
    };

    fetch('/test/apiUpdate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Network error: ${response.statusText}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.status === 1) {
                // Handle success, e.g., reload the page or display a success message
            } else {
                // Handle error, e.g., display an error message
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

function deleteApi(apiId) {
    let data = {
        ApiID: apiId,
    };

    fetch('/test/apiDelete', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Network error: ${response.statusText}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.status === 1) {
                // Handle success, e.g., reload the page or display a success message
                successAlert(data.message);
            } else {
                // Handle error, e.g., display an error message
                errorAlert(data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}
// document.addEventListener('DOMContentLoaded', (event) => {
//     // Event listener for creating new API
//     const createForm = document.getElementById('addAPIForm');
//     if (createForm) {
//         createForm.addEventListener('submit', function (e) {
//             e.preventDefault();
//             createApi();
//         });
//     }

//     // Event listeners for editing APIs
//     const editForms = document.querySelectorAll('[id^="editAPIForm-"]');
//     editForms.forEach(function (form) {
//         const apiId = form.id.split('-')[1]; // split id string to get the API ID
//         form.addEventListener('submit', function (e) {
//             e.preventDefault();
//             editApi(apiId);
//         });
//     });

//     // Event listeners for deleting APIs
//     const deleteForms = document.querySelectorAll('[id^="delete-"]');
//     deleteForms.forEach(function (form) {
//         const apiId = form.id.split('-')[1]; // split id string to get the API ID
//         form.addEventListener('submit', function (e) {
//             e.preventDefault();
//             deleteApi(apiId);
//         });
//     });
// });