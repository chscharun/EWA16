

function powerWithAjax(){
    var request = new XMLHttpRequest();		                    // RequestObject anlegen
    var zahl = document.getElementById('number').value;
    request.open("GET", "ajaxexample.php?number="+encodeURI(zahl));    // URL für HTTP-GET festlegen
    request.onreadystatechange = function(){
        processData(request); // Callback-Handler zuordnen
    };
    request.send();
}


function processData(request) {
    if(request.readyState == 4) {	// Uebertragung = DONE
        if (request.status == 200) {	// HTTP-Status = OK
            if(request.responseText != null)
                process(request.responseText);// Daten verarbeiten
            else error ("Dokument ist leer");
        } else error ("Uebertragung fehlgeschlagen");
    } else {};				// Uebertragung laeuft noch
}

// Text ins DOM einfuegen
function process (intext) {
    var erg = JSON.parse(intext);
    console.log(erg.square_of);
    var myText = document.getElementById("myText");
    var para = document.createElement('p');
    var textnode = document.createTextNode(intext);
    para.appendChild(textnode);
    myText.appendChild(para);
    para.onclick = function () {
        this.parentNode.removeChild(this);
    };

}