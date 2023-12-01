<html><head><title>Login</title></head>
<form method="post" action="login.php?action=login">
<fieldset>
    <legend>Login:</legend>
    <label for="email">EMail: </label>
    <input type="text" id="email" name="email" value="" size="64"><br>
    <label for="password">Password: </label>
    <input type="password" name="password" value=""><br>
    <p><i><?= $message; ?>

    <p><a href="enrollStudent.php">Enroll Student</a>
    <hr>
    <input type="reset" value="Reset">&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" value="Login">
</fieldset>
</form>
</html>
