function showMenu() {
    if(document.getElementById("header").style.overflow == 'hidden') {
        document.getElementById("header").style.overflow = "visible";
    } else {
        document.getElementById("header").style.overflow = "hidden";
    }
};

function searchButton() {
    document.getElementById("mb-search-bar").style.opacity == '1';
    document.getElementById("mb-search-bar").style.transform == 'none';
}