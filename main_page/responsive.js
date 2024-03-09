function showMenu() {
    if(document.getElementById("header").style.overflow == 'visible') {
        document.getElementById("header").style.overflow = "hidden";
    } else {
        document.getElementById("header").style.overflow = "visible";
    }
};

function openSearch() {
    document.getElementById("mb-search-bar").style.opacity = 'unset';
    document.getElementById("mb-search-bar").style.transform = 'unset';
}

function closeSearch() {
    document.getElementById("mb-search-bar").style.opacity = '0';
    document.getElementById("mb-search-bar").style.transform = 'translateX(100vw)';
}