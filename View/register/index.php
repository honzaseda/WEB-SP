<h1 style="text-align:center">Registrace nového uživatele</h1>
<hr>
<form action="<?php echo URL; ?>register/registerNew" class="form-horizontal" role="form" method="POST" data-toggle="validator">
    <div class="form-group">
        <label class="control-label col-sm-5" for="login">Login:</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" placeholder="Login" required name="Login" value="<?php if (isset($_POST['Login'])) echo(htmlspecialchars($_POST['Login'])); ?>" maxlength="30" minLength="4">
            <div class="help-block with-errors" style="margin-bottom:0px;"></div>
        </div>
    </div>
    <div class="form-group has-feedback">
        <label class="control-label col-sm-5" for="pwd">Heslo:</label>
        <div class="col-sm-3">
            <input type="password" class="form-control" placeholder="Heslo" required name="Heslo" data-minlength="6" id="inputPassword">
            <div class="help-block with-errors" style="margin-bottom:0px;"></div>
        </div>        
        <label class="control-label col-sm-5" for="pwd"></label>
        <div class="col-sm-3" style="margin-top:15px">
            <input type="password" class="form-control" placeholder="Heslo znovu" required name="HesloZnovu" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Hesla se neshodují">
            <div class="help-block with-errors" style="margin-bottom:0px;"></div>
        </div>
        
    </div>
    <div class="form-group">
        <label class="control-label col-sm-5" for="email">Email:</label>
        <div class="col-sm-3">
            <input type="email" class="form-control" placeholder="Email" required name="Email" value="<?php if (isset($_POST['Email'])) echo(htmlspecialchars($_POST['Email'])); ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
            <div class="help-block with-errors" style="margin-bottom:0px;"></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-5 col-sm-3">
            <button type="submit" name="submit-register" class="btn btn-primary" value="Submit">Registrovat</button>
        </div>
    </div>
</form>

<script src="Public/validator.js"></script>