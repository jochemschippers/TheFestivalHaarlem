<body>
    <div id="filler"></div>
    <div id="topBar">
        <div class="container userdetails" id="userDetailsContainer">
            <h1 id="title">User Details</h1>

            <form method="POST" action="" id="updateUserForm">
                <label for="fullNameUpdate">Full Name:</label>
                <input type="text" class="form-control" id="fullNameUpdate" name="fullNameUpdate" value="<?= $userDetails->getFullName() ?>">

                <label for="emailUpdate">Email:</label>
                <input type="email" class="form-control" id="emailUpdate" name="emailUpdate" value="<?= $userDetails->getEmail() ?>">

                <label for="phoneNumberUpdate">Phone Number:</label>
                <input type="text" class="form-control" id="phoneNumberUpdate" name="phoneNumberUpdate" value="<?= $userDetails->getPhoneNumber() ?>">

                <p>Change password? Enter down below</p>
                <label for="passwordUpdates">Password:</label>
                <input type="password" class="form-control" id="passwordUpdate" name="passwordUpdate">

                <label for="confirmPasswordUpdate">Confirm Password:</label>
                <input type="password" class="form-control" id="confirmPasswordUpdate" name="confirmPasswordUpdate">

                <input type="submit" value="Update" id="submitBtn">
            </form>

            <div>
                <label id="deleteText">Want to delete your account?<br>Please send us an email at <strong>info.thehaarlemfestival@gmail.com</strong> with the email you registered with and request for deletion.</label>
            </div>
        </div>
    </div>
</body>