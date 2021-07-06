/**
 * @description raccourcis pour "document.querySelector"
 * @export
 * @param {*} string le contenu du querySelector
 * @return {object} le noeud séléctionné
 */
export function $(string) {
    var selector = document.querySelector(string);
    return selector;
}
/**
 * @description raccourcis pour "document.querySelectorAll"
 * @export
 * @param {*} string le contenu du querySelector
 * @return {object} les noeuds séléctionnés
 */
export function $all(string) {
    var selector = document.querySelectorAll(string);
    return selector;
}
/**
 * @description Crée un objet
 * @export
 * @param {string} name le nom de l'objet
 * @return {*} value le contenu de l'objet
 */
export function createSimpleObject(name, value) {
    var obj = {};
    obj[name] = value;
    return obj;
}
/**
 * @description envoie un formulaire en Ajax
 * @export
 * @param {*} content le contenu à transmettre
 * @param {string} appendName - le paramètre nom de la fonction 'formdata.append'
 * @param {string} treatmentFilePath le chemin du fichier de traitement du formulaire
 * @param {function} functionOk - la fonction à executer en cas de succès
 * @param {string} method - facultatif, 'POST' ou 'GET' par défault 'POST'
 */
export function submitForm(content, appendName, treatmentFilePath, functionOk, method) {
    method = method || 'POST';
    var formdata = new FormData();
    formdata.append(appendName, content);
    var ajax = new XMLHttpRequest();
    ajax.open(method, treatmentFilePath);
    ajax.onload = function () {
        if (this.status == 200) {
            var result = this.responseText;
            functionOk(result);
        } else {
            console.log('Erreur: la requête Ajax a échouée');
        }
    }
    ajax.send(formdata);
};

/* Test Ajax */
function testAjax() {
    var ajax = new XMLHttpRequest();
    ajax.onload = function () {
        console.log("Appel AJAX terminé");
        console.log("  status : " + this.status);
        console.log("  response : " + this.response);
        if (this.status == 200) {
            /* Le service a bien répondu */
            var result = this.response;
            console.log(result);
        }
    }
    /* Préparation de la requête et envoi */
    var url = "controllers/getCurrentFileName.php";
    ajax.open("POST", url, true);
    ajax.send();
};
/**
 * @description supprimer les éléments d'un tableau comprenant une certaine valeur
 * @param {*} array - le tableau
 * @param {*} value - la valeur à rechercher
 * @return {*} array - le nouveau tableau
 */
export function removeItemFromArray(array, value) {
    let lastValue = null;
    let currentValue;
    for (let i = 0; i < array.length; i++) {
        if (array[i] === value) {
            currentValue = array[i];
            array.splice(i, 1);
            if (currentValue === lastValue) {
                i = -1;
            }
            lastValue = currentValue;
        }
    }
    return array;
}
/**
 * @description inspect l'url courant pour connaître la page
 * @export
 * @param {array} array - tableau des pages existantes à comparer avec l'url
 * @return {*} value - le nom de la page 
 */
export function checkUrl(array) {
    const queryString = window.location.pathname;
    let value = 'index';
    const getLastItem = thePath => thePath.substring(thePath.lastIndexOf('/') + 1);
    let folder = getLastItem(queryString);

    array.forEach(element => {
        if (folder == element) {
            value = element;
        }
    });
    return value;
}

export function roundTo(sum, precision) {
    return Math.round(sum / precision) * precision;
}