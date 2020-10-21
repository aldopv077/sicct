function Letras(){
    //alert("Solo letras");
    document.getElementById('tallasnum').style.display="none";
    document.getElementById('tallasletras').style.display="block";
}

function Numeros(){
    //alert("Solo números");
    
    document.getElementById('tallasletras').style.display="none";
    document.getElementById('tallasnum').style.display="block";
}

function TallasS(){
    document.getElementById('Tallas').style.display="block";
}


function TallasN(){
    document.getElementById('Tallas').style.display="none";
}

function AccesoriosS(){
    document.getElementById('Accesorios').style.display="block";
}

function AccesoriosN(){
    document.getElementById('Accesorios').style.display="none";
}


function habilitar(){
    var Ech = document.getElementById('chbExChica').checked;
    var Ch = document.getElementById('chbChica').checked;
    var M = document.getElementById('chbMediana').checked;
    var G = document.getElementById('chbGrande').checked;
    var Eg = document.getElementById('chbExGrande').checked;
    var J = document.getElementById('chbJumbo').checked;
    var EXL = document.getElementById('chbEXL').checked;
    var E1XL = document.getElementById('chbE1XL').checked;
    var E2XL = document.getElementById('chbE2XL').checked;
    var E3XL = document.getElementById('chbE3XL').checked;
    
    if(Ech){
        document.getElementById('txtPiezasEch').disabled=false;
    }else{
        document.getElementById('txtPiezasEch').disabled=true;
    }
    
    if(Ch){
        document.getElementById('txtPiezasCh').disabled=false;
    }else{
        document.getElementById('txtPiezasCh').disabled=true;
    }
    
    if(M){
        document.getElementById('txtPiezasM').disabled=false;
    }else{
        document.getElementById('txtPiezasM').disabled=true;
    }
    
    if(G){
        document.getElementById('txtPiezasG').disabled=false;
    }else{
        document.getElementById('txtPiezasG').disabled=true;
    }
    
    if(Eg){
        document.getElementById('txtPiezasEg').disabled=false;
    }else{
        document.getElementById('txtPiezasEg').disabled=true;
    }
    
    if(J){
        document.getElementById('txtPiezasJ').disabled=false;
    }else{
        document.getElementById('txtPiezasJ').disabled=true;
    }
    
    if(EXL){
        document.getElementById('txtPiezasXL').disabled=false;
    }else{
        document.getElementById('txtPiezasXL').disabled=true;
    }
    
    if(E1XL){
        document.getElementById('txtPiezas1XL').disabled=false;
    }else{
        document.getElementById('txtPiezas1XL').disabled=true;
    }
    
    if(E2XL){
        document.getElementById('txtPiezas2XL').disabled=false;
    }else{
        document.getElementById('txtPiezas2XL').disabled=true;
    }      
    
    if(E3XL){
        document.getElementById('txtPiezas3XL').disabled=false;
    }else{
        document.getElementById('txtPiezas3XL').disabled=true;
    }
}