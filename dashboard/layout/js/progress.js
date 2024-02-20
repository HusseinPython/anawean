const ck = document.getElementsByClassName('ck-content')[0];
ck.onblur = function(){
    let data = String(ck.innerHTML);
    content.value = data
}