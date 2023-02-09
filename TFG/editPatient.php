<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Search-Patient';

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "bbdd");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$hayResultado=true;
$contenidoPrincipal="";


$id = $_GET["id"];
if($id==null){
    header('location: tablaPacientes.php');

}
$sql = "SELECT * FROM patients WHERE NHIS = $id";


$result = mysqli_query($conn, $sql);


$tabla = "";

if (mysqli_num_rows($result) > 0) {
    $tabla .= "<table>";
    $tabla .= "<tr>";

    // Get the column names
    $column_names = mysqli_fetch_fields($result);
    foreach ($column_names as $column_name) {
        $tabla .= "<th>" . $column_name->name . "</th>";
    }

    $tabla .= "</tr>";

    // Loop through the results and print each row
    while ($row = mysqli_fetch_assoc($result)) {
        $tabla .= "<tr>";
        foreach ($column_names as $column_name) {
            $tabla .= "<td>" . $row[$column_name->name] . "</td>";
        }
        $tabla .= "</tr>";
    }

    $sql = "SELECT * FROM patients WHERE NHIS = $id";


    $result = mysqli_query($conn, $sql);
    //inputs para modificar cada campo
    while ($row = mysqli_fetch_assoc($result)) {


            $tabla .=<<<EOS

<form method= "post" enctype="application/x-www-form-urlencoded" action="procesarEditPatient.php"><tr>
            <td>$id</td>
            <td><input type="date"  min="1910-01-01" max="2022-12-31" name="fechacir" /></td>
            <td><input type="number" min="0" max="120" name="edad" /></td>
            <td><input type="number" min="1" max="4" name="etnia" /></td>
            <td><input type="number" min="0" max="3" name="obeso" /></td>
            <td><input type="number" min="1" max="3" name="hta" /></td>
            <td><input type="number" min="1" max="3" name="dm" /></td>
            <td><input type="number" min="0" max="5" name="tabaco" /></td>
            <td><input type="number" min="1" max="2" name="hereda" /></td>
            <td><input type="number" min="1" max="3" name="tactor" /></td>
            <td><input type="number" min="0" max="999" step="any" name="psapre" /></td>
            <td><input type="number" min="0" max="1" step="any" name="psalt" /></td>
            <td><input type="number" min="0" max="999" step="any" name="tduppre" /></td>
            <td><input type="number" min="1" max="2" name="ecotr" /></td>
            <td><input type="number" min="0" max="999" name="nbiopsia" /></td>
            <td><input type="number" min="1" max="2" name="histo" /></td>
            <td><input type="number" min="0" max="5" name="gleason1" /></td>
            <td><input type="number" min="1" max="3" name="ncilpos" /></td>
            <td><input type="number" min="1" max="2" name="bilat" /></td>
            <td><input type="number" min="0" max="100" name="porcent" /></td>
            <td><input type="number" min="1" max="3" name="iperin" /></td>
            <td><input type="number" min="1" max="3" name="ilinf" /></td>
            <td><input type="number" min="1" max="3" name="ivascu" /></td>
            <td><input type="number" min="1" max="3" name="tnm1" /></td>
            <td><input type="number" min="1" max="2" name="histo2" /></td>
            <td><input type="number" min="0" max="5" name="gleason2" /></td>
            <td><input type="number" min="1" max="2" name="bilat2" /></td>
            <td><input type="number" min="1" max="4" name="localiz" /></td>
            <td><input type="number" min="1" max="2" name="multifoc" /></td>
            <td><input type="number" min="1" max="100" name="volumen" /></td>
            <td><input type="number" min="1" max="2" name="extracap" /></td>
            <td><input type="number" min="1" max="3" name="vvss" /></td>
            <td><input type="number" min="1" max="3" name="iperin2" /></td>
            <td><input type="number" min="1" max="3" name="ilinf2" /></td>
            <td><input type="number" min="1" max="3" name="ivascu2" /></td>
            <td><input type="number" min="1" max="3" name="pinag" /></td>
            <td><input type="number" min="1" max="3" name="margen" /></td>
            <td><input type="number" min="1" max="5" name="tnm2" /></td>
            <td><input type="number" min="0" max="999" step="any" name="psapos" /></td>
            <td><input type="number" min="1" max="2" name="rtpadyu" /></td>
            <td><input type="number" min="0" max="999" name="rtpmes" /></td>
            <td><input type="number" min="1" max="3" name="rbq" /></td>
            <td><input type="number" min="0" max="999" name="trbq" /></td>
            <td><input type="number" min="0" max="999" name="tdupli" /></td>
            <td><input type="number" min="0" max="999" name="t1mtx" /></td>
            <td><input type="date" name="fechafin" min="1910-01-01" max="2022-12-31" /></td>
            <td><input type="number" min="1" max="2" name="fallec" /></td>
            <td><input type="number" min="0" max="999" name="tsuperv" /></td>
            <td><input type="number" min="0" max="999" step="any" name="psafin" /></td>
            <td><input type="number" min="0" max="999" name="tsegui" /></td>
            <td><input type="text" name="notas"/></td>
            <td><input type="number" min="0" max="999" name="capras" /></td>
            <td><input type="number" min="0" max="1" name="ra" /></td>
            <td><input type="number" min="0" max="2" name="pten" /></td>
            <td><input type="number" min="0" max="1" name="erg" /></td>
            <td><input type="number" min="0" max="2" name="ki67" /></td>
            <td><input type="number" min="0" max="1" name="spink1" /></td>
            <td><input type="number" min="0" max="1" name="cmyc" /></td>
         
</tr>
<tr >
<td class="fin"><input class="btn btn-success btn-lg" type="submit" name="Editado" value="Guardar Datos" /></td>
<td class="fin"><a href='searchPatient.php?id=$id' class='btn btn-success btn-lg'>Volver</a></td>
</tr>
</form>
<link rel="stylesheet" href="css/tableStyle.css">
EOS;
    }

    $tabla .= "</table>";
} else {
    $tabla .= "<h1>0 results</h1>";
    $tabla .= "<a href='tablaPacientes.php' class='btn btn-success btn-lg'>Volver</a>";
    $hayResultado=false;
}

// Close the connection
mysqli_close($conn);
if($hayResultado){
    $contenidoPrincipal.= <<<EOS


<div style="width: 1500px; height: 600px; overflow: auto; margin: 0 auto; margin-top: 30px; outline: 2px solid black;">
EOS;
}
$contenidoPrincipal .= $tabla;
$contenidoPrincipal .= "</div>";

require __DIR__.'/includes/layout.php';