<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Patient Table';

$contenidoPrincipal= <<<EOS
<link rel="stylesheet" href="css/tableStyle.css">
<div style="width: 1500px; height: 50px; margin: 0 auto; margin-top: 50px;">
	  
    <form class="search-container" action="searchPatient.php" method="post">
        <input type="text" id="idInput" placeholder="Introduzca el NHIS">
        <button id="searchBtn">Search</button>
    </form>

</div>
<div style="width: 1500px; height: 600px; overflow: auto; margin: 0 auto; margin-top: 30px; outline: 2px solid black;">
EOS;

$tabla = "";

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "bbdd");

// Check the connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Write the SQL query
$sql = "SELECT * FROM patients";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
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

  $tabla .= "</table>";
} else {
  $tabla .= "0 results";
}




// Close the connection
mysqli_close($conn);

$contenidoPrincipal .= $tabla;
$contenidoPrincipal .= "</div>";


require __DIR__.'/includes/layout.php';