function signUp() {
    document.getElementById('modal-container').classList.add('right-panel-active');
    document.getElementById('overlay-image').src = 'https://i.pinimg.com/564x/c0/99/ac/c099ac0bb14e3fd693285cd28938ca76.jpg';
    document.getElementById('close-button').style.color = "#000"
};

function signIn() {
    document.getElementById('modal-container').classList.remove('right-panel-active');
    document.getElementById('overlay-image').src = 'https://i.pinimg.com/564x/c1/6e/3c/c16e3c093406cf65f93fe527244cec63.jpg';
    document.getElementById('close-button').style.color = "#fff"
};

function getSearchInput() {
    let input = document.getElementById("search").value;
    input = input.toLowerCase();
    console.log(input);
}

function openModal() {
    document.getElementById('user-modal').style.display = "flex";
};

function closeModal() {
    document.getElementById('user-modal').style.display = "none";
};

function OpenModal() {
    document.getElementById('user-modal').style.display = "flex";
};

function CloseModal() {
    document.getElementById('user-modal').style.display = "none";
};