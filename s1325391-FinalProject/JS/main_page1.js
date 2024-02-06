console.log(databaseData);

function createCard(item) {
    const card = document.createElement("li");
    card.className = item.equipment_name; 
  
    const textWrapper4 = document.createElement("div");
    textWrapper4.className = "text-wrapper-4";
    textWrapper4.innerText = item.equipment_name;
  

    const textWrapper5 = document.createElement("div");
    textWrapper5.className = "text-wrapper-5";

    const textWrapper7 = document.createElement("div");
    textWrapper7.className = "text-wrapper-7";


    const status = item.borrower_id ? false : true;
    if (status == false){
        textWrapper5.innerText = "Not Available";
        card.appendChild(textWrapper5);
    }else{
        textWrapper7.innerText= "Available";
        card.appendChild(textWrapper7);
    }   
    
    const textWrapper6 = document.createElement("div");
    textWrapper6.className = "text-wrapper-6";

    if (loggedUserId != item.owner_id && status == true){
        const borrow_button = document.createElement("button");
        borrow_button.className = "borrow-button"; 
        borrow_button.innerText = "Click here to borrow from: " + item.first_name + " "+item.last_name;
    
       
        borrow_button.addEventListener("click", function () {
          
            borrowEquipment(item.id);
            
            console.log("Button clicked for equipment ID:", item.id);
        });
    
        card.appendChild(borrow_button);

    }else if(loggedUserId == item.owner_id){
        textWrapper6.innerText = "You own this item";
        card.appendChild(textWrapper6);
    }else if(loggedUserId ==item.borrower_id){
        textWrapper6.innerText = "You are borrowing this item";
        card.appendChild(textWrapper6);
    }

    function borrowEquipment(equipmentId) {
        const formData = new FormData();
        formData.append('action', 'borrow');
        formData.append('equipmentId', equipmentId);
        formData.append('borrowerId', loggedUserId);
    
        fetch('../controllers/main_page.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert ("Equipment Borrowed Successfully!");
            console.log("Equipment borrowed successfully:", data);
            location.reload(true);
            
        })
        .catch(error => {
            console.error("Error borrowing equipment:", error);
        });
    }

    const image = document.createElement("img");
    image.className = "image";
    
    image.src = item.picture || ''; 
    
    if (loggedUserId == item.owner_id && status == false) {
    const button = document.createElement("button");
    button.className = "update-button"; 
    button.innerText = "Update Status to Available";

    button.addEventListener("click", function () {
        
        updateDatabase(item.id);
       
        console.log("Button clicked for equipment ID:", item.id);
    });

    
    card.appendChild(button);
    }

    function updateDatabase(equipmentId) {
        const formData = new FormData();
        formData.append('action', 'update');
        formData.append('equipmentId', equipmentId);
    
        fetch('../controllers/main_page.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert ("Equipment Returned Successfully!");
            console.log("Database updated successfully:", data);
            location.reload(true);
           
        })
        .catch(error => {
            console.error("Error updating database:", error);
        });
    }


    card.appendChild(textWrapper4);
    

    card.appendChild(image);
  
    return card;
  }


function populateTaskBox() {
    const taskBox = document.querySelector(".task-box"); 
    if (taskBox) {
        databaseData.forEach(item => {
            console.log("Creating card for:", item);
            const card = createCard(item);
            taskBox.appendChild(card);
        });
    } else {
        console.error("Task box element not found.");
    }
  }

document.addEventListener("DOMContentLoaded", function() {
    populateTaskBox();
  });