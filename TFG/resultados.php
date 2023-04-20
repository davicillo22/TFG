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

$algoritmo = $_GET['algoritmo'];
$variable = $_GET['variable'];
$prob1 = $_GET['prob1'];
$prob2 = isset($_GET['prob2']) ? $_GET['prob2'] : null;
?>
    <link rel="stylesheet" href="css/style.css">
    <div class="center-div">
        <h2 style="color: black">Métricas para observar la variable: <?php echo $variable; ?>, con el algoritmo: <?php echo $algoritmo; ?></h2>
    </div>

<?php
if($algoritmo == 'cox'){
    if($variable == 'rbqPre'){

        $rbq_5_years_pre = $_POST['prob1'];
        $rbq_10_years_pre = $_POST['prob2'];?>

        <table class="formula">
            <tr>
                <td><h3>RBQ a 5 años (preoperatorio):</h3></td>
                <td><h3><?php echo $rbq_5_years_pre; ?></h3></td>
            </tr>
            <tr>
                <td><h3>RBQ a 10 años (preoperatorio):</h3></td>
                <td><h3><?php echo $rbq_10_years_pre; ?></h3></td>
            </tr>
            <tr>
                <td><h3>Concordance:</h3></td>
                <td><h3>0,77</h3></td>
            </tr>
            <tr>
                <td><h3>Partial AIC:</h3></td>
                <td><h3>172,69</h3></td>
            </tr>
            <tr>
                <td><h3>log-likelihood ratio test:</h3></td>
                <td><h3>9,83 on 30 df</h3></td>
            </tr>
        </table>
        <?php
    }else if($variable == 'rbqPost'){
        $rbq_5_years_post = $_POST['prob1'];
        $rbq_10_years_post = $_POST['prob2'];?>
        <table class="formula">
            <tr>
                <td><h3>RBQ a 5 años (postoperatorio):</h3></td>
                <td><h3><?php echo $rbq_5_years_post; ?></h3></td>
            </tr>
            <tr>
                <td><h3>RBQ a 10 años (postoperatorio):</h3></td>
                <td><h3><?php echo $rbq_10_years_post; ?></h3></td>
            </tr>
            <tr>
                <td><h3>Concordance:</h3></td>
                <td><h3>0.93</h3></td>
            </tr>
            <tr>
                <td><h3>Partial AIC:</h3></td>
                <td><h3>193.67</h3></td>
            </tr>
            <tr>
                <td><h3>Log-likelihood ratio test:</h3></td>
                <td><h3>30.85 on 51 df</h3></td>
            </tr>
        </table>
        <?php
    }
}else{
    if ($variable == 'extracap') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['prob1'];?>
            <table class="formula">
            <tr>
                <td><h3>Regresion logística EXTRACAP:</h3></td>
                <td><h3><?php echo $lr_probability; ?></h3></td>
            </tr>
            <tr>
                <td><h3>F1:</h3></td>
                <td><h3>0,79</h3></td>
            </tr>
            <tr>
                <td><h3>Recall:</h3></td>
                <td><h3>0,77</h3></td>
            </tr>
            <tr>
                <td><h3>Precision:</h3></td>
                <td><h3>0,86</h3></td>
            </tr>
            <tr>
                <td><h3>Accuracy:</h3></td>
                <td><h3>0,92</h3></td>
            </tr>
            </table>
            <?php
        } else {
            $rf_probability = $_POST['prob1'];?>
            <table class="formula">
            <tr>
                <td><h3>Árboles aleatorios EXTRACAP:</h3></td>
                <td><h3><?php echo $rf_probability; ?></h3></td>
            </tr>
            <tr>
                <td><h3>F1:</h3></td>
                <td><h3>0,90</h3></td>
            </tr>
            <tr>
                <td><h3>Recall:</h3></td>
                <td><h3>0,88</h3></td>
            </tr>
            <tr>
                <td><h3>Precision:</h3></td>
                <td><h3>0,93</h3></td>
            </tr>
            <tr>
                <td><h3>Accuracy:</h3></td>
                <td><h3>0,96</h3></td>
            </tr>
            </table><?php
        }
    }else if ($variable == 'margen') {
        if ($algoritmo == 'regresion') {
            ?>
            <table class="formula">
                <tr>
                    <td><h3>Regresion logística :</h3></td>
                    <td><h3><?php echo $prob1; ?></h3></td>
                </tr>
                <tr>
                    <td><h3>F1:</h3></td>
                    <td><h3>0,81</h3></td>
                </tr>
                <tr>
                    <td><h3>Recall:</h3></td>
                    <td><h3>0,76</h3></td>
                </tr>
                <tr>
                    <td><h3>Precision:</h3></td>
                    <td><h3>0,85</h3></td>
                </tr>
                <tr>
                    <td><h3>Accuracy:</h3></td>
                    <td><h3>0,92</h3></td>
                </tr>
            </table>
            <?php
        }else {
        ?><table class="formula">
        <tr>
            <td><h3>Árboles aleatorios :</h3></td>
            <td><h3><?php echo $prob1; ?></h3></td>
            </tr>
            <tr>
                <td><h3>F1:</h3></td>
                <td><h3>0,64</h3></td>
            </tr>
            <tr>
                <td><h3>Recall:</h3></td>
                <td><h3>0,58</h3></td>
            </tr>
            <tr>
                <td><h3>Precision:</h3></td>
                <td><h3>0,76</h3></td>
            </tr>
            <tr>
                <td><h3>Accuracy:</h3></td>
                <td><h3>0,84</h3></td>
            </tr>
            </table>
            <?php
        }
    }else if ($variable == 'tnm2') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['prob1'];
?>
            <table class="formula">
                <tr>
                    <td><h3>Regresion logística :</h3></td>
                    <td><h3><?php echo $lr_probability; ?></h3></td>
                </tr>
                <tr>
                    <td><h3>F1:</h3></td>
                    <td><h3>0,95</h3></td>
                </tr>
                <tr>
                    <td><h3>Recall:</h3></td>
                    <td><h3>0,95</h3></td>
                </tr>
                <tr>
                    <td><h3>Precision:</h3></td>
                    <td><h3>0,95</h3></td>
                </tr>
                <tr>
                    <td><h3>Accuracy:</h3></td>
                    <td><h3>0,95</h3></td>
                </tr>
            </table>
            <?php
        }else {
            $rf_probability = $_POST['prob1'];?>
            <table class="formula">
                <tr>
                    <td><h3>Árboles aleatorios :</h3></td>
                    <td><h3><?php echo $rf_probability; ?></h3></td>
                </tr>
                <tr>
                    <td><h3>F1:</h3></td>
                    <td><h3>0,97</h3></td>
                </tr>
                <tr>
                    <td><h3>Recall:</h3></td>
                    <td><h3>0,97</h3></td>
                </tr>
                <tr>
                    <td><h3>Precision:</h3></td>
                    <td><h3>0,97</h3></td>
                </tr>
                <tr>
                    <td><h3>Accuracy:</h3></td>
                    <td><h3>0,97</h3></td>
                </tr>
            </table>
            <?php
        }
    } else if ($variable == 'vvss') {
        if ($algoritmo == 'regresion') {
            $lr_probability = $_POST['prob1'];?>
            <table class="formula">
                <tr>
                    <td><h3>Regresión logística :</h3></td>
                    <td><h3><?php echo $lr_probability; ?></h3></td>
                </tr>
                <tr>
                    <td><h3>F1:</h3></td>
                    <td><h3>0,68</h3></td>
                </tr>
                <tr>
                    <td><h3>Recall:</h3></td>
                    <td><h3>0,72</h3></td>
                </tr>
                <tr>
                    <td><h3>Precision:</h3></td>
                    <td><h3>0,67</h3></td>
                </tr>
                <tr>
                    <td><h3>Accuracy:</h3></td>
                    <td><h3>0,92</h3></td>
                </tr>
            </table>
            <?php

        }else {
            $rf_probability = $_POST['prob1'];?>
            <table class="formula">
                <tr>
                    <td><h3>Árboles aleatorios :</h3></td>
                    <td><h3><?php echo $rf_probability; ?></h3></td>
                </tr>
                <tr>
                    <td><h3>F1:</h3></td>
                    <td><h3>0,50</h3></td>
                </tr>
                <tr>
                    <td><h3>Recall:</h3></td>
                    <td><h3>0,43</h3></td>
                </tr>
                <tr>
                    <td><h3>Precision:</h3></td>
                    <td><h3>0,64</h3></td>
                </tr>
                <tr>
                    <td><h3>Accuracy:</h3></td>
                    <td><h3>0,91</h3></td>
                </tr>
            </table>
            <?php
        }
    }
}





