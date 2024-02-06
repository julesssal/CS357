function validateFirstName (field) {
    return (field == "") ? "Enter First Name\n" : ""
}
function validateLastName (field) {
    return (field == "") ? "Enter Last Name\n" : ""
}
function validateEmail(field) {
    if (field == "") {
        return "Enter Email\n"
    }
    else {
        const dot = field.indexOf(".") > 0
        const att = field.indexOf("@") > 0
        const pattern = /[a-zA-Z0-9._]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/.test(field)
        return (dot && att && pattern) ? "" : "Invalid Email Format"
    }
}

function validatePassword (field) {
    return (field == "") ? "Enter Password\n" : ""
}

function validateCreation (form) {
    var result = validateFirstName (form.first_name.value)
    result += validateLastName (form.last_name.value)
    result += validateEmail (form.email.value)
    result += validatePassword (form.password.value)
    
    if (result == "") return true
    else { alert ("Error:\n" + result); return false }
}