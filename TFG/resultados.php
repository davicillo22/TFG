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
$algoritmoTexto='Árboles aleatorios';

if($algoritmo=='cox')
    $algoritmoTexto='Regresión de Cox';
else if($algoritmo=='regresion')
    $algoritmoTexto='Regresión Logística';


$string_prob1 = $_GET['prob1'];
$string_prob2 = isset($_GET['prob2']) ? $_GET['prob2'] : null;
$prob1 = number_format((float)$string_prob1, 2, '.', '');

if (isset($string_prob2))
    $prob2 = number_format((float)$string_prob2, 2, '.', '');

$f1="64%";
$recall="58%";
$precision="76%";
$accuracy="84%";
$rbqes="(pre-operatorio)";
$textoVariable="Recidiva Bioquímica";
?>
    <link rel="stylesheet" href="css/style.css">
    <div class="center-div">
        <h2 style="color: black">Resultados con algoritmo: <?php echo $algoritmoTexto?></h2>
    </div>

<?php
if($algoritmo == 'cox'){
    if($variable == 'rbqPre'){
        $textoVariable="RBQ (pre-operatorio)";
        $rbq_5_years_pre = $_GET['prob1'];
        $rbq_10_years_pre = $_GET['prob2'];
        $f1="77%";
        $recall="172.69";
        $precision="9.83 on 30 df";

        ?>

        <?php
    }else if($variable == 'rbqPost'){
        $rbq_5_years_post = $_GET['prob1'];
        $rbq_10_years_post = $_GET['prob2'];
        $f1="93%";
        $recall="193.67";
        $precision="30.85 on 51 df";
        $textoVariable="RBQ (post-operatorio)";
        ?>

        <?php
    }
}else{
    if ($variable == 'extracap') {
        $textoVariable="extensión Extracapsular";
        if ($algoritmo == 'regresion') {
            $lr_probability = $_GET['prob1'];
            $f1="79%";
            $recall="77%";
            $precision="86%";
            $accuracy="92%";

            ?>

            <?php
        } else {
            $rf_probability = $_GET['prob1'];
            $f1="90%";
            $recall="88%";
            $precision="93%";
            $accuracy="96%";?>
        <?php
        }
    }else if ($variable == 'margen') {
        $textoVariable="márgenes positivos";
        if ($algoritmo == 'regresion') {
            $f1="81%";
            $recall="76%";
            $precision="85%";
            $accuracy="92%";?>
            <?php
        }else {
            $f1="64%";
            $recall="58%";
            $precision="76%";
            $accuracy="84%";?>
            <?php
        }
    }else if ($variable == 'tnm2') {
        $textoVariable="estadios localizados";
        if ($algoritmo == 'regresion') {
            $lr_probability = $_GET['prob1'];
            $f1="95%";
            $recall="96%";
            $precision="96%";
            $accuracy="95%";?>

            <?php
        }else {
            $rf_probability = $_GET['prob1'];
            $f1="97%";
            $recall="96%";
            $precision="96%";
            $accuracy="97%";?>

            <?php
        }
    } else if ($variable == 'vvss') {
        $textoVariable="invasión de vesículas";
        if ($algoritmo == 'regresion') {
            $lr_probability = $_GET['prob1'];
            $f1="68%";
            $recall="72%";
            $precision="67%";
            $accuracy="92%";?>

            <?php

        }else {
            $rf_probability = $_GET['prob1'];
            $f1="50%";
            $recall="43%";
            $precision="64%";
            $accuracy="91%";?>

            <?php
        }
    }
}
?>





<?php if($algoritmo == 'cox'){?>
    <link rel="stylesheet" href="css/resultstyle.css">
    <div class="card" style="width: 550px;">
        <div class="front">
            <h3 style="margin-top: 50px;">Probabilidad de</h3>
            <h3><?php echo $textoVariable;?>:</h3>
            <div class="top">
                <div class="blockP">
                    <span class="subrayado"> A 5 años: </span><div id="percentage" style="font-size: 40px"><?php echo $prob1 . "%";?></div>
                </div>

                <div class="blockP">
                    <span class="subrayado"> A 10 años: </span><div id="percentage2" style="font-size: 40px"><?php echo $prob2 . "%";?></div>
                </div>
            </div>
            <div class="bottom" style="height: 53%">
                <button id="verMetricas" class="buttonExotic">Ver métricas</button>
            </div>
        </div>
        <div class="back">
            <div class="section" style="height: 23%; font-size: 29px;">
                Concordance: <?php echo $f1;?>
            </div>
            <div class="section" style="height: 23%">
                Partial AIC: <?php echo $recall;?>
            </div>
            <div class="section" style="height: 26%; font-size: 25px;">
                Log-likelihood ratio test: <?php echo $precision;?>
            </div>
            <div class="bottom" style="height: 30%">
                <button id="verPrediccion" class="buttonExotic">Ver predicción</button>
            </div>
        </div>
    </div>

<?php }
else{?>
    <link rel="stylesheet" href="css/resultstyle.css">
<div class="card" style="width: 550px;" >
    <div class="front">
        <h3 style="margin-top: 50px;">Probabilidad de</h3>
        <h3><?php echo $textoVariable;?>:</h3>
        <div class="top">
            <div class="blockP">
                <div id="percentage" style="font-size: 40px"><?php echo $prob1; echo "%";?></div>
            </div>
        </div>
        <div class="bottom" style="height: 55%">
            <button id="verMetricas" class="buttonExotic">Ver métricas</button>
        </div>
    </div>
    <div class="back">
        <div class="section">
            F1: <?php echo $f1;?>
        </div>
        <div class="section">
            Recall: <?php echo $recall;?>
        </div>
        <div class="section">
            Precision: <?php echo $precision;?>
        </div>
        <div class="section">
            Accuracy: <?php echo $accuracy;?>
        </div>
        <div class="bottom" style="height: 35%">
            <button id="verPrediccion" class="buttonExotic">Ver predicción</button>
        </div>
    </div>
</div>

<?php }?>

<div class="center-div">
    <a href='calculadoraRiesgo.php' class='btn btn-success btn-lg' style='margin-top:1%'>Volver</a>
    <form action="generatePdfCalculadora.php" target="_blank"method="post" id="myForm">
        <input type="hidden" name="f1" value="<?php echo isset($f1) ? $f1 : '' ?>">
        <input type="hidden" name="recall" value="<?php echo isset($recall) ? $recall : '' ?>">
        <input type="hidden" name="precision" value="<?php echo isset($precision) ? $precision : '' ?>">
        <input type="hidden" name="accuracy" value="<?php echo isset($accuracy) ? $accuracy : '' ?>">
        <input type="hidden" name="lr_probability" value="<?php echo isset($lr_probability) ? $lr_probability : '' ?>">
        <input type="hidden" name="rf_probability" value="<?php echo isset($rf_probability) ? $rf_probability : '' ?>">
        <input type="hidden" name="textoVariable" value="<?php echo isset($textoVariable) ? $textoVariable : '' ?>">
        <input type="hidden" name="rbq_5_years_post" value="<?php echo isset($rbq_5_years_post) ? $rbq_5_years_post : '' ?>">
        <input type="hidden" name="rbq_10_years_post" value="<?php echo isset($rbq_10_years_post) ? $rbq_10_years_post : '' ?>">
        <input type="hidden" name="rbq_5_years_pre" value="<?php echo isset($rbq_5_years_pre) ? $rbq_5_years_pre : '' ?>">
        <input type="hidden" name="rbq_10_years_pre" value="<?php echo isset($rbq_10_years_pre) ? $rbq_10_years_pre : '' ?>">
        <input type="hidden" name="algoritmoTexto" value="<?php echo isset($algoritmoTexto) ? $algoritmoTexto : '' ?>">
        <a href="#"class='btn btn-success btn-lg' onclick="document.getElementById('myForm').submit(); return false;" target="_blank">Generar PDF</a>
    </form>
</div>

<div class="cuadro-texto">
    <h2 style="font-size: medium; text-align: center;" id="welcome-msg"><span id="username"><span id="cursor"></span></span></h2>
</div>

<script>
    const percentageSpan = document.getElementById('percentage');
    const verMetricasBtn = document.getElementById("verMetricas");
    const verPrediccionBtn = document.getElementById("verPrediccion");
    const card = document.querySelector('.card');

    let percentage = 0;
    const targetString = percentageSpan.innerText;
    const targetPercentage = parseFloat(targetString);

    const increment = 0.15;
    const interval = 5;

    const updatePercentage = () => {
        percentageSpan.innerText = percentage.toFixed(2) + "%";
        percentage += increment;
        if (percentage > targetPercentage) {
            percentage = targetPercentage;
            clearInterval(timer);
        }
    };

    const timer = setInterval(updatePercentage, interval);

    verMetricasBtn.addEventListener('click', () => {
        card.classList.add('active');
    });

    verPrediccionBtn.addEventListener('click', () => {
        card.classList.remove('active');
    });

</script>

<script>
    const percentageSpan2 = document.getElementById('percentage2');

    let percentage2 = 0;
    const targetString2 = percentageSpan.innerText;
    const targetPercentage2 = parseFloat(targetString2);

    const increment2 = 0.15;
    const interval2 = 5;

    const updatePercentage2 = () => {
        percentageSpan2.innerText = percentage2.toFixed(2)  + "%";
        percentage2 += increment2;
        if (percentage2 > targetPercentage2) {
            percentage2 = targetPercentage2;
            clearInterval(timer2);
        }
    };

    const timer2 = setInterval(updatePercentage2, interval2);


</script>


<script>
    const welcomeMsg = document.querySelector("#welcome-msg");
    const usernameEl = document.querySelector("#username");

    let i = 0;
    let txt = `Esta calculadora está entrenada siguiendo modelos de machine learning. En primer lugar, puedes elegir entre dos maneras de proporcionar la entrada: introducir los datos a mano o seleccionar un paciente ya existente en la base de datos.`;
    let speed = 20;

    function typeWriter() {
        if (i < txt.length) {
            usernameEl.textContent += txt.charAt(i);
            i++;
            setTimeout(typeWriter, speed);
        }
    }

    setTimeout(() => {
        welcomeMsg.classList.add("show");
        typeWriter();
    }, 1000);
</script>


