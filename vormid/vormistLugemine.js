function tekstKastiLugemine(){
    let nimi=document.getElementById("nimi");
    let vastus=document.getElementById("vastus");

    vastus.innerHTML="Tere päevast, "+nimi.value;
}
function puhasta(){
    let vastus=document.getElementById("vastus");
    vastus.innerHTML=" ";
    vastus2.innerHTML=" ";
}
// radionupp
function radioLugemine(){
    let vastus2=document.getElementById("vastus2");
    let targv23=document.getElementById("targv23");
    let logitgv23=document.getElementById("logitgv23");
    if(targv23.checked){
        vastus2.innerHTML="Sa oled "+targv23.value+" rühmast";
    }
    else if (logitgv23.checked) {
        vastus2.innerHTML ="Sa oled "+logitgv23.value+" rühmast";
    } else {
        vastus2.innerHTML = "Palun vali midagi";
    }

}