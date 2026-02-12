<?php
if(isset($_POST['save'])){
    $pass1 = htmlspecialchars($_POST['pass_word']);
    $pass2 = htmlspecialchars($_POST['check_pass_word']);
    $pass1= password_hash($pass1, PASSWORD_DEFAULT);
    echo password_verify($pass2, $pass1);
}
?>
<!doctype html>
<html>
<body>
<form method="POST">
    <input type="text" placeholder="password" name="pass_word"/>
    <input type="text" placeholder="password" name="check_pass_word"/>
    <button type="submit" name="save">click</button>
</form>
</body>
</html>