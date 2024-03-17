
<?php 
// Inclusion des fichiers de protection et de connexion à la base de données
//  include $_SERVER["DOCUMENT_ROOT"] . "/admin/include/protect.php";
require_once $_SERVER["DOCUMENT_ROOT"]. "/admin/include/connect.php";

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);//ini_set('display_errors', 1);  //au début de votre script PHP pour afficher les erreurs qui pourraient survenir.

// Définition du nombre d'éléments à afficher par page
$nbParPage = 16;

// Récupération du numéro de la page à afficher depuis les paramètres GET
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

// Vérification si le formulaire de recherche a été soumis
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
    </section>        
          
    
<section> 
<div class="container">
    <button class="btnDisplay" data-target="divSubsides" onclick="showStuff('divSubsides','divSubsides' ); return false">Gestion des Administrateurs</button>
    <button class="btnDisplay" data-target="divSubsidesDepenses" onclick="showStuff('divSubsidesDepenses','divSubsidesDepenses' ); return false">Gestion des Dépenses</button>   
    <button class="btnDisplay" data-target="divSubsidesReservations" onclick="showStuff('divSubsidesReservations','divSubsidesReservations' ); return false">Gestion des Réservations</button>  
    <button class="btnDisplay" data-target="divSubsidesStocks" onclick="showStuff('divSubsidesStocks','divSubsidesStocks' ); return false">Gestion des Stocks</button>  
    <button class="btnDisplay" data-target="divSubsidesTransactions" onclick="showStuff('divSubsidesTransactions','divSubsidesTransactions' ); return false">Gestion des Transactions</button>  
    <button class="btnDisplay" data-target="divSubsidesCommentaires" onclick="showStuff('divSubsidesCommentaires','divSubsidesCommentaires' ); return false">Gestion des Commentaires</button>  
    <button class="btnDisplay" data-target="divSubsidesDocuments" onclick="showStuff('divSubsidesDocuments','divSubsidesDocuments' ); return false">Gestion des Documents</button>  
    <button class="btnDisplay" data-target="divSubsidesEmployés" onclick="showStuff('divSubsidesEmployés','divSubsidesEmployés' ); return false">Gestion des Employés</button>  
    <button class="btnDisplay" data-target="divSubsidesFournisseurs" onclick="showStuff('divSubsidesFournisseurs','divSubsidesFournisseurs' ); return false">Gestion des Fournisseurs</button>  
    <button class="btnDisplay" data-target="divSubsidesMenus" onclick="showStuff('divSubsidesMenus','divSubsidesMenus' ); return false">Gestion des Menus</button> 
    <button class="btnDisplay" data-target="divSubsidesPlatsduJour" onclick="showStuff('divSubsidesPlatsduJour','divSubsidesPlatsduJour' ); return false">Gestion des Plats du Jour</button>  
    <button class="btnDisplay" data-target="divSubsidesPromotions" onclick="showStuff('divSubsidesPromotions','divSubsidesPromotions' ); return false">Gestion des Promotions</button>  
    <button class="btnDisplay" data-target="divSubsidesStatistiques" onclick="showStuff('divSubsidesStatistiques','divSubsidesStatistiques' ); return false">Statistiques</button>  
</div>
</section>

<section>
<div class=" tableau-de-bord">
        <h1>DashBoard</h1>
       
        <div class="divSubsides container">
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
     
        <div class="divSubsidesDepenses divSubsides">
            <h2>Gestion des Depenses</h2>
            <div class="ajouter-une-depense">
                <a href="ajouter-une-depense.php">Ajouter une Depense</a>
                <div class="liste-des-depenses">
                    <a href="liste-des-depenses.php">Liste des Depenses</a>
                </div>
            </div>
        </div>
    
        <div class="divSubsidesReservations divSubsides">
            <h2>Gestion des Reservations</h2>
            <div class="ajouter-une-reservation">
                <a href="ajouter-une-reservation.php">Ajouter une Reservation</a>
            </div>
            <div class="liste-des-reservations">
                <a href="liste-des-reservations.php">Liste des Reservations</a>
            </div>
        </div>
        
        <div class="divSubsidesStocks divSubsides">
            <h2>Gestion des Stocks</h2>
            <div class="ajouter-un-stock">
                <a href="ajouter-un-stock.php">Ajouter un Stock</a>
            </div>
            <div class="liste-des-stocks">
                <a href="liste-des-stocks.php">Liste des Stocks</a>
            </div>
        </div>

        <div class="divSubsidesTransactions divSubsides">
            <h2>Gestion des Transactions</h2>
            <div class="ajouter-une-transaction">
                <a href="ajouter-une-transaction.php" id="show-form-1" data-active-forms="form-2,form-3,form-4,form-5,form-6,form-7,form-8,form-9">Ajouter une Transaction</a>
            </div>
            <div class="liste-des-transactions">
                <a href="liste-des-transactions.php" id="show-form-1"data-active-forms="form-2,form-3,form-4,form-5,form-6,form-7,form-8,form-9">Liste des Transactions</a>
            </div>
        </div>

        <div class="divSubsidesCommentaires divSubsides">
            <h2>Gestion des Commentaires</h2>
            <div class="ajouter-un-commentaire">
                <a href="ajouter-un-commentaire.php" id="show-form-2" data-active-forms="form-1,form-3,form-4,form-5,form-6,form-7,form-8,form-9">Ajouter un Commentaire</a>
            </div>
            <div class="liste-des-commentaires">
                <a href="liste-des-commentaires.php"  id="show-form-2" data-active-forms="form-1,form-3,form-4,form-5,form-6,form-7,form-8,form-9">Liste des Commentaires</a>
            </div>
        </div>

        <div class="divSubsidesDocuments divSubsides">
            <h2>Gestion des Documents</h2>
            <div class="ajouter-un-document">
                <a href="ajouter-un-document.php"id="show-form-3" data-active-forms="form-1,form-2,form-4,form-5,form-6,form-7,form-8,form-9">Ajouter un Document</a>
            </div>
            <div class="liste-des-documents">
                <a href="liste-des-documents.php" id="show-form-3" data-active-forms="form-1,form-2,form-4,form-5,form-6,form-7,form-8,form-9">Liste des Documents</a>
            </div>
        </div>

        <div class="divSubsidesEmployés divSubsides">
            <h2>Gestion des Employés</h2>
            <div class="ajouter-un-employe">
                <a href="ajouter-un-employe.php"id="show-form-4" data-active-forms="form-1,form-2,form-3,form-5,form-6,form-7,form-8,form-9">Ajouter un Employé</a>
            </div>
            <div class="liste-des-employes">
                <a href="liste-des-employes.php"  id="show-form-4" data-active-forms="form-1,form-2,form-3,form-5,form-6,form-7,form-8,form-9" >Liste des Employés</a>
            </div>
        </div>
        

        <div class="divSubsidesFournisseurs divSubsides">
            <h2>Gestion des Fournisseurs</h2>
            <div class="ajouter-un-fournisseur">
                <a href="ajouter-un-fournisseur.php" id="show-form-5"  data-active-forms="form-1,form-2,form-3,form-4,form-6,form-7,form-8,form-9">Ajouter un Fournisseur</a>
            </div>
            <div class="liste-des-fournisseurs">
                <a href="liste-des-fournisseurs.php"  id="show-form-5" data-active-forms="form-1,form-2,form-3,form-4,form-6,form-7,form-8,form-9">Liste des Fournisseurs</a>
            </div>
        </div>

        <div class="divSubsidesMenus divSubsides">
            <h2>Gestion des Menus</h2>
            <div class="ajouter-un-menu">
                <a href="ajouter-un-menu.php" id="show-form-6" data-active-forms="form-2,form-3,form-4,form-5,form-7,form-8,form-9">Ajouter un Menu</a>
            </div>
            <div class="liste-des-menus">
                <a href="liste-des-menus.php"  id="show-form-6" data-active-forms="form-2,form-3,form-4,form-5,form-7,form-8,form-9">Liste des Menus</a>
            </div>
        </div>

         
        <div class="divSubsidesPlatsduJour divSubsides">
            <h2>Gestion des Plats du Jour</h2>
            <div class="ajouter-un-plats-du-jour">
                <a href="ajouter-un-plats-du-jour.php"  id="show-form-7" data-active-forms="form-2,form-3,form-4,form-5,form-6,form-8,form-9">Ajouter un Plat du Jour</a>
            </div>
            <div class="liste-des-plats-du-jour">
                <a href="liste-des-plats-du-jour.php"  id="show-form-7" data-active-forms="form-2,form-3,form-4,form-5,form-6,form-8,form-9">Liste des Plats du Jour</a>
            </div>
        </div>

        <div class="divSubsidesPromotions divSubsides">
            <h2>Gestion des Promotions</h2>
            <div class="ajouter-une-promotion">
                <a href="ajouter-une-promotion.php" id="show-form-8" data-active-forms="form-2,form-3,form-4,form-5,form-6,form-7,form-9">Ajouter une Promotion</a>
            </div>
            <div class="liste-des-promotions">
                <a href="liste-des-promotions.php"  id="show-form-8" data-active-forms="form-2,form-3,form-4,form-5,form-6,form-7,form-9">Liste des Promotions</a>
            </div>
        </div>

        <div class="divSubsidesStatistiques divSubsides">
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
<script  src="view.js"></script>
</html>