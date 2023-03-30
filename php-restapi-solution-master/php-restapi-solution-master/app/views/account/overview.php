<body>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<div class="body-color byngle">
  <div class="container my-account-settings">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="upload">
          <img class="img-responsive user-image" src="https://s14.postimg.org/604ahsivl/men.png" alt="logo">
          <a class="btn btn-primary btn-upload" href="#">UPLOAD NEW PICTURE</a>
          <a class="btn btn-gray btn-delete" href="#">DELETE</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-7 col-md-7 col-sm-12 edit-info">
        <h1 class="title">Edit Info</h1>
        <fieldset class=" edit-controls clearfix">
          <div class="form-group">
            <label class="control-label label" for="txtName">Name</label>
            <div>
              <input id="txtName" name="txtName" type="text" placeholder="Adam Schwartz" class="input">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label label" for="txtEmail">Email</label>
            <div>
              <input id="txtEmail" name="txtEmail" type="text" placeholder="adam@gmail.com" disabled class="input">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label label" for="txtLocation">Location</label>
            <div>
              <input id="txtLocation" name="txtLocation" type="text" placeholder="51310" class="input">
              <div class="bottom-legend">
                <span>Tampa, Florida, 33606</span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label label" for="txtBio">Bio</label>
            <div>
              <textarea class="input" id="txtBio" name="txtBio" rows="5" placeholder="Live in the DTC...."></textarea>
            </div>
          </div>
          <div class="form-group">
            <div>
              <a class="btn btn-primary" type="submit">SAVE</a>
              <a class="btn btn-gray" type="submit">CANCEL</a>
            </div>
          </div>
        </fieldset>
      </div>
      <div class="col-lg-5 col-md-5 col-sm-12 ">
        <div class="change-password">
          <h1 class="title">Change Password</h1>
          <fieldset class=" edit-controls clearfix">
            <div class="form-group">
              <label class="control-label label" for="txtOldPassword">Old password</label>
              <div>
                <input id="txtOldPassword" name="txtOldPassword" type="password" class="input">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label label" for="txtNewPassword">New password</label>
              <div>
                <input id="txtNewPassword" name="txtNewPassword" type="password" class="input">
                <div class="bottom-legend">
                  <span>Minimum 7 characters</span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div>
                <a class="btn btn-primary" type="submit">UPDATE</a>
              </div>
            </div>
          </fieldset>
        </div>
      </div>
    </div>
  </div>
</div>

