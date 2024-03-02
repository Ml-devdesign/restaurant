
/////////////////////////////////////////// Div Subsides and button showStuff
//conseille pro : faire un fichier pour chaque chose donc je doit fair un fichier pour le formulaire avec un include pour le boutton qui auras lui meme un fichier tout seul dans le js pour ces different fonction   et des include pour les form ou autre  dans le ficher html qu ne contiendras finalement pas grand chose
//bien verifier le chemin lorceque la console parle de mime  
// Attend que le contenu de la page soit chargé avant d'exécuter le script
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
    const divToToggle = document.querySelectorAll('.' + divId);
    // Vérifie s'il y a des éléments correspondants
    if (divToToggle.length > 0) {
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

// Masque tous les éléments au chargement de la page
const allDivs = document.querySelectorAll('.divSubsides');
allDivs.forEach(function(div) {
    // Masque chaque élément en le rendant 'none'
    div.style.display = 'none';
});
///////////////////////////////////////// Liste de tous vos formulaires
var forms = ['form-1', 'form-2', 'form-3', 'form-4', 'form-5', 'form-6', 'form-7', 'form-8', 'form-9'];

// Fonction pour gérer le clic sur un élément de navigation
function handleClick(e) {
    e.preventDefault();

    // Supprime la classe 'active' de tous les formulaires
    forms.forEach(function(formId) {
        document.getElementById(formId).classList.remove('active');
    });

    // Ajoute la classe 'active' aux formulaires spécifiés
    var activeForms = this.getAttribute('data-active-forms').split(',');
    activeForms.forEach(function(formId) {
        document.getElementById(formId).classList.add('active');
    });
}

// Ajoute l'événement click à tous les éléments de navigation
for (var i = 1; i <= 7; i++) {
    document.getElementById('show-form-' + i).addEventListener('click', handleClick);
}
    
