let dataTable = new DataTable("#dataTableUsers", {
    searchable: true,
    perPage: 10,
    perPageSelect: [10, 25, 50, 100],
    fixedHeight: true
});
function createNewUser() {
    console.log('Creating user');
    let userEmail = document.getElementById('addUserEmail').value;
    let userRole = document.getElementById('addUserRole').value;
    let userFullName = document.getElementById('addUserFullName').value;
    let userPhoneNumber = document.getElementById('addUserPhoneNumber').value;
    let userPassword = document.getElementById('addUserPassword').value;

    let data = {
        userEmail: userEmail,
        userRole: userRole,
        userFullName: userFullName,
        userPhoneNumber: userPhoneNumber,
        userPassword: userPassword
    };

    fetch('/admin/createUser', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({data})
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
function editSelectedUser(userId) {
    console.log('Editing user');
    let userEmail = document.getElementById('editUserEmail-' + userId).value;
    let userRole = document.getElementById('editUserRole-' + userId).value;
    let userFullName = document.getElementById('editUserFullName-' + userId).value;
    let userPhoneNumber = document.getElementById('editUserPhoneNumber-' + userId).value;
    let userPassword = document.getElementById('editUserPassword-' + userId).value;

    let data = {
        userId: userId,
            userEmail: userEmail,
            userRole: userRole,
            userFullName: userFullName,
            userPhoneNumber: userPhoneNumber,
            userPassword: userPassword
    };

    fetch('/admin/updateUser', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({data})
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
function deleteSelectedUser(userId) {
    console.log('Deleting user');
    let data = {
        userId: userId
    };
    fetch('/admin/deleteUser', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({data})
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