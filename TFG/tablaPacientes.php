<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Patient Table';

if (empty($_GET)) {
    $nhisFound=true;
}
else {
    $nhisFound = isset($_GET["nhisFound"]) ? $_GET["nhisFound"] : true;
}

$contenidoPrincipal= <<<'EOS'
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <select name="columna">
        <option value="fechacir">Fechacir</option>
        <option value="edad">Edad</option>
        <option value="etnia">Etnia</option>
        <option value="obeso">Obeso</option>
        <option value="hta">Hta</option>
        <option value="dm">Dm</option>
        <option value="tabaco">Tabaco</option>
        <option value="hereda">Hereda</option>
        <option value="tactor">Tactor</option>
        <option value="psapre">Psapre</option>
        <option value="psalt">Psalt</option>
        <option value="tduppre">Tduppre</option>
        <option value="ecotr">Ecotr</option>
        <option value="nbiopsia">Nbiopsia</option>
        <option value="histo">Histo</option>
        <option value="gleason1">Gleason1</option>
        <option value="ncilpos">Ncilpos</option>
        <option value="bilat">Bilat</option>
        <option value="porcent">Porcent</option>
        <option value="iperin">Iperin</option>
        <option value="ilinf">Ilinf</option>
        <option value="ivascu">Ivascu</option>
        <option value="tnm1">Tnm1</option>
        <option value="histo2">Histo2</option>
        <option value="gleason2">Gleason2</option>
        <option value="bilat2">Bilat2</option>
        <option value="localiz">Localiz</option>
        <option value="multifoc">Multifoc</option>
        <option value="volumen">Volumen</option>
        <option value="extracap">Extracap</option>
        <option value="vvss">Vvss</option>
        <option value="iperin2">Iperin2</option>
        <option value="ilinf2">Ilinf2</option>
        <option value="ivascu2">Ivascu2</option>
        <option value="pinag">Pinag</option>
        <option value="margen">Margen</option>
        <option value="tnm2">Tnm2</option>
        <option value="psapos">Psapos</option>
        <option value="rtpadyu">Rtpadyu</option>
        <option value="rtpmes">Rtpmes</option>
        <option value="rbq">Rbq</option>
        <option value="trbq">Trbq</option>
        <option value="tdupli">Tdupli</option>
        <option value="t1mtx">T1mtx</option>
        <option value="fechafin">Fechafin</option>
        <option value="fallec">Fallec</option>
        <option value="tsuperv">Tsuperv</option>
        <option value="psafin">Psafin</option>
        <option value="tsegui">Tsegui</option>
        <option value="notas">Notas</option>
        <option value="capra_s">Capra_s</option>
        <option value="ra">Ra</option>
        <option value="pten">Pten</option>
        <option value="erg">Erg</option>
        <option value="ki_67">Ki_67</option>
        <option value="spink1">Spink1</option>
        <option value="c_myc">C_myc</option>
    </select>
    <select name="operacion">
        <option value="=">Igual a</option>
        <option value="!=">Distinto a</option>
        <option value="<">Menor que</option>
        <option value=">">Mayor que</option>
        <option value="contains">Contiene</option>
    </select>
    <input type="text" name="valor">
    <input type="submit" name="submit" value="Filtrar">
</form>
<br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <select name="union">
        <option value="and">Y</option>
        <option value="or">Ó</option>
    </select>
    <input type="submit" name="submit" value="Agregar filtro">
</form>
<br>
EOS;

if (isset($_POST['submit'])) {
    $columna = $_POST['columna'];
    $operacion = $_POST['operacion'];
    $valor = $_POST['valor'];

    if ($operacion == 'contains') {
        $condicion = "LOWER($columna) LIKE LOWER('%$valor%')";
    } else {
        $condicion = "$columna $operacion '$valor'";
    }

    if (!isset($_SESSION['filtros'])) {
        $_SESSION['filtros'] = array();
    }

    array_push($_SESSION['filtros'], $condicion);
}

if (isset($_POST['union'])) {
    $union = $_POST['union'];

    if (!isset($_SESSION['condiciones'])) {
        $_SESSION['condiciones'] = array();
    }

    $condicion = implode(" $union ", $_SESSION['filtros']);
    array_push($_SESSION['condiciones'], $condicion);
    unset($_SESSION['filtros']);
}

if (isset($_SESSION['condiciones'])) {
    $condicion = implode(" AND ", $_SESSION['condiciones']);
} else {
    $condicion = '1=1';
}
//conectamos con la bbdd
$conn = mysqli_connect("localhost", "root", "", "bbdd");

// construir consulta SQL
$sql = "SELECT * FROM patients WHERE $condicion";

// ejecutar consulta
$result = $conn->query($sql);

// manejar resultados - FALTARÍA QUE SE APLIQUEN LOS FILTROS EN LA TABLA

// Close the connection
mysqli_close($conn);

$contenidoPrincipal= <<<EOS
<link rel="stylesheet" href="css/tableStyle.css">
<div style="width: 1500px; height: 50px; margin: 0 auto; margin-top: 50px;">
	  
    <form class="search-container" action="searchPatient.php" method="post">
        <input type="text" name="nhis" id="idInput" placeholder="Introduzca el NHIS a buscar">
        <button id="searchBtn">Search</button>
    </form>

</div>
<div style="width: 1500px; height: 600px; overflow: auto; margin: 0 auto; margin-top: 30px; outline: 2px solid black;">
EOS;
$addPatientButton = "<div style='width: 1500px; height: 60px; overflow: auto; margin: 0 auto; margin-top: 15px; '>
    <a class='btn btn-success btn-lg' href='addPatient.php'>Add Patient</a>
</div>";

$tabla = "";


// Create variables for sorting
$sort_col = isset($_GET['sort_col']) ? $_GET['sort_col'] : '';
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'asc';

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "bbdd");

// Check the connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Write the SQL query
$sql = "SELECT * FROM patients";
if (!empty($sort_col)) {
    $sql .= " ORDER BY ".$sort_col." ".$sort_order;
}

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (mysqli_num_rows($result) > 0) {
  $tabla .= "<table>";
  $tabla .= "<tr>";

    // Get the column names
    $column_names = mysqli_fetch_fields($result);
    foreach ($column_names as $column_name) {
        // Check if this is the current sort column
        if ($column_name->name == $sort_col) {
            // Switch the sort order
            $sort_order = ($sort_order == 'asc') ? 'desc' : 'asc';
            // Add sorting link with arrow icon
            $tabla .= "<th><a href='?sort_col=".$column_name->name."&sort_order=".$sort_order."'>".$column_name->name." <i class='fa fa-arrow-".($sort_order == 'asc' ? 'up' : 'down')."'></i></a></th>";
        } else {
            // Add sorting link without arrow icon
            $tabla .= "<th><a href='?sort_col=".$column_name->name."&sort_order=asc'>".$column_name->name."</a></th>";
        }
    }

    $tabla .= "</tr>";

  // Loop through the results and print each row
  while ($row = mysqli_fetch_assoc($result)) {
    $tabla .= "<tr>";
    $i = 0;
    foreach ($column_names as $column_name) {
        if ($i == 0){
            $tabla .= "<td><a style='color: blue;' href='searchPatient.php?id=" . $row[$column_name->name] . "'>" . $row[$column_name->name] . "</a></td>";
        }
        else{
            $tabla .= "<td>" . $row[$column_name->name] . "</td>";
        }
        $i++;
    }
    $tabla .= "</tr>";
  }

  $tabla .= "</table>";
} else {
  $tabla .= "<div>0 results</div>";
}

// Close the connection
mysqli_close($conn);

if (!$nhisFound){
    $contenidoPrincipal.= "<h3 style='color: red;'>NHIS no encontrado.</h3><br>";

    $contenidoPrincipal.= "</body></html>";
}

$contenidoPrincipal .= $tabla;
$contenidoPrincipal .= "</div>";
$contenidoPrincipal .= $addPatientButton;


require __DIR__.'/includes/layout.php';