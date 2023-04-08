<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPPSQL</title>
</head>
<body>
    <?php
        include("conexion.php");
        $conn = new Conexion();
        $conn->read("empleados");
    ?>
</body>
</html>