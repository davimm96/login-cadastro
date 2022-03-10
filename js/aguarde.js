window.onload = function(){
    setInterval(trocaSlider, 80)
    let b1 = document.querySelector('#b1')
    let b2 = document.querySelector('#b2')
    let b3 = document.querySelector('#b3')
    let b4 = document.querySelector('#b4')
    let b5 = document.querySelector('#b5')
    let n = 0
    
    function trocaSlider(){
        n++
            
        switch(n){
            case 1:
                b1.style.color = 'black';
                b2.style.color = 'orange';
                b3.style.color = 'black';
                b4.style.color = 'black';
                b5.style.color = 'black';
                break;
            case 2:
                b1.style.color = 'black';
                b2.style.color = 'black';
                b3.style.color = 'orange';
                b4.style.color = 'black';
                b5.style.color = 'black';
            break;
            case 3:
                b1.style.color = 'black';
                b2.style.color = 'black';
                b3.style.color = 'black';
                b4.style.color = 'orange';
                b5.style.color = 'black';
            break;
            case 4:
                b1.style.color = 'black';
                b2.style.color = 'black';
                b3.style.color = 'black';
                b4.style.color = 'black';
                b5.style.color = 'orange';
            break;
            case 5:
                b1.style.color = 'orange';
                b2.style.color = 'black';
                b3.style.color = 'black';
                b4.style.color = 'black';
                b5.style.color = 'black';
                n = 0;
            break;
        }
    }
    trocaSlider()  
}