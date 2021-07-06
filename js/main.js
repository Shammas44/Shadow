import { checkUrl } from "./modules/base.js";
let pagesNames = ["produit", "connexion", "panier", "commande"];
let pageName = checkUrl(pagesNames);

(function checkIfready() {
  if (document.readyState !== "loading") {
    ready();
  } else {
    document.addEventListener("DOMContentLoaded", ready);
  }
})();

function ready() {
  console.log("document ready");
  switch (pageName) {
    case "index":
      Promise.all([
        import("./modules/base.js"),
        import("./modules/sorting.js"),
        import("./modules/breakpoints.js"),
      ]).then(([mod, mod_sorting, mod_breakpoints]) => {
        (function filterEvent() {
          var filterButton = mod.$all(".filter");
          for (var i = 0; i < filterButton.length; i++)
            filterButton[i].onclick = mod_sorting.showAndHideFilters;
        })();
        let checkbox = mod.$(".sortingForm input");
        checkbox.checked = true;
        mod_sorting.checkInputFilter();
        mod_sorting.sortingListner();
        mod_sorting.filterListener();
        mod_sorting.resetListener();
        mod_sorting.searchListener();
        mod_sorting.deleteSearchInput();
        mod_breakpoints.filter();
      });
      break;
  }
}
