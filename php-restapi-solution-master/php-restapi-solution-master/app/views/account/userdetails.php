<body>
<div id="topBar"></div>
<div class="container userdetails">
        <h1 id="title">User Details</h1>

        <form method="POST" action="">
            <?php var_dump($userDetails); ?>
            <label for="fullNameUpdate">Full Name:</label><br>
            <input type="text" id="fullNameUpdate" name="fullNameUpdate" value="<?= $userDetails->getFullName() ?>"><br>
            
            <label for="emailUpdate">Email:</label><br>
            <input type="email" id="emailUpdate" name="emailUpdate" value="<?= $userDetails->getEmail() ?>"><br>

            <label for="phoneNumberUpdate">Phone Number:</label><br>
            <input type="text" id="phoneNumberUpdate" name="phoneNumberUpdate" value="<?= $userDetails->getPhoneNumber() ?>"><br>

            <p>Change password? Enter down below</p>
            <label for="passwordUpdates">Password:</label><br>
            <input type="password" id="passwordUpdate" name="passwordUpdate"><br>

            <label for="confirmPasswordUpdate">Confirm Password:</label><br>
            <input type="password" id="confirmPasswordUpdate" name="confirmPasswordUpdate"><br>

            <input type="submit" value="Update">
        </form>

        <div>
            <label>To delete your account, please send us an email at support@example.com with your User ID and request for deletion.</label>
        </div>
</div>
</body>