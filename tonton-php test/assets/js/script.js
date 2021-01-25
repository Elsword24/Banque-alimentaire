var burger = document.querySelector('#burger');
if (burger) {

    burger.onclick = function (ev) {
        var target = ev.currentTarget,
            nav = document.querySelector('nav');
        if (target.classList.contains('burger-closed')) {
            target.classList.remove('burger-closed');
            nav.classList.remove('display-nav');
        } else {
            target.classList.add('burger-closed');
            nav.classList.add('display-nav');
        }
    }
}

var messageStatement = document.querySelector('.message-statement');
if (messageStatement) {
    setTimeout(function(){
        messageStatement.parentElement.removeChild(messageStatement);
    }, 3000);
}