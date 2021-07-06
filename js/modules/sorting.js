//import requis
import * as mod from "./base.js";
//variables globales
var inputValue = "";

// ==========================================================================
//   0. COMMON
// ==========================================================================
/**
 * @description - faire apparaître / disparaître filtres
 */
export function showAndHideFilters() {
  const list = this.parentNode.querySelector(".filter__list");
  const span = this.querySelector("span");
  if (list.classList.contains("is-displayNone")) {
    list.classList.remove("is-displayNone");
    span.classList.remove("icon-plus");
    span.classList.add("icon-minus");
  } else {
    list.classList.add("is-displayNone");
    span.classList.remove("icon-minus");
    span.classList.add("icon-plus");
  }
}
/**
 * @description les opérations à effectuer en cas de succès de requète Ajax
 * @param {*} response - la réponse du serveur
 */
function responseOK(response) {
  if (response != "") {
    let showcase = mod.$(".showcase");
    showcase.innerHTML = response;
    let query = `.sortingForm input[value='${inputValue}']`;
    let input = document.querySelector(query);
    input.checked = true;
    sortingListner();
  }
}
/**
 * @description mets à jour la variable inputValue
 */
function setInputValue() {
  const input = mod.$all(".sortingForm__content input");
  for (let i = 0; i < input.length; i++) {
    if (input[i].checked == true) {
      inputValue = input[i].value;
    }
  }
}
/**
 * @description définis les filtres à appliquer
 * @param {*} obj - l'objet qui stocke les filtres
 * @param {boolean} reset - facultatif, si == true, le filtre sont remis à zéro
 * @return {*} obj
 */
function setFilters(obj, reset) {
  obj["sorting"] = inputValue;
  if (reset == true) {
    let filterInput = mod.$all(".filters input");
    for (let i = 0; i < filterInput.length; i++) {
      if (filterInput[i].checked == true) {
        filterInput[i].checked = false;
      }
    }
    let list = mod.$all(".filter__ul");
    list.forEach((element) => {
      let name = element.parentNode.querySelector("input").name;
      let ids = new Array();
      obj[name] = ids;
    });
  } else {
    let list = mod.$all(".filter__ul");
    list.forEach((element) => {
      let name = element.parentNode.querySelector("input").name;
      let ids = new Array();
      obj[name] = ids;

      let query = `input[name='${name}']`;
      let filters = mod.$all(query);
      Object.entries(filters).forEach((entry) => {
        const [key, value] = entry;
        if (value.type == "checkbox") {
          let id = value.value;
          if (value.checked == true) {
            obj[name].push(id);
          }
        } else {
          let min = value.dataset.min;
          let max = value.dataset.max;
          if (value.checked == true) {
            obj[name].push(min);
            obj[name].push(max);
          }
        }
      });
    });
  }
  return obj;
}

// ==========================================================================
//   1. SORTING MANAGEMENT
// ==========================================================================
export function sortingListner() {
  var sortingButton = mod.$(".sortingForm__button");
  let content = mod.$(".sortingForm__content");
  let input = content.querySelectorAll("input");

  sortingButton.addEventListener("click", sortingEvent);

  function sortingEvent() {
    content.classList.add("is-displayBlock");
    for (let i = 0; i < input.length; i++) {
      input[i].onclick = next;
    }
    document.body.addEventListener(
      "click",
      function () {
        content.classList.remove("is-displayBlock");
      },
      true
    );
  }

  function next() {
    let obj = new Object();
    inputValue = this.value;
    let filters = setFilters(obj);
    filters = JSON.stringify(filters);
    sortingButton.removeEventListener("click", sortingEvent);
    mod.submitForm(
      filters,
      "sorting",
      "controllers/ControllerSorting.php",
      responseOK
    );
  }
}

// ==========================================================================
//   2. FILTER MANAGEMENT
// ==========================================================================
export function filterListener() {
  let filters = mod.$all(".filters input");
  for (let i = 0; i < filters.length; i++) {
    filters[i].onclick = next;
  }

  function next() {
    const searchInput = mod.$(".searchContainer__input");
    searchInput.value = "";
    setInputValue();
    let obj = new Object();
    let filters = setFilters(obj);
    filters = JSON.stringify(filters);
    mod.submitForm(
      filters,
      "sorting",
      "controllers/ControllerSorting.php",
      responseOK
    );
  }
}

/**
 * @description coches les filtres d'après la réponse du serveur
 */
export function checkInputFilter() {
  let obj = new Object();
  mod.submitForm(obj, "filters", "controllers/getFilters.php", checkFilters);

  function checkFilters(response) {
    if (response != "") {
      let obj = JSON.parse(response);
      console.log(obj);
      delete obj.sorting;
      const filter_price = obj.filter_price;
      delete obj.filter_price;
      if (obj.hasOwnProperty("searchQuery")) {
        const searchQuery = obj.searchQuery;
        const searchInput = mod.$(".searchContainer__input");
        searchInput.value = searchQuery;
        delete obj.searchQuery;
      }
      Object.entries(obj).forEach((entry) => {
        const [key, value] = entry;
        entry[1].forEach((cell) => {
          let selector;
          selector = `input[name='${key}'][value='${cell}']`;
          let input = document.querySelector(selector);
          input.checked = true;
        });
      });

      if (filter_price.length > 0) {
        let selector = `input[name='filter_price'][data-min='${filter_price[0]}'][data-max='${filter_price[1]}']`;
        let input = document.querySelector(selector);
        input.checked = true;
      }
    }
  }
}

// ==========================================================================
//   3. RESET MANAGEMENT
// ==========================================================================
export function resetListener() {
  let reset = mod.$(".filters__reset");
  reset.onclick = next;

  function next(e) {
    e.preventDefault();
    setInputValue();
    let obj = new Object();
    let filters = setFilters(obj, true);
    filters = JSON.stringify(filters);
    mod.submitForm(
      filters,
      "sorting",
      "controllers/ControllerSorting.php",
      responseOK
    );
  }
}

// ==========================================================================
//   4. SEARCH FORM
// ==========================================================================
export function searchListener() {
  const submitButton = mod.$(".searchContainer__button");

  submitButton.addEventListener("click", next);

  function next(e) {
    e.preventDefault();
    let searchQuery = document.querySelector(".searchContainer__input").value;
    let wordArray = searchQuery.split(" ");
    let newWordArray = mod.removeItemFromArray(wordArray, "");
    newWordArray = removeItem(newWordArray);
    let obj = new Object();
    obj["searchQuery"] = newWordArray;
    setInputValue();
    let filters = setFilters(obj, true);
    filters = JSON.stringify(filters);
    mod.submitForm(
      filters,
      "sorting",
      "controllers/ControllerSorting.php",
      responseOK
    );
  }

  function removeItem(array) {
    for (let i = 0; i < array.length; i++) {
      array[i] = array[i].toLowerCase();
      if (array[i].length < 3) {
        array.splice(i, 1);
        i = -1;
      } else if (array[i] == "des" || array[i] == "les") {
        array.splice(i, 1);
        i = -1;
      }
    }
    return array;
  }
}
/**
 * @description Supprime la requête de recherche
 * @export
 */
export function deleteSearchInput() {
  const deleteButton = mod.$(".searchContainer__delete");
  const searchInput = mod.$(".searchContainer__input");
  deleteButton.addEventListener("click", reset);

  function reset(e) {
    searchInput.value = "";
    let obj = new Object();
    obj["searchQuery"] = "";
    let filters = setFilters(obj, true);
    filters = JSON.stringify(filters);
    mod.submitForm(
      filters,
      "sorting",
      "controllers/ControllerSorting.php",
      responseOK
    );
  }
}
