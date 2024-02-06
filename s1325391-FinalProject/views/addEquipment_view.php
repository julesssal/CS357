<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../CSS/addEquipment_view.css" />
  <link rel="stylesheet" href="../CSS/global.css" />
  <script src="../JS/addEquipment.js"></script>
</head>

<body>
<div class="add-equipment">

    <div class="div">
        
        <div class="heading">
            <div class="overlap-group">
                <div class="text-wrapper">Photography Club</div>
                <div class="p">Signed In As: <?php 

                foreach ($members_list as $members)
                {
                
                $id = $members['id'];
                if ($id == $logged_in_user_id) {
                    echo $members['first_name']." ".  $members['last_name'];
                    }
                }?></div>
            </div>
        </div>
        <div class="background-left"></div>
        <div class="overlap">
            <div class="overlap-2">
                <div class="equipment">
                    <div class="overlap-3">
                        <div class="text-wrapper-2">Register Equipment</div>
                        <img class="divider" src="../img/divider.png" />
                    </div>
                </div>
            </div>
            <div class="item-container-2">
            
            </div>
            <div class="item-container">
                <div class="picture-of-item">Picture of Item:</div>
                <div class="text-wrapper-3">Name of Item:</div>
                <form method="post" action='addEquipment.php?action=upload' enctype="multipart/form-data" id="fileInput">
                    
                    <div class="name-of-item-text">
                       
                        <input type="text" name="equipment_name" id="NameOfEquipmentTextBox" class="input-text-box"  placeholder="Name of Item" onSubmit="return validateCreation(this)" />
                    </div>

                    
                    <div class="div-wrapper">
                        <input type="file" name="documentFile" id="fileInput" class="file-input" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" />
                    </div>

                 
                    <div class="overlap-4">
                        <button type="submit" name="action" value="upload" class="text-wrapper-6">Upload Item</button>
                    </div>
                </form>

            </div>
         
            <a href="../controllers/main_page.php" class="text-wrapper-7">Back</a>
        
            <div class="div-wrapper2">
                <a href="../controllers/login.php?action=logout"  class="text-wrapper-logout">Logout</div>
            </div>
            </div>
       
            
    </div>
    
</div>
</body>

</html>