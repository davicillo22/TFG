function actualizarTabla() {
    // Crear un objeto XMLHttpRequest
    var xhttp = new XMLHttpRequest();

    // Definir la función de respuesta
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Actualizar la tabla con los nuevos datos
            document.getElementById("tabla").innerHTML = this.responseText;
        }
    };

    // Enviar la petición al servidor
    xhttp.open("GET", "actualizarTabla.php", true);
    xhttp.send();
}