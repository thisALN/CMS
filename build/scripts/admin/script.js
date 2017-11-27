var editable = [];
onload = function () {
    editable = document.getElementsByClassName("td");
    for (i=0; i<editable.length; i++) {
        editable[i].addEventListener("click", go(i));
    }
}
function go(i) {
    return ya(i);
}
function ya(i) {
    alert("success");
    editable[i].id = "true" + i;
}