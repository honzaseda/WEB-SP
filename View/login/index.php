<h1 style="text-align:center">Přihlášení</h1>
<hr>
<form class="form-horizontal" role="form" action="<?php echo URL; ?>login/log_in" method="post">
    <div class="form-group">
        <label class="control-label col-sm-5" for="email">Login:</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" name="Login" placeholder="Login" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-5" for="pwd">Heslo:</label>
        <div class="col-sm-3">
            <input type="password" class="form-control" name="Heslo" placeholder="Heslo" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-5 col-sm-3">
            <button type="submit" name="submit-login" class="btn btn-primary">Přihlásit</button>
        </div>
    </div>
</form>
<hr>
<p style="text-align:center">Ještě nemáš účet? <a href="<?php echo URL; ?>register">Zaregistruj se!</a></p>