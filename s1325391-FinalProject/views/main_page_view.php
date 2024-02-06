<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../CSS/main-page1.css" />
  <link rel="stylesheet" href="../CSS/global.css" />
  <script>
    const databaseData = <?php echo json_encode($equipments_list ?? []); ?>;
    const loggedUserId = <?php echo json_encode($logged_in_user_id ?? null); ?>;
  </script>
  <script type="text/javascript" src="../JS/main_page1.js"></script>
</head>
<body>
  <div class="main-page">
    <div class="div">
      <div class="heading">
        <div class="overlap-group">
          <div class="text-wrapper">Photography Club</div>
          <p class="p">Signed In As: 
            <?php 

            foreach ($members_list as $members)
            {
              
              $id = $members['id'];
              if ($id == $logged_in_user_id) {
                echo $members['first_name']." ".  $members['last_name'];
                }
          }?></p>
        </div>
      </div>
      <div class="overlap">
        <div class="equipment">
          <div class="overlap-2">
            <div class="overlap-group-2">
              <img class="divider" src="../img/divider.png" />
              <div class="text-wrapper-2">Equipment</div>
            </div>
            <div class="text-wrapper-3"><?php echo count($equipments_list)?> Items</div>
          </div>
        </div>

        <ul class="task-box">

        </ul>
        <div class="loan">
          <div class="overlap-3">
            <div class="text-wrapper-8">Have equipment to loan?</div>
            <div class="div-wrapper">
              <a href="../controllers/addEquipment.php" class="text-wrapper-9">Click Here!</a>
            
            </div>
            
          </div>
            

        </div>
        <div class="div-wrapper2">
          <a href="../controllers/login.php?action=logout"  class="text-wrapper-logout">Logout</div>
            </div>
      </div>
      
    </div>
    
  </div>
</body>
</html>
