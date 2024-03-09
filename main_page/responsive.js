function showMenu() {
    if(document.getElementById("header").style.overflow == 'hidden') {
        document.getElementById("header").style.overflow = "visible";
    } else {
        document.getElementById("header").style.overflow = "hidden";
    }
};

function searchButton() {
    console.log('hi');
    document.getElementById("mb-search-bar").style.opacity == 'unset';
    document.getElementById("mb-search-bar").style.transform == 'unset';
}