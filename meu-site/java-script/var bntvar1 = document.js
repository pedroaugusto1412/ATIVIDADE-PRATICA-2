var bntvar1 =   document.getElementById('bnt1');
function cor1(){
    if(bntvar1.style.color =="red"){
        bntvar1.style.color = "grey"
    }
    else{
        bntvar1.style.color = "red"
    }
}
var bntvar2 =   document.getElementById('bnt2');
function cor2(){
    if(bntvar2.style.color =="red"){
        bntvar2.style.color = "grey"
    }
    else{
        bntvar2.style.color = "red"
    }
}
<script>
function curtir(id) {
    let elemento = document.getElementById("like" + id);
    let valor = parseInt(elemento.innerText);
    elemento.innerText = valor + 1;
}
</script>