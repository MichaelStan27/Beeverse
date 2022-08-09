const { feedback } = require('laravel-mix/src/Log');

require('./bootstrap');

//pop-up card
const popup = document.querySelector("#confirmation-card") ?? false;
const inputFee = document.querySelector("#fee") ?? false;
const errorFeeMsg = document.querySelector("#errorFeeMsg") ?? false;
const notifCard = document.querySelector("#notif-card") ?? false;
const buySendCard = document.querySelector("#buySend-card") ?? false;
const yesBtn = document.querySelector("#yesBtn") ?? false;
const noBtn = document.querySelector("#noBtn") ?? false;

if (popup) {
    yesBtn.onclick = function (){
        popup.style.display = "none";
    };
    noBtn.onclick = function (){
        popup.style.display = "none";
        inputFee.style.borderColor = "red";
        errorFeeMsg.style.display = "block";
    };
}

if (notifCard) {
    setTimeout(() => {
        notifCard.style.display = "none";
    }, 3000);
    inputFee.style.borderColor = "red";
}

if (buySendCard) {
    xBtn.onclick = function (){
        buySendCard.style.display = "none";
    }
    buyBtn.onclick = function (){
        buySendCard.style.display = "none";
    };
    sendBtn.onclick = function (){
        buySendCard.style.display = "none";
    };
}