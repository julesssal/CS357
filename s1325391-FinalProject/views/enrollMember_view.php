<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../CSS/enrollMember_view.css" />
    <link rel="stylesheet" href="../CSS/global.css" />
    <script type="text/javascript" src="../JS/enrollMember.js">
        
  </script>
</head>
<body>
    <div class="enrollMember">
        <div class="overlap-group-wrapper">
            <div class="overlap-group">
                <div class="background-left"></div>
                <div class="text-wrapper">Photography Club</div>
                <img class="image" src="../img/image-1.png" />
                <div class="background-right"></div>

                
                <div class="sign-in-rectangle">
                  
                    <form method="post" action="enrollMember.php" onSubmit="return validateCreation(this)">
                    <div class="text-wrapper-6">Sign Up!</div>
                     
                        <label for="FirstNameTextBoxRectangle" class="label">First Name:</label>
                        <input type="text" name="first_name" id="FirstNameTextBoxRectangle" class="first-name-text-box" placeholder="First Name" />

                      
                        <label for="LastNameTextBoxRectangle" class="label">LastName:</label>
                        <input type="text" name="last_name" id="LastNameTextBoxRectangle" class="last-name-text-box" placeholder="Last Name" />

                       
                        <label for="EmailTextBoxRectangle" class="label">Email:</label>
                        <input type="text" name="email" id="EmailTextBoxRectangle" class="email-text-box" placeholder="Email" />

                        <label for="PassWordTextBox" class="label">Password:</label>
                        <input type="password" name="password" id="PassWordTextBox" class="password-text-box" placeholder="Password" />

                        
                        <button type="submit" name="action" value="enroll" class="enroll-member-button">Create</button>
                    </form>
                </div>

             
                <a href="login.php" class="text-wrapper-5">Back</a>
            </div>
        </div>
    </div>
</body>
</html>