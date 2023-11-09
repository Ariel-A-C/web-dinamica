<?php

require_once("../database/db.php");
$conexion = new PDO('mysql:host=db.fmesasc.com;dbname=daw2', 'daw2', 'Gimbernat');
$cityId = isset($_GET['id']) ? $_GET['id'] : null;
echo "send ID: " . $cityId . '<br>';

$articulo = getArticle($conexion, $cityId);
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <title>Article</title>
</head>
<body>
<div id="menu">
    <template id="menu_superior">
        <header class="caja_menu">
            <img class="logo" src="./SVG/Logo.svg" alt="">
            <a href="../Home/index.php"><button class="boton_menu">Home</button></a>
            <a href="#"></a><button class="boton_menu">About us</button>
            <button class="boton_menu">Blogs</button>
            <button class="boton_menu">Contact</button>
            <a href="../Login/index.html"><img src="./SVG/icon-user.svg" alt=""></a>
            <div class="search">
                <input class="label" placeholder="Search">
                <img src="./SVG/search-outline.svg" alt="">
            </div>
        </header>
    </template>
</div>

<div id="sidebar">
    <template id="mySidebar">
        <div class="sidebar">
            <a href="article.php?id=<?php echo $cityId; ?>"><button class="edit-button" onclick="editar()">Editar Artículo</button></a>
            <button class="add-button" onclick="abrirNuevaPagina(this)">Añadir nuevo artículo</button>
            <button class="edit-button" onclick="editar()">Eliminar Artículo</button>
        </div>
    </template>
</div>

<div id="articulo">
    <template id="contenido">
        <section id="modText" class="caja_articulo">
            <?php
            echo $articulo;
            ?>
        </section>
    </template>
</div>

<div id="footer">
    <template id="menu_inferior">
        <footer class="caja_menu_inferior">
            <img class="logo_footer" src="./SVG/Logo.svg" alt="">
            <div class="footer_flex">
                <p class="texto_footer">Copyright 2022 DELLAFUENTESL.</p>
                <a href="#"><button class="boton_footer">Privacy Policy</button></a>
                <a href="#"><button class="boton_footer">Terms & Conditions</button></a>
                <a href="#"><button class="boton_footer">Cookie Policy</button></a>
                <a href="#"><button class="boton_footer">Contact</button></a>
            </div>
        </footer>
    </template>
</div>


<div class="cajita"></div>
<div class="cajita"></div>
<div class="cajita_peque">
    <div></div>
</div>
<div class="cajita_peque">
    <div></div>
</div>
<div class="cajita_blanca">
    <div></div>
</div>
<script src="script.js"></script>
</body>
</html>

<script>
    element = document.createElement("menu_superior");
    element = menu_superior.content.cloneNode(true);

    document.getElementById("menu").append(element);

    element = document.createElement("mySidebar");
    element = mySidebar.content.cloneNode(true);

    document.getElementById("sidebar").append(element);

    element = document.createElement("contenido");
    element = contenido.content.cloneNode(true);

    document.getElementById("articulo").append(element);

    element = document.createElement("menu_inferior");
    element = menu_inferior.content.cloneNode(true);

    document.getElementById("footer").append(element);

    var a = document.getElementById("contenido");
    var modText = document.getElementById("modText")

</script>