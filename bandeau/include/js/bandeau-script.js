

let bandeau = document.querySelector('#bandeau');

let message = document.querySelector('.center');


let i=0;

function triggerDataSendingAjax() {
    // Code pour déclencher la requête AJAX
    jQuery.ajax({
        url: banniereAjax.ajaxurl,
        type: 'POST',
        data: {
            action: 'dataSending', // Action enregistrée dans wp_ajax_nopriv_{action}
            // Autres paramètres nécessaires pour votre plugin
        },
        success: function(response) {
            // Traitement de la réponse    
            apparition(response);
        },
        error: function(error) {
            console.log(error.responseText);
         
        }
    });
}

//Appel de la fonction lors du chargement du document
jQuery(document).ready(function($) {
    triggerDataSendingAjax();
});

/**
 * gere l'appararition de depart du bandeau
 */

function apparition(response) {

    var information = response;
    
    setTimeout(function() {
        $("#bandeau").removeClass("cached");
        $(".center").html(information[i]);
        $("#bandeau").addClass("visible").fadeIn(1000);
       
    }, 100);

    loopMessage(information);
}

/**
 * gere l'affichage dynamique tout les 5s
 */
function loopMessage(information) {
    var i = 0; // Assurez-vous que la variable i est déclarée et initialisée ici

    setInterval(function() {
        if (i < (information.length - 1)) {
            i++;
        } else {
            i = 0;
        }
        
        $(".center").html(information[i]);
        
    }, 5000);
}


