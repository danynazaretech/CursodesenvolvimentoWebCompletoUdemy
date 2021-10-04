
var altura = 0
var largura = 0
var vidas = 1
var tempo = 15


var criaMosquitoTempo = 1500

nivel = window.location.search
nivel = nivel.replace('?', '')

if(nivel === 'normal'){
    criaMosquitoTempo = 1500
}
else if(nivel === 'dificil'){
    criaMosquitoTempo = 1000
}
else if( nivel === 'chucknorris'){
    criaMosquitoTempo = 750
}

function ajustaJanela(){
    altura = window.innerHeight
    largura = window.innerWidth

    // console.log(altura, largura)
}

ajustaJanela() 

var cronometro = setInterval(function(){
    tempo--
    if(tempo < 0){
        clearInterval(cronometro)
        clearInterval(criaMosca)

        alert('Vitoria')
        window.location.href = 'vitoria.html'

    }
    else{
        document.getElementById('cronometro').innerHTML = tempo
    }
    
},1000)

function posRandomica(){

    if(document.getElementById('mosquito')){

        document.getElementById('mosquito').remove()

        if(vidas > 3){
            
            window.location.href = 'fim_jogo.html'
        }else{

            document.getElementById('v'+vidas).src = "img/coracao_vazio.png"

            vidas++;
        }
    }
    var posX = Math.floor(Math.random() * largura) - 90


    var posY = Math.floor(Math.random() * altura) - 90

    posX = posX < 0 ? 0 : posX
    posY = posY < 0 ? 0 : posY

    console.log(posX, posY)

    
    var mosquito = document.createElement('img')
    mosquito.src = 'img/mosca.png'
    mosquito.className = tamanhoRandom() + ' ' +  ladoAleatorio()
    mosquito.style.left = posX+ 'px'
    mosquito.style.top =posY+ 'px'
    mosquito.style.position = 'absolute'
    mosquito.id = 'mosquito'

    mosquito.onclick = function(){
        this.remove()
    }

    document.body.appendChild(mosquito)
    console.log(ladoAleatorio())
}

function tamanhoRandom(){
    var classe = Math.floor(Math.random() *3)


    switch(classe){
        case 0:
            return 'mosquito1'
        case 1:
            return 'mosquito2'
        case 2:
            return 'mosquito3'


    }
}

function ladoAleatorio(){
    var classe = Math.floor(Math.random() *2)


    switch(classe){
        case 0:
            return 'ladoA'
        case 1:
            return 'ladoB'



    }
}