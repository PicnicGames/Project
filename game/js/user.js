/*=============== OPEN MODAL ===============*/
function openModal() {
    document.getElementById('user-modal').style.display = 'flex'
 }
 
 /*=============== CLOSE MODAL ===============*/
 function closeModal() {
    document.getElementById('user-modal').style.display = 'none'
 }

/*=============== OPEN SIGNUP ===============*/
function signUp() {
    document.getElementById('modal-container').classList.add('right-panel__active');
    document.getElementById('overlay-image').src = 'https://i.pinimg.com/564x/c0/99/ac/c099ac0bb14e3fd693285cd28938ca76.jpg';
    document.getElementById('close').style.color = "#000"
};

/*=============== OPEN SIGNIN ===============*/
function signIn() {
    document.getElementById('modal-container').classList.remove('right-panel__active');
    document.getElementById('overlay-image').src = 'https://i.pinimg.com/564x/c1/6e/3c/c16e3c093406cf65f93fe527244cec63.jpg';
    document.getElementById('close').style.color = "#fff"
};

