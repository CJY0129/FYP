function includeFile(filename) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", filename, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("includedContent").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

function toggleDropdown() {
    var dropdown = document.getElementById("exampledropdownDropdown");
    var isExpanded = dropdown.getAttribute("aria-expanded") === "true";
    dropdown.setAttribute("aria-expanded", !isExpanded);
}
