
<?php 
// Inclusion des fichiers de protection et de connexion à la base de données
//pour le include lors de linclusion de fichier il ce fait deux fois en ce qui concerne des fonction ou autre le include_once et preferable pour la gestion de plusier n'element nest preferable 

//include $_SERVER["DOCUMENT_ROOT"] . "/admin/include/protect.php";
require_once $_SERVER["DOCUMENT_ROOT"]. "/admin/include/connect.php";
//DOCUMENT_ROOT -> C:\wamp\www\leprojet\ et le point de depart chemin de stockage alouer dans une reppertoir chemi non visible adaptable sur nimport quel serveur 

//devoir cinder les fichier avec le include et require pour le gestion du code et son maintient 

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);//ini_set('display_errors', 1);  //au début de votre script PHP pour afficher les erreurs qui pourraient survenir.

// Définition du nombre d'éléments à afficher par page
$nbParPage = 16;

// Récupération du numéro de la page à afficher depuis les paramètres GET // isset dit si est definie 
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Vérification et correction du numéro de page
if (!is_numeric($page) || $page < 1) {
    $page = 1;
}

// Requête SQL pour compter le nombre total de produits
$sqlCount = 'SELECT COUNT(employee_id) AS nom_administrateurs FROM employees';
$stmtCount = $db->prepare($sqlCount);
$stmtCount->execute();
$total_Employees = $stmtCount->fetchColumn();

// Calcul du nombre total de pages
$total_pages = ceil($total_Employees / $nbParPage);

// Calcul de l'offset pour la pagination
$offset = ($page - 1) * $nbParPage;
/*
GET OBTENIR les données du formulaire de recherche, 
est un tableau de variables passées au script courant via les paramètres de l’URL
la méthode GET sont visibles par tout le monde
Ce sont des superglobales --> ils sont toujours accessibles, quelle que soit 
leur portée - et que vous pouvez y accéder depuis n’importe quelle fonction, 
classe ou fichier sans avoir à faire quoi que ce soit de spécial.
Vérification si le formulaire de recherche a été soumis
*/

if(isset($_POST['search']) && !empty($_POST['search']) && isset($_POST['type']) && $_POST['type'] === 'nom') {
    // Construction de la requête de recherche par nom
    $searchTerm = '%' . $_POST['search'] . '%'; // Ajout des jokers % pour la recherche partielle
    $sqlEmployees = 'SELECT * FROM employees WHERE employee_id LIKE :last_name ORDER BY employee_id DESC LIMIT :limit OFFSET :offset';
    $stmtEmployees = $db->prepare($sqlEmployees);
    $stmtEmployees->bindValue(':limit', $nbParPage, PDO::PARAM_INT);
    $stmtEmployees->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmtEmployees->bindValue(':last_name', $searchTerm, PDO::PARAM_STR);
    $stmtEmployees->execute();
    $recordset = $stmtEmployees->fetchAll();
} else {
    // Requête SQL pour récupérer les produits de la page actuelle
    $sqlEmployees = 'SELECT * FROM employees ORDER BY employee_id DESC LIMIT :limit OFFSET :offset';
    $stmtEmployees = $db->prepare($sqlEmployees);
    $stmtEmployees->bindValue(':limit', $nbParPage, PDO::PARAM_INT);
    $stmtEmployees->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmtEmployees->execute();
    $recordset = $stmtEmployees->fetchAll();
}

?>

<!-- ______________________________________________________________VIEW ________________________________________________________________________________ -->

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="./admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="./admin/css/font-awesome.min.css">
    <link rel="stylesheet" href="./admin/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./admin/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./admin/css/magnific-popup.css">
    <link rel="stylesheet" href="./admin/css/aos.css">
    <link rel="stylesheet" href="./admin/css/ionicons.min.css">
    <link rel="stylesheet" href="./admin/css/flaticon.css">
    <link rel="stylesheet" href="./admin/css/icomoon.css">
    <link rel="stylesheet" href="./admin/css/responsive.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <!-- <script src="/" defer></script> -->
    <script defer src="/admin/admins/view.js"></script>

   
</head>
<body>
<section class="menu">
<title>DashBord</title>
    <div class="">
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
</section>        

<section>
    <div class="tableau-de-bord">
    <h1>DashBoard</h1>
        <div class="container">
            <button class="btnDisplay" data-target="divSubsides">Gestion des Administrateurs</button>
            <button class="btnDisplay" data-target="divSubsidesDepenses">Gestion des Dépenses</button>   
            <button class="btnDisplay" data-target="divSubsidesReservations">Gestion des Réservations</button>  
            <button class="btnDisplay" data-target="divSubsidesStocks">Gestion des Stocks</button>  
            <button class="btnDisplay" data-target="divSubsidesTransactions">Gestion des Transactions</button>  
            <button class="btnDisplay" data-target="divSubsidesCommentaires">Gestion des Commentaires</button>  
            <button class="btnDisplay" data-target="divSubsidesDocuments">Gestion des Documents</button>  
            <button class="btnDisplay" data-target="divSubsidesEmployés">Gestion des Employés</button>  
            <button class="btnDisplay" data-target="divSubsidesFournisseurs">Gestion des Fournisseurs</button>  
            <button class="btnDisplay" data-target="divSubsidesMenus">Gestion des Menus</button> 
            <button class="btnDisplay" data-target="divSubsidesPlatsduJour">Gestion des Plats du Jour</button>  
            <button class="btnDisplay" data-target="divSubsidesPromotions">Gestion des Promotions</button>  
            <button class="btnDisplay" data-target="divSubsidesStatistiques">Statistiques</button>  
        </div>

        <div id="divSubsides" class="divSubsides">
        <h2>Gestion des Administrateurs</h2>
            <?php foreach($recordset as $row){ ?>
            <div class="card-admin border=solid 1x black">
                <table>
                    <tr>
                        <td><p class="card-admin-num">N° de l'administrateur : <?= htmlspecialchars($row['employee_id']);?></p></td>
                        <td><p class="card-admin-nom">Nom de l'Administrateur : <?= htmlspecialchars($row['last_name']);?></p></td>
                        <td><p class="card-admin-tel">Poste : <?= htmlspecialchars($row['position']);?></p></td>
                        <td><p class="card-admin-email">Date d'entree :  <?= htmlspecialchars($row['hire_date']);?></p></td>
                    </tr>
                </table>
            </div>  
            <?php } ?> 
            <div class="ajouter-un-administrateur">
                <a href="ajouter-une-administrateur.php">Ajouter un Administrateur</a>
                <h2>Ajout d'un administrateur</h2>
            </div>
            <div class="liste-des-administrateurs">
                <a href="liste-des-administrateurs.php">Liste des Administrateurs</a>
            </div>
        </div>
        
        <div id="divSubsidesDepenses" class="divSubsides">
            <h2>Gestion des Depenses</h2>
            <div class="ajouter-une-depense">
                <a href="ajouter-une-depense.php">Ajouter une Depense</a>
                <div class="liste-des-depenses">
                    <a href="liste-des-depenses.php">Liste des Depenses</a>
                </div>
            </div>
        </div>

        <div id="divSubsidesReservations" class="divSubsides">
            <h2>Gestion des Reservations</h2>
            <div class="ajouter-une-reservation">
                <a href="ajouter-une-reservation.php">Ajouter une Reservation</a>
            </div>
            <div class="liste-des-reservations">
                <a href="liste-des-reservations.php">Liste des Reservations</a>
            </div>
        </div>
        
        <div id="divSubsidesStocks" class="divSubsides">
            <h2>Gestion des Stocks</h2>
            <div class="ajouter-un-stock">
                <a href="ajouter-un-stock.php">Ajouter un Stock</a>
            </div>
            <div class="liste-des-stocks">
                <a href="liste-des-stocks.php">Liste des Stocks</a>
            </div>
        </div>

        <div id="divSubsidesTransactions" class="divSubsides">
            <h2>Gestion des Transactions</h2>
            <div class="ajouter-une-transaction">
                <a href="ajouter-une-transaction.php" id="show-form-1" data-active-forms="form-2,form-3,form-4,form-5,form-6,form-7,form-8,form-9">Ajouter une Transaction</a>
            </div>
            <div class="liste-des-transactions">
                <a href="liste-des-transactions.php" id="show-form-1"data-active-forms="form-2,form-3,form-4,form-5,form-6,form-7,form-8,form-9">Liste des Transactions</a>
            </div>
        </div>

        <div id="divSubsidesCommentaires" class="divSubsides">
            <h2>Gestion des Commentaires</h2>
            <div class="ajouter-un-commentaire">
                <a href="ajouter-un-commentaire.php" id="show-form-2" data-active-forms="form-1,form-3,form-4,form-5,form-6,form-7,form-8,form-9">Ajouter un Commentaire</a>
            </div>
            <div class="liste-des-commentaires">
                <a href="liste-des-commentaires.php"  id="show-form-2" data-active-forms="form-1,form-3,form-4,form-5,form-6,form-7,form-8,form-9">Liste des Commentaires</a>
            </div>
        </div>

        <div id="divSubsidesDocuments" class="divSubsides">
            <h2>Gestion des Documents</h2>
            <div class="ajouter-un-document">
                <a href="ajouter-un-document.php"id="show-form-3" data-active-forms="form-1,form-2,form-4,form-5,form-6,form-7,form-8,form-9">Ajouter un Document</a>
            </div>
            <div class="liste-des-documents">
                <a href="liste-des-documents.php" id="show-form-3" data-active-forms="form-1,form-2,form-4,form-5,form-6,form-7,form-8,form-9">Liste des Documents</a>
            </div>
        </div>

        <div id="divSubsidesEmployés" class="divSubsides">
            <h2>Gestion des Employés</h2>
            <div class="ajouter-un-employe">
                <a href="ajouter-un-employe.php"id="show-form-4" data-active-forms="form-1,form-2,form-3,form-5,form-6,form-7,form-8,form-9">Ajouter un Employé</a>
            </div>
            <div class="liste-des-employes">
                <a href="liste-des-employes.php"  id="show-form-4" data-active-forms="form-1,form-2,form-3,form-5,form-6,form-7,form-8,form-9" >Liste des Employés</a>
            </div>
        </div>
        

        <div id="divSubsidesFournisseurs" class="divSubsides">
            <h2>Gestion des Fournisseurs</h2>
            <div class="ajouter-un-fournisseur">
                <a href="ajouter-un-fournisseur.php" id="show-form-5"  data-active-forms="form-1,form-2,form-3,form-4,form-6,form-7,form-8,form-9">Ajouter un Fournisseur</a>
            </div>
            <div class="liste-des-fournisseurs">
                <a href="liste-des-fournisseurs.php"  id="show-form-5" data-active-forms="form-1,form-2,form-3,form-4,form-6,form-7,form-8,form-9">Liste des Fournisseurs</a>
            </div>
        </div>

        <div id="divSubsidesMenus" class="divSubsides">
            <h2>Gestion des Menus</h2>
            <div class="ajouter-un-menu">
                <a href="ajouter-un-menu.php" id="show-form-6" data-active-forms="form-2,form-3,form-4,form-5,form-7,form-8,form-9">Ajouter un Menu</a>
            </div>
            <div class="liste-des-menus">
                <a href="liste-des-menus.php"  id="show-form-6" data-active-forms="form-2,form-3,form-4,form-5,form-7,form-8,form-9">Liste des Menus</a>
            </div>
        </div>

            
        <div id="divSubsidesPlatsduJour" class="divSubsides">
            <h2>Gestion des Plats du Jour</h2>
            <div class="ajouter-un-plats-du-jour">
                <a href="ajouter-un-plats-du-jour.php"  id="show-form-7" data-active-forms="form-2,form-3,form-4,form-5,form-6,form-8,form-9">Ajouter un Plat du Jour</a>
            </div>
            <div class="liste-des-plats-du-jour">
                <a href="liste-des-plats-du-jour.php"  id="show-form-7" data-active-forms="form-2,form-3,form-4,form-5,form-6,form-8,form-9">Liste des Plats du Jour</a>
            </div>
        </div>

        <div id="divSubsidesPromotions" class="divSubsides">
            <h2>Gestion des Promotions</h2>
            <div class="ajouter-une-promotion">
                <a href="ajouter-une-promotion.php" id="show-form-8" data-active-forms="form-2,form-3,form-4,form-5,form-6,form-7,form-9">Ajouter une Promotion</a>
            </div>
            <div class="liste-des-promotions">
                <a href="liste-des-promotions.php"  id="show-form-8" data-active-forms="form-2,form-3,form-4,form-5,form-6,form-7,form-9">Liste des Promotions</a>
            </div>
        </div>

        <div id="divSubsidesStatistiques" class="divSubsides">
            <h2>Statistiques</h2>
            <div class="ajouter-une-statistique">
                <a href="ajouter-une-statistique.php" id="show-form-9" data-active-forms="form-1,form-2,form-3,form-4,form-5,form-6,form-7,form-8">Ajouter une Statistique</a>
            </div>
            <div class="liste-des-statistiques">
                <a href="liste-des-statistiques.php"  id="show-form-9" data-active-forms="form-1,form-2,form-3,form-4,form-5,form-6,form-7,form-8">Liste des Statistiques</a>
            </div>
        </div>
    </div>
</section>
      <!-- Pagination -->
      <ul class="pagination">
        <?php 
        // Lien vers la première page
        echo '<li class="page-item"><a class="page-link" href="index.php?page=1">&laquo;&laquo;</a></li>';

       
        $prev_page = max(1, $page - 1);
         // Lien vers la page précédente
        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $prev_page . '">&laquo;</a></li>';

        // Tranche de pagination
        $tranche = 5;
        $start_page = max(1, $page - floor($tranche / 2));
        $end_page = min($total_pages, $start_page + $tranche - 1);

        // Affichage des liens de pagination
        for ($i = $start_page; $i <= $end_page; $i++) {
            echo '<li class="page-item';
            if ($i == $page) echo ' active';
            echo '"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';
        }

        // Lien vers la page suivante
        $next_page = min($total_pages, $page + 1);
        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $next_page . '">&raquo;</a></li>';

        // Lien vers la dernière page
        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $total_pages . '">&raquo;&raquo;</a></li>';
    ?>
</ul>

</body>

</html>