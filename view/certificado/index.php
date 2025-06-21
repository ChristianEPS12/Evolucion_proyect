<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado</title>
    <link rel="stylesheet" href="../../public/css/certificado.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        
        <canvas id="canvas" height="650px" width="900px" alt="Certificado" class="img-fluid"></canvas>
        
        <!-- <img src="../../public/Certificado.png" alt="Certificado" class="certificado-img"> -->
        <!-- Párrafo debajo de los botones -->
        <p class="tx-16 mg-b-30 text-justify" id="cur_descrip">
        </p>
        <div class="buttons">
            <a href="#">
                <button id="btnpng" class="btn-png"><i class="fas fa-image"></i> Descargar PNG</button>
            </a>
            <a href="#">
                <button id="btnpdf" class="btn-pdf"><i class="fas fa-file-pdf"></i> Descargar PDF</button>
            </a>
        </div>
        
        
    </div>

    <?php require_once("../html/MainJs.php");?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script type="text/javascript" src="certificado.js"></script>
</body>
</html>
