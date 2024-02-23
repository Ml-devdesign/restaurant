
<?php 
// Inclusion des fichiers de protection et de connexion à la base de données
include $_SERVER["DOCUMENT_ROOT"] . "/admin/include/protect.php";
require_once $_SERVER["DOCUMENT_ROOT"]. "/admin/include/connect.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);//ini_set('display_errors', 1);  //au début de votre script PHP pour afficher les erreurs qui pourraient survenir.


// Vérification si le formulaire de recherche a été soumis
if(isset($_POST['search']) && !empty($_POST['search']) && isset($_POST['type']) && $_POST['type'] === 'nom') {
    // Construction de la requête de recherche par nom
    $searchTerm = '%' . $_POST['search'] . '%'; // Ajout des jokers % pour la recherche partielle
    $sqlAdministrateurs = 'SELECT * FROM administrateurs WHERE nom_administrateurs LIKE :nom_administrateurs ORDER BY id_administrateurs DESC LIMIT :limit OFFSET :offset';
    $stmtAdministrateurs = $db->prepare($sqlAdministrateurs);
    $stmtAdministrateurs->bindValue(':limit', $nbParPage, PDO::PARAM_INT);
    $stmtAdministrateurs->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmtAdministrateurs->bindValue(':nom_administrateurs', $searchTerm, PDO::PARAM_STR);
    $stmtAdministrateurs->execute();
    $recordset = $stmtProducts->fetchAll();
} else {
    // Requête SQL pour récupérer les produits de la page actuelle
    $sqlAdministrateurs = 'SELECT * FROM administrateurs ORDER BY id_administrateurs DESC LIMIT :limit OFFSET :offset';
    $stmtAdministrateurs = $db->prepare($sqlAdministrateurs);
    $stmtAdministrateurs->bindValue(':limit', $nbParPage, PDO::PARAM_INT);
    $stmtAdministrateurs->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmtAdministrateurs->execute();
    $recordset = $stmtAdministrateurs->fetchAll();
}

?>

<!-- ______________________________________________________________VIEW ________________________________________________________________________________ -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBord</title>
</head>
<body>
    <section>
       <div class="container">
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="reservation.php">Reservation</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
       </div>
       <div class="container">
        <div class="tableau-de-bord">
            <h1>DashBoard</h1>
            <div class="Gestion-de-l-utilisateur">
                    
                <div class="Administrateurs container">
                    <h2>Gestion des Administrateurs</h2>
                    <div class="ajouter-un-administrateur">
                        <a href="#">Ajouter un Administrateur</a>
                        <h1>Ajout d'un administrateur</h1>
                        <form action="" method="post">
                            <label for="nom_administrateurs">Nom de l'administrateur : </label>
                            <input type="text" id ="nom_administrateurs" name="nom_administrateurs" value="<?= htmlspecialchars($row['nom_administrateurs'])?>">
                            
                            <label for="mot_de_passe_hash">Mot de passe : </label>
                            <input type="text" id ="mot_de_passe_hash" name="mot_de_passe_hash" value="<?= htmlspecialchars($row['mot_de_passe_hash'])?>">
                        </form>
                    </div>
                    </div>
                    <div class="liste-des-administrateurs">
                        <a href="liste-des-administrateurs.php">Liste des Administrateurs</a>
                    </div>
                </div>
    
                <div class="depenses container">
                    <h2>Gestion des Depenses</h2>
                    <div class="ajouter-une-depense">
                        <a href="ajouter-une-depense.php">Ajouter une Depense</a>
                    <div class="liste-des-depenses">
                        <a href="liste-des-depenses.php">Liste des Depenses</a>
                    </div>
                </div>
                </div>

                <div class="reservations container">
                    <h2>Gestion des Reservations</h2>
                    <div class="ajouter-une-reservation">
                        <a href="ajouter-une-reservation.php">Ajouter une Reservation</a>
                    </div>
                    <div class="liste-des-reservations">
                        <a href="liste-des-reservations.php">Liste des Reservations</a>
                    </div>
                </div>
                </div>

                <div class="stocks container">
                    <h2>Gestion des Stocks</h2>
                    <div class="ajouter-un-stock">
                        <a href="ajouter-un-stock.php">Ajouter un Stock</a>
                    </div>
                    <div class="liste-des-stocks">
                        <a href="liste-des-stocks.php">Liste des Stocks</a>
                    </div>
                </div>
                </div>

                <div class="transactions container">
                    <h2>Gestion des Transactions</h2>
                    <div class="ajouter-une-transaction">
                        <a href="ajouter-une-transaction.php" id="show-form-1" data-active-forms="form-2,form-3,form-4,form-5,form-6,form-7,form-8,form-9">Ajouter une Transaction</a>
                    </div>
                    <div class="liste-des-transactions">
                        <a href="liste-des-transactions.php" id="show-form-1"data-active-forms="form-2,form-3,form-4,form-5,form-6,form-7,form-8,form-9">Liste des Transactions</a>
                    </div>
                </div>
                </div>

                <div class="commentaires">
                    <h2>Gestion des Commentaires</h2>
                    <div class="ajouter-un-commentaire">
                        <a href="ajouter-un-commentaire.php" id="show-form-2" data-active-forms="form-1,form-3,form-4,form-5,form-6,form-7,form-8,form-9">Ajouter un Commentaire</a>
                    </div>
                    <div class="liste-des-commentaires">
                        <a href="liste-des-commentaires.php"  id="show-form-2" data-active-forms="form-1,form-3,form-4,form-5,form-6,form-7,form-8,form-9">Liste des Commentaires</a>
                    </div>
                </div>
                </div>

                <div class="documents container">
                    <h2>Gestion des Documents</h2>
                    <div class="ajouter-un-document">
                        <a href="ajouter-un-document.php"id="show-form-3" data-active-forms="form-1,form-2,form-4,form-5,form-6,form-7,form-8,form-9">Ajouter un Document</a>
                    </div>
                    <div class="liste-des-documents">
                        <a href="liste-des-documents.php" id="show-form-3" data-active-forms="form-1,form-2,form-4,form-5,form-6,form-7,form-8,form-9">Liste des Documents</a>
                    </div>
                </div>
                </div>

                <div class="employes container">
                    <h2>Gestion des Employés</h2>
                    <div class="ajouter-un-employe">
                        <a href="ajouter-un-employe.php"id="show-form-4" data-active-forms="form-1,form-2,form-3,form-5,form-6,form-7,form-8,form-9">Ajouter un Employé</a>
                    </div>
                    <div class="liste-des-employes">
                        <a href="liste-des-employes.php"  id="show-form-4" data-active-forms="form-1,form-2,form-3,form-5,form-6,form-7,form-8,form-9" >Liste des Employés</a>
                    </div>
                </div>
                </div>

                <div class="fournisseurs container">
                    <h2>Gestion des Fournisseurs</h2>
                    <div class="ajouter-un-fournisseur">
                        <a href="ajouter-un-fournisseur.php" id="show-form-5"  data-active-forms="form-1,form-2,form-3,form-4,form-6,form-7,form-8,form-9">Ajouter un Fournisseur</a>
                    </div>
                    <div class="liste-des-fournisseurs">
                        <a href="liste-des-fournisseurs.php"  id="show-form-5" data-active-forms="form-1,form-2,form-3,form-4,form-6,form-7,form-8,form-9">Liste des Fournisseurs</a>
                    </div>
                </div>
                </div>

                <div class="menus">
                    <h2>Gestion des Menus</h2>
                    <div class="ajouter-un-menu">
                        <a href="ajouter-un-menu.php" id="show-form-6" data-active-forms="form-2,form-3,form-4,form-5,form-7,form-8,form-9">Ajouter un Menu</a>
                    </div>
                    <div class="liste-des-menus">
                        <a href="liste-des-menus.php"  id="show-form-6" data-active-forms="form-2,form-3,form-4,form-5,form-7,form-8,form-9">Liste des Menus</a>
                    </div>
                </div>
                </div>

                <div class="platsdujour container">
                    <h2>Gestion des Plats du Jour</h2>
                    <div class="ajouter-un-plats-du-jour">
                        <a href="ajouter-un-plats-du-jour.php"  id="show-form-7" data-active-forms="form-2,form-3,form-4,form-5,form-6,form-8,form-9">Ajouter un Plat du Jour</a>
                    </div>
                    <div class="liste-des-plats-du-jour">
                        <a href="liste-des-plats-du-jour.php"  id="show-form-7" data-active-forms="form-2,form-3,form-4,form-5,form-6,form-8,form-9">Liste des Plats du Jour</a>
                    </div>
                </div>
                </div>

                <div class="promotions container">
                    <h2>Gestion des Promotions</h2>
                    <div class="ajouter-une-promotion">
                        <a href="ajouter-une-promotion.php" id="show-form-8" data-active-forms="form-2,form-3,form-4,form-5,form-6,form-7,form-9">Ajouter une Promotion</a>
                    </div>
                    <div class="liste-des-promotions">
                        <a href="liste-des-promotions.php"  id="show-form-8" data-active-forms="form-2,form-3,form-4,form-5,form-6,form-7,form-9">Liste des Promotions</a>
                    </div>
                </div>
                </div>

                <div class="statistiques container">
                    <h2>Gestion des Statistiques</h2>
                    <div class="ajouter-une-statistique">
                        <a href="ajouter-une-statistique.php" id="show-form-9" data-active-forms="form-1,form-2,form-3,form-4,form-5,form-6,form-7,form-8">Ajouter une Statistique</a>
                    </div>
                    <div class="liste-des-statistiques">
                        <a href="liste-des-statistiques.php"  id="show-form-9" data-active-forms="form-1,form-2,form-3,form-4,form-5,form-6,form-7,form-8">Liste des Statistiques</a>
                    </div>
                </div>
            </div>
       </div>
    </section>
</body>
</html>