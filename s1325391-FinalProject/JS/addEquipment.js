document.addEventListener("DOMContentLoaded", function () {
    var form = document.getElementById('fileInput');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        var formData = new FormData(form);
        for (var key of formData.keys()) {
            console.log(key);
        }
        fetch('addEquipment.php?action=upload', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
        if (data.includes('Equipment Added')) {
            alert("Equipment added successfully!");
        } else {
            alert("Error in adding equipment");
        }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        
    });
});
