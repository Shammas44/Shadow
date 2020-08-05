$(document).ready(function () {
    console.log("ready!");

    $("#filtres input[data-check='true']").prop('checked', true);
    $("#trie-produits").load('php/vitrine.php');

    //faire apparaître/disparaître filtres
    $(".filtre").click(function () {
        if ($(this).hasClass("is-displayBlock")) {
            $(this).siblings(".filtre_liste").addClass("is-displayNone");
            $(this).removeClass("is-displayBlock");
            $(this).siblings(".search-container-marque").addClass("is-displayNone");
        } else {
            $(this).removeClass("is-displayNone");
            $(this).addClass("is-displayBlock");
            $(this).siblings(".filtre_liste").removeClass("is-displayNone");
            $(this).siblings(".search-container-marque").removeClass("is-displayNone");
        }
    });
    //check la première radiobox
    $("#get_image_details input:first-child").prop('checked', true);

    //changer d'image sur la page produit
    $("#get_image_details div").click(function () {
        var style = $(this).attr('style');
        $("#img_showcase").attr('style', style);
    });

    //envoyer le formulaire filtre-type
    $("input[name=filtre-type]").click(function () {
        var type = $(this).attr('value');
        if ($(this).is(":checked")) {
            var statut = true;
        } else if ($(this).prop("checked") == false) {
            var statut = false;
        }
        $("#trie-produits").load("php/vitrine.php", {
            selected_type: type,
            selected_type_statut: statut
        });
    });

    //envoyer le formulaire filtre-echelle
    $("input[name=filtre-echelle]").click(function () {
        var echelle_min = $(this).attr('data-min');
        var echelle_max = $(this).attr('data-max');
        if ($(this).is(":checked")) {
            var statut = true;
        } else if ($(this).prop("checked") == false) {
            var statut = false;
        }
        $("#trie-produits").load("php/vitrine.php", {
            selected_echelle_min: echelle_min,
            selected_echelle_max: echelle_max,
            selected_echelle_statut: statut
        });
    });

    //envoyer le formulaire filtre-marque
    $("input[name=filtre-marque]").click(function () {
        var marque = $(this).attr('value');
        if ($(this).is(":checked")) {
            var statut = true;
        } else if ($(this).prop("checked") == false) {
            var statut = false;
        }
        $("#trie-produits").load("php/vitrine.php", {
            selected_marque: marque,
            selected_marque_statut: statut
        });
    });

    //envoyer le formulaire filtre-couleur
    $("input[name=filtre-couleur]").click(function () {
        var couleur = $(this).attr('value');
        if ($(this).is(":checked")) {
            var statut = true;
        } else if ($(this).prop("checked") == false) {
            var statut = false;
        }
        $("#trie-produits").load("php/vitrine.php", {
            selected_couleur: couleur,
            selected_couleur_statut: statut
        });
    });

    //envoyer le formulaire filtre-matiere
    $("input[name=filtre-matiere]").click(function () {
        var matiere = $(this).attr('value');
        if ($(this).is(":checked")) {
            var statut = true;
        } else if ($(this).prop("checked") == false) {
            var statut = false;
        }
        $("#trie-produits").load("php/vitrine.php", {
            selected_matiere: matiere,
            selected_matiere_statut: statut
        });
    });

    //recharger le btn panier du header
    // $("#produit_panier input[type=submit]").click(function () {
    //     $(".btnPanier").load(" .btnPanier");
    //     console.log("loaded");
    // })

});