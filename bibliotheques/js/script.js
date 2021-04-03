// "use strict";   // Mode strict du JavaScript

// fonction JS permettant l'attente du chargement du DOM
// avant l'execution du script



document.addEventListener("DOMContentLoaded", function() {

    /* bouton retour en haut de page en pur JS
    ****************************************** */

    // détection de l'évènement de défilement de la page vers le bas
    window.onscroll = function(ev) {
        // si le défilement de la page est supérieur à 100px
        if (window.pageYOffset > 100) {
            // alors on rend le bouton "retour" visible
            document.getElementById("retour").className = "visible";
            // sinon on le laisse invisible
        } else {
            document.getElementById("retour").className = "invisible";
        };
    }

});



/*

// fonction JQuery permettant l'attente du chargement du DOM
// avant l'execution du script

$(function(){

    // 

});

*/

