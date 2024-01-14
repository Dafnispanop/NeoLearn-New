function changePassword() {
    var currentPassword = prompt("Enter current password:");
    if (currentPassword !== null) {
        var newPassword = prompt("Enter new password:");
        if (newPassword !== null) {
            // Send an AJAX request to the server to handle password change
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "change_password.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                }
            };
            xhr.send("currentPassword=" + currentPassword + "&newPassword=" + newPassword);
        }
    }
}
    /*
    if (currentPassword == psw) {
        var newPassword = prompt("Εισάγετε τον νέο κωδικό σας:");
        if (newPassword !== null) {
             Εδώ μπορείτε να προσθέσετε κώδικα για να ελέγξετε τον τρέχοντα κωδικό και να ενημερώσετε τη βάση δεδομένων με τον νέο κωδικό
            alert("Ο κωδικός άλλαξε με επιτυχία!");
        }
    } else {
        print("Incorrect password. Please try again.")
    }
    */
