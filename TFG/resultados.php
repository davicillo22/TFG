<?php

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/patient.php';
require_once __DIR__ . '/includes/usuarios.php';

$tituloPagina = 'Resultados';

$contenidoPrincipal="";


require __DIR__.'/includes/layout.php';
$conn = mysqli_connect("localhost", "root", "", "bbdd");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$algoritmo = 'regresion'; //$_POST['algoritmo'];
$variable = 'extracap'; //$_POST['variable'];

//$algoritmo = isset($_POST['algoritmo']) ? $_POST['algoritmo'] : '';
//$variable = isset($_POST['variable']) ? $_POST['variable'] : '';
?>

    <div class="center-div">
        <h2 style="color: black">Métricas para observar la variable: <?php echo $variable; ?>, con el algoritmo: <?php echo $algoritmo; ?></h2>
    </div>

<?php
if($algoritmo == 'cox'){
    if($variable == 'rbqPre'){

        $rbq_5_years_pre = $_POST['rbq_5_years_pre'];
        echo"<h3>RBQ a 5 años (preoperatorio): " . $rbq_5_years_pre . "</h3>";
        $rbq_10_years_pre = $_POST['rbq_10_years_pre'];
        echo"<h3>RBQ a 10 años (preoperatorio): " . $rbq_10_years_pre . "</h3>";
        echo"<h3>Concordance = 0.77 </h3>";
        echo"<h3>Partial AIC = 172.69</h3>";
        echo"<h3>log-likelihood ratio test = 9.83 on 30 df</h3>";
    }else if($variable == 'rbqPost'){
        $rbq_5_years_post = $_POST['rbq_5_years_post'];
        echo "</h3>RBQ a 5 años (postoperatorio): " . $rbq_5_years_post . "</h3>";
        $rbq_10_years_post = $_POST['rbq_10_years_post'];
        echo "</h3>RBQ a 10 años (postoperatorio): " . $rbq_10_years_post . "</h3>";
        echo"</h3>Concordance = 0.93 </h3>";
        echo"</h3>Partial AIC = 193.67</h3>";
        echo"</h3>log-likelihood ratio test = 30.85 on 51 df </h3>";
    }
}else{
    if ($variable == 'extracap') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
            echo "<h3>Regresion logística EXTRACAP: " . $lr_probability . "<br>";
            echo "<h3>F1: 0,79</h3>";
            echo "<h3>Recall: 0,77</h3>";
            echo "<h3>Precision: 0,86</h3>";
            echo "<h3>Accuracy: 0,92</h3>";
        } else {
            $rf_probability = $_POST['rf_probability'];
            echo "<h3>Árboles aleatorios EXTRACAP: " . $rf_probability . "</h3>";
            echo "<h3>F1: 0,90</h3>";
            echo "<h3>Recall: 0,88</h3>";
            echo "<h3>Precision: 0,93 </h3>";
            echo "<h3>Accuracy: 0,96 <br>";
        }
    }else if ($variable == 'margen') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
            echo "<h3>Regresion logística MARGEN: " . $lr_probability . "</h3>";
            echo "<h3>F1: 0,81  </h3>";
            echo "<h3>Recall: 0,76  </h3>";
            echo "<h3>Precision: 0,85 </h3>";
            echo "<h3>Accuracy: 0,92 </h3>";

        }else {
            $rf_probability = $_POST['rf_probability'];
            echo "<h3>Árboles aleatorios MARGEN: " . $rf_probability . "</h3>";
            echo "<h3>F1: 0,64  </h3>";
            echo "<h3>Recall: 0,58  </h3>";
            echo "<h3>Precision: 0,76 </h3>";
            echo "<h3>Accuracy: 0,84 </h3>";
        }
    } else if ($variable == 'tnm2') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
            echo "<h3>Regresion logística TNM2: " . $lr_probability . "</h3>";
            echo "<h3>F1: 0,95  </h3>";
            echo "<h3>Recall: 0,95  </h3>";
            echo "<h3>Precision: 0,95 </h3>";
            echo "<h3>Accuracy: 0,95 </h3>";

        }else {
            $rf_probability = $_POST['rf_probability'];
            echo "<h3>Árboles aleatorios TNM2: " . $rf_probability . "</h3>";
            echo "<h3>F1: 0,97  </h3>";
            echo "<h3>Recall: 0,97  </h3>";
            echo "<h3>Precision: 0,97 </h3>";
            echo "<h3>Accuracy: 0,97 </h3>";
        }
    } else if ($variable == 'vvss') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['lr_probability'];
            echo "<h3>Regresión logística VVSS: " . $lr_probability . "</h3>";
            echo "<h3>F1: 0,68  </h3>";
            echo "<h3>Recall: 0,72  </h3>";
            echo "<h3>Precision: 0,67 </h3>";
            echo "<h3>Accuracy: 0,92 </h3>";

        }else {
            $rf_probability = $_POST['rf_probability'];
            echo "<h3>Árboles aleatorios VVSS: " . $rf_probability . "</h3>";
            echo "<h3>F1: 0,50  </h3>";
            echo "<h3>Recall: 0,43  </h3>";
            echo "<h3>Precision: 0,64 </h3>";
            echo "<h3>Accuracy: 0,91 </h3>";
        }
    }
}





