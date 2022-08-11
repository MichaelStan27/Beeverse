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
const collections = document.querySelector("#collections") ?? false;
const collectionBtn = document.querySelector("#collectionBtn") ?? false;
const topupBtn = document.querySelector("#topupBtn") ?? false;
const topup = document.querySelector("#topup") ?? false;
const clickBtn = document.querySelector("#clickBtn") ?? false;
const setting = document.querySelector("#setting") ?? false;
const settingBtn = document.querySelector("#settingBtn") ?? false;
const wishlists = document.querySelector("#wishlists") ?? false;
const wishlistBtn = document.querySelector("#wishlistBtn") ?? false;
const confirm_hidden_card = document.querySelector("#confirm_hidden_card") ?? false;
const confirm_visible_card = document.querySelector("#confirm_visible_card") ?? false;


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

if(collectionBtn){
    collectionBtn.onclick = function (){
        if(collections.style.display === 'block'){
            collections.style.display = 'none';
            collectionBtn.style.backgroundColor = 'white';
            collectionBtn.style.color = 'black';
        }
        else{
            topup.style.display = 'none';
            topupBtn.style.backgroundColor = 'white';
            topupBtn.style.color = 'black';
            collections.style.display = 'block';
            collectionBtn.style.backgroundColor = 'black';
            collectionBtn.style.color = 'white';
            setting.style.display = 'none';
            settingBtn.style.backgroundColor = 'white';
            settingBtn.style.color = 'black';
            wishlists.style.display = 'none';
            wishlistBtn.style.backgroundColor = 'white';
            wishlistBtn.style.color = 'black';
        }
    };
}

if(topupBtn){
    topupBtn.onclick = function (){
        if(topup.style.display === 'block'){
            topup.style.display = 'none';
            topupBtn.style.backgroundColor = 'white';
            topupBtn.style.color = 'black';
        }
        else{
            collections.style.display = 'none';
            collectionBtn.style.backgroundColor = 'transparent';
            collectionBtn.style.color = 'black';
            topup.style.display = 'block';
            topupBtn.style.backgroundColor = 'black';
            topupBtn.style.color = 'white';
            setting.style.display = 'none';
            settingBtn.style.backgroundColor = 'white';
            settingBtn.style.color = 'black';
            wishlists.style.display = 'none';
            wishlistBtn.style.backgroundColor = 'white';
            wishlistBtn.style.color = 'black';
        }
    };
}

if(settingBtn){
    settingBtn.onclick = function (){
        if(setting.style.display === 'block'){
            setting.style.display = 'none';
            settingBtn.style.backgroundColor = 'white';
            settingBtn.style.color = 'black';
        }
        else{
            topup.style.display = 'none';
            topupBtn.style.backgroundColor = 'white';
            topupBtn.style.color = 'black';
            collections.style.display = 'none';
            collectionBtn.style.backgroundColor = 'transparent';
            collectionBtn.style.color = 'black';
            setting.style.display = 'block';
            settingBtn.style.backgroundColor = 'black';
            settingBtn.style.color = 'white';
            wishlists.style.display = 'none';
            wishlistBtn.style.backgroundColor = 'white';
            wishlistBtn.style.color = 'black';
        }
    };
}

if(wishlistBtn){
    wishlistBtn.onclick = function (){
        if(wishlists.style.display === 'block'){
            wishlists.style.display = 'none';
            wishlistBtn.style.backgroundColor = 'white';
            wishlistBtn.style.color = 'black';
        }
        else{
            topup.style.display = 'none';
            topupBtn.style.backgroundColor = 'white';
            topupBtn.style.color = 'black';
            collections.style.display = 'none';
            collectionBtn.style.backgroundColor = 'transparent';
            collectionBtn.style.color = 'black';
            setting.style.display = 'none';
            settingBtn.style.backgroundColor = 'white';
            settingBtn.style.color = 'black';
            wishlists.style.display = 'block';
            wishlistBtn.style.backgroundColor = 'black';
            wishlistBtn.style.color = 'white';
        }
    }
}

if (confirm_hidden_card){
    xBtn.onclick = function (){
        confirm_hidden_card.style.display = "none";
    }
    yesBtn.onclick = function (){
        confirm_hidden_card.style.display = "none";
    };
    noBtn.onclick = function (){
        confirm_hidden_card.style.display = "none";
    };
}

if (confirm_visible_card){
    xBtn.onclick = function (){
        confirm_visible_card.style.display = "none";
    }
    yesBtn.onclick = function (){
        confirm_visible_card.style.display = "none";
    };
    noBtn.onclick = function (){
        confirm_visible_card.style.display = "none";
    };
}

if (notifCard) {
    setTimeout(() => {
        notifCard.style.display = "none";
    }, 3000);
    inputFee.style.borderColor = "red";
}

