<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../CSS/login_view.css" />
    <link rel="stylesheet" href="../CSS/global.css" />
    <script type="text/javascript" src="../JS/login.js">
  </script>
</head>
<body>
    
    <div class="login">
    <div class="background-left"></div>
    <div class="background-right"></div>
        <div class="overlap-group-wrapper">
        
            <div class="overlap-group">
                
                <div class="text-wrapper">Photography Club</div>
                <img class="image" src="../img/image-1.png" />
                

                <div class="sign-in-rectangle">
                  <div class="text-wrapper-6">Sign In</div>
                    <form method="post" action="login.php" onSubmit="return validateLogin(this)">
                        
                        <label for="EmailTextBoxRectangle" class="label">Email:</label>
                        <input type="text" name="email" id="EmailTextBoxRectangle"  class="email-text-box" placeholder="Email" />

                   
                        <label for="PassWordTextBox" class="label">Password:</label>
                        <input type="password" name="password" id="PassWordTextBox"  class="password-text-box" placeholder="Password" />

                        
                        <button type="submit" name="action" value="login" class="login-button" >Login</button>
                    </form>
                </div>

               
                <a href="enrollMember.php" class="text-wrapper-5">Create an Account</a>
            </div>
        </div>
    </div>
</body>
</html>