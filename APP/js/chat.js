
// Funzione per filtrare gli utenti in base alla ricerca
function searchUsers() {
    var input, filter, container, div, txtValue;
    input = document.getElementById("searchUser");
    filter = input.value.toUpperCase();
    container = document.getElementsByClassName("user");
    console.log(input + filter + container);
    for (var i = 0; i < container.length; i++) {
        div = container[i];
        txtValue = div.textContent || div.innerText;

        // Nascondi o mostra gli utenti in base alla ricerca
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            container[i].style.display = "";
        } else {
            container[i].style.display = "none";
        }
    }
}


