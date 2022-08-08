const { feedback } = require('laravel-mix/src/Log');

require('./bootstrap');

//pop-up card
const popup = document.querySelector("#confirmation-card") ?? false;
const inputFee = document.querySelector("#fee") ?? false;
const errorFeeMsg = document.querySelector("#errorFeeMsg") ?? false;
const errorCard = document.querySelector("#error-card") ?? false;
const yesBtn = document.querySelector("#yesBtn") ?? false;
const noBtn = document.querySelector("#noBtn") ?? false;

if (popup) {
    yesBtn.onclick = function (){
        popup.style.opacity = 0;
    };
    noBtn.onclick = function (){
        popup.style.opacity = 0;
        inputFee.style.borderColor = "red";
        errorFeeMsg.style.display = "block";
    };
}

if (errorCard) {
    setTimeout(() => {
        errorCard.style.display = "none";
    }, 3000);
    inputFee.style.borderColor = "red";
}