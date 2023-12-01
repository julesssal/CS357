<html><head><title>Register for a Course</title></head>
<body>


<form method="post" name="newRegistration" action=newRegistration.php?action=add>

<fieldset>
    <legend>New Registration:</legend>



    <div style="text-align: center">
      <?php
      foreach ($registrations_list as $registrations)
        {
          $id = $registrations['students_id'];

      }
      if ($id == $logged_in_user_id) {
      echo "Student: " .$registrations['first_name']." ".  $registrations['last_name'];
      }

      ?>
    </div>

    <p>Select Course:
    <SELECT name='courses'>
    <?php
        foreach ($courses_list as $course) {
          echo "<option value='" . intval($course['courses_id']) . "'>" . $course['course_number'] . " " . $course['course_description'] . "</option>";
        }

    ?>



    <hr>

    <input type="reset" value="Reset">&nbsp;&nbsp;<input type="submit" value="add">
    <p><i><?= $message; ?>
</fieldset>
</form>
<a href="../controllers/student.php">Students List</a>
</body>
</html>
