
/////////////////////////////////////////// Div Subsides and button showStuff
//conseille pro : faire un fichier pour chaque chose donc je doit fair un fichier pour le formulaire avec un include pour le boutton qui auras lui meme un fichier tout seul dans le js pour ces different fonction   et des include pour les form ou autre  dans le ficher html qu ne contiendras finalement pas grand chose
//bien verifier le chemin lorceque la console parle de mime  
document.addEventListener("DOMContentLoaded", function() {
    const btnDisplay = document.querySelectorAll('div.btnDisplay');

    btnDisplay.forEach(function(button) {
        button.addEventListener('click', function() {
            const targetId = button.getAttribute('data-target');
            showStuff(targetId);
        });
    });
});

/////////////////////////////////////////// Div Subsides and button showStuff
// const btnDisplay = document.getElementById('btnDisplay');
// const divSubsides = document.getElementById('#divSubsidesDepenses');


//pour les container et non pour les bouton un queryselector(all) avec foreach
function showStuff(divId) {
    const divToToggle = document.querySelectorAll(divId);
    if(divToToggle.style.display === 'none' || divToToggle.style.display === "") {
        divToToggle.style.display = 'block';
    } else {
        divToToggle.style.display = 'none';
    }   
}
btnDisplay.addEventListener('click', function() {
    showStuff("divSubsides");
});

// const btnDisplay = document.getElementById('#btnDisplay');
// const divSubsidesDepenses = document.getElementById('divSubsidesDepenses');
// const divSubsidesReservations = document.getElementById('divSubsidesReservations');
// const divSubsidesStocks = document.getElementById('divSubsidesStocks');
// const divSubsidesTransactions = document.getElementById('divSubsidesTransactions');
// const divSubsidesCommentaires = document.getElementById('divSubsidesCommentaires');
// const divSubsidesDocuments = document.getElementById('divSubsidesDocuments');
// const divSubsidesEmployés = document.getElementById('divSubsidesEmployés');
// const divSubsidesFournisseurs = document.getElementById('divSubsidesFournisseurs');
// const divSubsidesMenus = document.getElementById('divSubsidesMenus');
// const divSubsidesPlatsduJour = document.getElementById('divSubsidesPlatsduJour');
// const divSubsidesPromotions = document.getElementById('divSubsidesPromotions');
// const divSubsidesStatistiques = document.getElementById('divSubsidesStatistiques');



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
    
