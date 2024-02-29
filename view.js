// Div Subsides and button showStuff
const btnDisplay = document.getElementById('#btnDisplay');
const divSubsides = document.getElementById('#divSubsides');

function showStuff(divId) {
    const divToToggle = document.querySelector( divId);
    if(divToToggle.style.display === 'none' || divToToggle.style.display === "") {
        divToToggle.style.display = 'block';
    } else {
        divToToggle.style.display = 'none';
    }   
}
btnDisplay.addEventListener('click', function() {
    showStuff("#divSubsides");
});

// Liste de tous vos formulaires
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
    
