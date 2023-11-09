<?php
require_once '../database/db.php';
$conexion = new PDO('mysql:host=db.fmesasc.com;dbname=daw2', 'daw2', 'Gimbernat');

$cityId = isset($_GET['id']) ? $_GET['id'] : null;

echo "id: " . $cityId . '<br>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    editCityHTML($conexion, $cityId, $_POST["text"]);
    echo "Se ha actualizado en la base de datos con estos datos:";
}

$articulo = getArticle($conexion, $cityId);
echo $articulo;

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

<form action="article.php?id=<?php echo $cityId; ?>" method="POST">
    <textarea name="text"><?php echo $articulo; ?></textarea>
    <button type="submit">Guardar</button>
</form>

</body>




