<?php 
echo password_hash("1", PASSWORD_DEFAULT);
//fichier qui n'est utile qu'une fois pour le hachage des password de la base de donnee (a suppr)
//Copier le code genere puis le coller dans le admin_login pour prendre en compte le hachage 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <<?php 
    
        echo password_hash("1", PASSWORD_DEFAULT);
    
    
    ?>
</body>
</html>