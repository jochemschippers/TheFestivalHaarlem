let dataTable = new DataTable("#dataTableUsers", {
    searchable: true,
    perPage: 10,
    perPageSelect: [10, 25, 50, 100],
    fixedHeight: true
});
function createUser() {
    let userEmail = document.getElementById('addUserEmail').value;
    let userRole = document.getElementById('addUserRole').value;
    let userFullName = document.getElementById('addUserFullName').value;
    let userPhoneNumber = document.getElementById('addUserPhoneNumber').value;
    let userPassword = document.getElementById('addUserPassword').value;

    fetch('/admin/createUser', {
        method: 'POST',
        body: JSON.stringify({
            task: 'create',
            userEmail: userEmail,
            userRole: userRole,
            userFullName: userFullName,
            userPhoneNumber: userPhoneNumber,
            userPassword: userPassword
        }),
        headers: { 'Content-Type': 'application/json' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload the page or update the table to reflect the new user
            location.reload();
        } else {
            alert('Error creating user');
        }
    });
}
function editUser(userId) {
    let userEmail = document.getElementById('editUserEmail-' + userId).value;
    let userRole = document.getElementById('editUserRole-' + userId).value;
    let userFullName = document.getElementById('editUserFullName-' + userId).value;
    let userPhoneNumber = document.getElementById('editUserPhoneNumber-' + userId).value;
    let userPassword = document.getElementById('editUserPassword-' + userId).value;

    fetch('/admin/updateUser', {
        method: 'POST',
        body: JSON.stringify({
            task: 'update',
            userId: userId,
            userEmail: userEmail,
            userRole: userRole,
            userFullName: userFullName,
            userPhoneNumber: userPhoneNumber,
            userPassword: userPassword
        }),
        headers: { 'Content-Type': 'application/json' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload the page or update the table to reflect the updated user
            location.reload();
        } else {
            alert('Error updating user');
        }
    });
}
function deleteUser(userId) {
    fetch('/admin/deleteUser', {
        method: 'POST',
        body: JSON.stringify({
            task: 'delete',
            userId: userId
        }),
        headers: { 'Content-Type': 'application/json' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload the page or update the table to reflect the deleted user
            location.reload();
        } else {
            alert('Error deleting user');
        }
    });
}