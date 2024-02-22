function tekstKastiLugemine(){
    let nimi=document.getElementById("nimi");
    let vastus=document.getElementById("vastus");

    vastus.innerHTML="Tere päevast, "+nimi.value;
}
function puhasta(){
    let vastus=document.getElementById("vastus");
    vastus.innerHTML=" ";
    vastus2.innerHTML=" ";
    vastus3.innerHTML=" ";
    vastus4.innerHTML=" ";
    pilt.src="";
}
// radionupp
function radioLugemine(){
    let vastus2=document.getElementById("vastus2");
    let targv23=document.getElementById("targv23");
    let logitgv23=document.getElementById("logitgv23");
    let pilt=document.getElementById("pilt");

    if(targv23.checked){
        vastus2.innerHTML="Sa oled "+targv23.value+" rühmast";
        pilt.src="img/1.png";
    }
    else if (logitgv23.checked) {
        vastus2.innerHTML ="Sa oled "+logitgv23.value+" rühmast";
        pilt.src="img/2.png";
    } else {
        vastus2.innerHTML = "Palun vali midagi";
        pilt.src="img/3.png";
    }

}

//checkbox
function checkboxValik(){
    let vastus3=document.getElementById("vastus3");
    let andmebaasid=document.getElementById("andmebaasid");
    // ALT + J - valib mitu elemente korraga
    let matemaatika=document.getElementById("matemaatika");
    let programeerimine=document.getElementById("programeerimine");

    let aine="";
    if(andmebaasid.checked){
        aine+=andmebaasid.value+", ";
    }
    if(matemaatika.checked){
        aine+=matemaatika.value+", ";
    }
    if(programeerimine.checked){
        aine+=programeerimine.value+", ";
    }
    vastus3.innerHTML="Lemmikud on "+aine;
}

function selectOptionValik(){
    let vastus4=document.getElementById("vastus4");
    let kodu=document.getElementById("kodu");
    let km=document.getElementById("km");

    if (kodu.selectedIndex!==0){
        vastus4.innerHTML="Valitud linn on "+kodu.value+ ", sinu koduni on "+km.value +" km";
    } else {
        vastus4.innerHTML = "Palun tee oma valik";
    }


}

function varvValik(){
    let varv1=document.getElementById("varv1");
    vastus.style.color=varv1.value;
    vastus2.style.color=varv1.value;
    vastus3.style.color=varv1.value;
    vastus4.style.color=varv1.value;

}








