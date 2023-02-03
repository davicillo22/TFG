<!DOCTYPE html>
<html lang="en">
<head>

     <title>Health - Medical Website Template</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="Tooplate">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/animate.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/tooplate-style.css">

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

     

     

     <!-- MENU -->
     <section class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="index.html" class="navbar-brand"><i class="fa fa-h-square"></i>ígados sin fronteras</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="#TablaPacientes" class="smoothScroll">Tabla de pacientes</a></li>
                         <li><a href="#Calculadora" class="smoothScroll">Calculadora de riesgo</a></li>
                         <li><a href="#FotoPene" class="smoothScroll">Foto de la polla</a></li>
                         <li><a href="#User" class="smoothScroll">Usuarios</a></li>
                         <li><a href="#Contacto" class="smoothScroll">Contacto</a></li>
                         <li class="appointment-btn"><a href="#homeopatia">Cura tu cáncer</a></li>
                    </ul>
               </div>

          </div>
     </section>
		
	
	
	<style>
	  table {
		border-collapse: collapse;
		width: 100%;
		font-family: Arial, sans-serif;
	  }
	  th, td {
		border: 1px solid #6c757d;
		padding: 8px;
		text-align: left;
	  }
	  th {
		background-color: #007bff;
		color: white;
		border-bottom: 1px solid #6c757d;
	  }
	  td {
		background-color: #f2f2f2;
		border-bottom: 1px solid #6c757d;
	  }
		.search-container {
	  display: flex;
	  align-items: center;
	  background-color: #007bff;
	  padding: 10px 20px;
	  border-radius: 5px;
	  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}

	.search-container input[type="text"] {
	  width: 60%;
	  padding: 10px;
	  font-size: 16px;
	  font-family: Arial, sans-serif;
	  border: none;
	  border-radius: 5px 0 0 5px;
	  outline: none;
	}

	.search-container button {
	  width: 40%;
	  padding: 10px;
	  font-size: 16px;
	  font-family: Arial, sans-serif;
	  background-color: white;
	  color: #007bff;
	  border: none;
	  border-radius: 0 5px 5px 0;
	  cursor: pointer;
	}

	.search-container button:hover {
	  background-color: #f2f2f2;
	}
	</style>

	<div style="width: 2100px; height: 50px; margin: 0 auto; margin-top: 50px;">
	  
		<div class="search-container">
	  		  <input type="text" placeholder="Search patients by ID...">
		  <button>Search</button>
		</div>

	</div>
	<div style="width: 2100px; height: 900px; overflow: auto; margin: 0 auto; margin-top: 30px; outline: 2px solid black;">

	  <?php

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
		echo "<table>";
		echo "<tr>";

		// Get the column names
		$column_names = mysqli_fetch_fields($result);
		foreach ($column_names as $column_name) {
		  echo "<th>" . $column_name->name . "</th>";
		}

		echo "</tr>";

		// Loop through the results and print each row
		while ($row = mysqli_fetch_assoc($result)) {
		  echo "<tr>";
		  foreach ($column_names as $column_name) {
			echo "<td>" . $row[$column_name->name] . "</td>";
		  }
		  echo "</tr>";
		}

		echo "</table>";
	  } else {
		echo "0 results";
	  }

	  // Close the connection
	  mysqli_close($conn);

	  ?>
	</div>
	</html>
    
	 
	 <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.sticky.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/custom.js"></script>

</body>
</html>