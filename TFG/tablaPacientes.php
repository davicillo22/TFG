<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';


$tituloPagina = 'Patient Table';
error_reporting(1);

if (empty($_GET)) {
    $nhisFound=true;
}
else {
    $nhisFound = isset($_GET["nhisFound"]) ? $_GET["nhisFound"] : true;
}

$disableFiltrar=false;
$disableAgregar=true;
$filtrosActivados=false;
$condicion="";

if (isset($_POST['submit']) || $_POST['submit2']) {


    if(isset($_POST['submit'])){
        unset($_SESSION['condiciones']);
        unset($_SESSION['condicionesTexto']);
        unset($_SESSION['filtros']);
        unset($_SESSION['filtrosTexto']);
        unset($_SESSION['andArray']);
        unset($_SESSION['orArray']);
        unset($_SESSION['andArrayTexto']);
        unset($_SESSION['orArrayTexto']);
        $disableAgregar=false;
        $_SESSION['andArray'] = array();
        $_SESSION['orArray'] = array();
        $_SESSION['andArrayTexto'] = array();
        $_SESSION['orArrayTexto'] = array();
    }

    $columna = $_POST['columna'];
    $operacion = $_POST['operacion'];
    $valor = $_POST['valor'];

    if ($operacion == 'contains') {
        $condicion = "LOWER($columna) LIKE LOWER('%$valor%')";
    } else {
        $condicion = "$columna $operacion '$valor'";
        $condicionTexto = "$columna $operacion $valor";
    }

    if (!isset($_SESSION['filtros'])) {
        $_SESSION['filtros'] = array();
        $_SESSION['filtrosTexto'] = array();
    }


        array_push($_SESSION['filtros'], $condicion);
        array_push($_SESSION['filtrosTexto'], $condicionTexto);

    $filtrosActivados=true;

    //echo "Filtros:";
    //var_dump($_SESSION['filtros']);
}



if (isset($_POST['union']) && isset($_POST['submit2'])) {
    $filtrosActivados=true;
    $disableAgregar=false;
    $union = $_POST['union'];

    if (!isset($_SESSION['condiciones'])) {
        $_SESSION['condiciones'] = array();
        $_SESSION['condicionesTexto'] = array();
    }




    $condicion = implode(" $union ", $_SESSION['filtros']);
    array_push($_SESSION['condiciones'], $condicion);
    $condicionTexto = implode(" $union ", $_SESSION['filtrosTexto']);
    array_push($_SESSION['condicionesTexto'], $condicionTexto);

    unset($_SESSION['filtros']);
    unset($_SESSION['filtrosTexto']);
}

//echo "Condiciones: ";
//var_dump($_SESSION['condiciones']);
if (isset($_SESSION['condiciones']) && isset($_POST['submit2'])) {
    if ($_POST['union'] == "and") {
        array_push($_SESSION['andArray'], $condicion);
        array_push($_SESSION['andArrayTexto'], $condicionTexto);
    } else if ($_POST['union'] == "or") {
        array_push($_SESSION['orArray'], $condicion);
        array_push($_SESSION['orArrayTexto'], $condicionTexto);
    }
    if (count($_SESSION['andArray']) > 0) {
        $condicionAnd = implode(" AND ", $_SESSION['andArray']);
        $condicionAndTexto = implode(" y ", $_SESSION['andArrayTexto']);
    }
    if (count($_SESSION['orArray']) > 0) {
        $condicionOr = implode(" OR ", $_SESSION['orArray']);
        $condicionOrTexto = implode(" o ", $_SESSION['orArrayTexto']);
    }
    if (count($_SESSION['andArray']) > 0 && count($_SESSION['orArray']) > 0) {
        if($_POST['union'] == "or"){
            $condicion = $condicionAnd . ' OR ' . $condicionOr;
            $condicionTexto = $condicionAndTexto . ' o ' . $condicionOrTexto;
        }
        if($_POST['union'] == "and"){
            $condicion = $condicionAnd . ' AND ' . $condicionOr;
            $condicionTexto = $condicionAndTexto . ' y ' . $condicionOrTexto;
        }
    } else if (count($_SESSION['andArray']) > 0 && count($_SESSION['orArray']) == 0) {
        $condicion = implode(" AND ", $_SESSION['andArray']);
        $condicionTexto = implode(" y ", $_SESSION['andArrayTexto']);
    } else if (count($_SESSION['orArray']) > 0 && count($_SESSION['andArray']) == 0) {
        $condicion = implode(" OR ", $_SESSION['orArray']);
        $condicionTexto = implode(" o ", $_SESSION['orArrayTexto']);
    } else if (empty($condicion)) {
        $condicion = '1=1';
    }
}

//conectamos con la bbdd
    $conn = mysqli_connect("localhost", "root", "", "bbdd");

// construir consulta SQL
    if (isset($_POST['borrar'])) {
        $sqlFiltered = "SELECT * FROM patients";
        unset($_SESSION['filtros']);
        unset($_SESSION['condiciones']);
        unset($_SESSION['filtrosTexto']);
        unset($_SESSION['condicionesTexto']);
        unset($condicionAnd);
        unset($condicionOr);
        unset($condicionAndTexto);
        unset($condicionOrTexto);
    } else if ($filtrosActivados) {
        $sqlFiltered = "SELECT * FROM patients WHERE $condicion";
    } else
        $sqlFiltered = "SELECT * FROM patients";
var_dump($sqlFiltered);

// ejecutar consulta
    $resultFiltered = $conn->query($sqlFiltered);

//Texto de ayuda para mostrar la consulta creada a partir de los filtros seleccionados
    if ($sqlFiltered == "SELECT * FROM patients")
        $textoConsulta = "Mostrar todos los pacientes";
    else {
        var_dump($condicionTexto);
        $textoConsulta = "Mostrar pacientes con " . $condicionTexto;
    }


// Close the connection

//check nhis
    mysqli_close($conn);
    $textoBusqueda = "Introduzca el NHIS a buscar";
    $colorSearch = "gray";
    if (!$nhisFound) {
        $textoBusqueda = "NHIS no encontrado";
        $colorSearch = "red";
    }

    $contenidoPrincipal = <<<EOS
<link rel="stylesheet" href="css/tableStyle.css">

<style>
		/* Estilo para el placeholder del input text */
		::-webkit-input-placeholder { /* Para navegadores basados en Webkit */
			color: $colorSearch;
		}
		:-moz-placeholder { /* Para navegadores basados en Mozilla Firefox */
			color: $colorSearch;
		}
		::-moz-placeholder { /* Para navegadores basados en Mozilla Firefox */
			color: $colorSearch;
		}
		:-ms-input-placeholder { /* Para navegadores basados en Microsoft Edge */
			color:  $colorSearch;
		}
	</style>
	<div style="width: auto; height: 50px; margin: auto; margin-top: 40px; margin-bottom: -75px;""> 
	
    <form class="search-container"  action="searchPatient.php" method="post">
  
        <input  type="text" name="nhis" id="idInput" placeholder='$textoBusqueda'>
        <button id="searchBtn">Search</button>
    </form>

</div> 
<div style="width: 1500px; height: 466px; overflow: auto; margin: 0 auto; margin-top: 40px; margin-bottom: -480px;">
  <a class='btn btn-success btn-lg' href='addPatient.php'>A??adir Paciente</a>
  </div>

EOS;


    $addPatientButton = "<div style='width: 1500px; height: 60px; overflow: auto; margin: 0 auto; margin-top: 15px;'>
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
        $sql .= " ORDER BY " . $sort_col . " " . $sort_order;
    }

// Execute the query
    if (!$filtrosActivados)
        $result = mysqli_query($conn, $sql);
    else
        $result = $resultFiltered;

// Check if the query was successful
    if (mysqli_num_rows($result) > 0) {
        $tabla .= <<<EOS
        <div style="width: 1500px; height: 466px; overflow: auto; margin: 0 auto; margin-top: 80px; outline: 3px solid black;">
        EOS;
        $tabla .= "<table style='font-size: 16px'>";
        $tabla .= "<tr>";

        // Get the column names
        $column_names = mysqli_fetch_fields($result);
        foreach ($column_names as $column_name) {
            // Check if this is the current sort column
            if ($column_name->name == $sort_col) {
                // Switch the sort order
                $sort_order = ($sort_order == 'asc') ? 'desc' : 'asc';
                // Add sorting link with arrow icon
                $tabla .= "<th ><a href='?sort_col=" . $column_name->name . "&sort_order=" . $sort_order . "'>" . $column_name->name . " <i class='fa fa-arrow-" . ($sort_order == 'asc' ? 'up' : 'down') . "'></i></a></th>";
            } else {
                // Add sorting link without arrow icon
                $tabla .= "<th><a href='?sort_col=" . $column_name->name . "&sort_order=asc'>" . $column_name->name . "</a></th>";
            }
        }

        $tabla .= "</tr>";

        // Loop through the results and print each row
        while ($row = mysqli_fetch_assoc($result)) {
            $tabla .= "<tr>";
            $i = 0;
            foreach ($column_names as $column_name) {
                if ($i == 0) {
                    $tabla .= "<td><a href='searchPatient.php?id=" . $row[$column_name->name] . "'>" . $row[$column_name->name] . "</a></td>";
                } else {
                    $tabla .= "<td>" . $row[$column_name->name] . "</td>";
                }
                $i++;
            }
            $tabla .= "</tr>";
        }

        $tabla .= "</table>";
    } else {
        $disableAgregar = false;
        $tabla .= "<h3 style='margin-left: 39%; padding: 200px'>0 resultados</h3>";
    }

// Close the connection
    mysqli_close($conn);


    $contenidoPrincipal .= $tabla;
    $contenidoPrincipal .= "</div>";

    $contenidoPrincipal .= <<<EOS
<link rel="stylesheet" href="css/filterStyle.css">
<div>
<h3 style="margin-left: 30% " >Filtrar Pacientes</h3>
<h4 style="margin-left: 30% ">Consulta: $textoConsulta</h4>
<form  method="post" action="tablaPacientes.php">
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
    <input style="height: 2%;" type="text"  name="valor" required>
    <input style="margin-right: 20px; margin-left: 10px"  type="submit" name="submit" value="Filtrar">
    
        <select name="union">
        <option value="and">Y</option>
        <option value="or">??</option>
    </select>
EOS;
    if ($disableAgregar) {
        $contenidoPrincipal .= <<<EOS
    <input style="background-color: gray; margin-left: 10px" type="submit" name="submit2" value="Agregar filtro" disabled>
    <input style="background-color: gray; margin-left: 10px" type="submit" name="borrar" value="Borrar" disabled formnovalidate>
    EOS;
    } else
        $contenidoPrincipal .= <<<EOS
    <input style="margin-left: 10px" type="submit" name="submit2" value="Agregar filtro">
    <input style="margin-left: 10px"  type="submit" name="borrar" value="Borrar" formnovalidate>
    EOS;

    $contenidoPrincipal .= <<<EOS
</form> 


</div>
</body>
EOS;



require __DIR__.'/includes/layout.php';
