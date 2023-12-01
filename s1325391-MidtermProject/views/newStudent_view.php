<html><head><title>Add a New Students</title></head>


<form method="post" name="newStudent" action=newStudent.php?action=add>
<fieldset>
    <legend>New Student:</legend>

    <label for="students_id">Student ID: </label>
    <input type="text" id="students_id" name="students_id" value="<?php echo $students_id; ?>"><br>

    <label for="first_name">First Name: </label>
    <input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>"><br>

    <label for="last_name">Last Name: </label>
    <input type="text" name="last_name" value="<?php echo $last_name; ?>"><br>

    <label for="classOf">Class Of: </label>
    <input type="text" name="classOf" value="<?php echo $classOf; ?>" size='5'><br>

    <label for="email">Email: </label>
    <input type="text" name="email" value="<?php echo $email; ?>"><br>

    <label for="password">Password: </label>
    <input type="text" name="password" value="<?php echo $password; ?>"><br>



    <hr>
    <input type="reset" value="Reset">&nbsp;&nbsp;<input type="submit" value="Add">
    <p><i><?= $message; ?>
</fieldset>
</form>
<td align='right'><a href="student.php">Students</a></td><br>
<td align='right'><a href="courses.php">Courses</a></td><br>
<a href="login.php">Login</a>
</html>
