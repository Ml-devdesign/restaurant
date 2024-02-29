<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <label for="nom_administrateurs">Nom de l'administrateur : </label>
    <input type="text" id ="nom_administrateurs" name="nom_administrateurs" value="<?= htmlspecialchars($row['nom_administrateurs'])?>">
    
    <label for="mot_de_passe_hash">Mot de passe : </label>
    <input type="text" id ="mot_de_passe_hash" name="mot_de_passe_hash" value="<?= htmlspecialchars($row['mot_de_passe_hash'])?>">
</form>
</body>
</html>