<html><head><title>Add a New Course</title></head>


<form method="post" name="newCourse" action=newCourse.php?action=add>
<fieldset>
    <legend>New Course:</legend>

    <label for="course_number">Course Number: </label>
    <input type="text" id="course_number" name="course_number" value="<?php echo $course_number; ?>"><br>

    <label for="course_description">Course Description: </label>
    <input type="text" id="course_description" name="course_description" value="<?php echo $course_description; ?>"><br>


    <hr>
    <input type="reset" value="Reset">&nbsp;&nbsp;<input type="submit" value="Add">
    <p><i><?= $message; ?>
</fieldset>
</form>
<td align='right'><a href="student.php">Students</a></td><br>
<td align='right'><a href="courses.php">Courses</a></td><br>
<td align='right'><a href="login.php">Main (Logout)</a></td>
</html>
