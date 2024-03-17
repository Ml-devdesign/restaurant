
/////////////////////////////////////////// Div Subsides and button showStuff

/**********ConseiL pro -->
 * Structuration des Fichiers  de manière logique et modulaire
Créez un fichier séparé pour chaque composant ou fonctionnalité.
Par exemple :
formulaire.html : Contient le formulaire.
bouton.js : Gère les fonctionnalités du bouton.
autres.js : Pour d’autres fonctionnalités spécifiques.
Utilisez des inclusions (comme des import ou des require) pour rassembler 
ces fichiers au besoin.

Vérification des Chemins :
Vérifiez que les noms de fichiers et les dossiers sont orthographiés correctement et correspondent à la structure de votre projet.
Si la console affiche des erreurs liées au mime type, cela peut signifier que le navigateur ne peut pas charger le fichier en raison d’un problème de chemin ou de configuration du serveur. Assurez-vous que le serveur est correctement configuré pour servir les fichiers statiques (comme les fichiers CSS et JS) avec les bons types MIME.
*/

/*********DOMContentLoaded -->
Pour vous assurer que votre script JavaScript s’exécute après que 
le contenu de la page ait été chargé, 
placez votre code dans un gestionnaire d’événements DOMContentLoaded
Cela garantit que votre script ne s’exécute qu’une fois que la page HTML est complètement chargée.
*/ 

// Masque tous les éléments au chargement de la page
const allDivs = document.querySelectorAll('.divSubsides');
allDivs.forEach(function(div) {
    // Masque chaque élément en le rendant 'none'
    div.style.display = 'none';
});

document.addEventListener("DOMContentLoaded", function() {
    // Sélectionne tous les éléments avec la classe '.btnDisplay' (boutons)
    const btnDisplay = document.querySelectorAll('.btnDisplay');

    // Ajoute un écouteur d'événements à chaque bouton
    btnDisplay.forEach(function(button) {
        button.addEventListener('click', function() {
            // Récupère l'ID cible depuis l'attribut 'data-target' du bouton
            const targetId = button.getAttribute('data-target');
            // Appelle la fonction showStuff avec l'ID cible en paramètre
            showStuff(targetId);
        });
    });
});

// Fonction pour afficher ou masquer les éléments en fonction de leur ID
function showStuff(divId) {
    // Sélectionne tous les éléments avec la classe correspondant à l'ID fourni
    const divToToggle = document.querySelectorAll('#' + divId);
    // Vérifie s'il y a des éléments correspondants
    if (divToToggle.length > 0) {//toggle tous les éléments avec la classe correspondant à l'ID fourni a voir aussi les classe listes
        // Parcourt tous les éléments correspondants
        divToToggle.forEach(function(element) {
            // Vérifie l'état actuel de l'élément (affiché ou masqué)
            if (element.style.display === 'none' || element.style.display === "") {
                // Si l'élément est masqué, le rendre visible
                element.style.display = 'block';
            } else {
                // Sinon, masquer l'élément
                element.style.display = 'none';
            }
        });
    } else {
        // Affiche un message d'erreur si aucun élément correspondant n'est trouvé
        console.error("Element with class '" + divId + "' not found.");
    }
}


///////////////////////////////////////// Liste de tous vos formulaires
// var forms = ['form-1', 'form-2', 'form-3', 'form-4', 'form-5', 'form-6', 'form-7', 'form-8', 'form-9'];

// // Fonction pour gérer le clic sur un élément de navigation
// function handleClick(e) {
//     e.preventDefault();

//     // Supprime la classe 'active' de tous les formulaires
//     forms.forEach(function(formId) {
//         document.getElementById(formId).classList.remove('active');
//     });

//     // Ajoute la classe 'active' aux formulaires spécifiés
//     var activeForms = this.getAttribute('data-active-forms').split(',');
//     activeForms.forEach(function(formId) {
//         document.getElementById(formId).classList.add('active');
//     });
// }

// // Ajoute l'événement click à tous les éléments de navigation
// for (var i = 1; i <= 7; i++) {
//     document.getElementById('show-form-' + i).addEventListener('click', handleClick);
// }
    
