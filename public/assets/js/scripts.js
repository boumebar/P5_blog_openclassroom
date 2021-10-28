
(function () {
    "use strict";
  
    //  Récupérer tous les formulaires auxquels nous voulons appliquer des styles de validation Bootstrap personnalisés
    var forms = document.querySelectorAll(".needs-validation");
  
    // Boucle sur eux et empêche la soumission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener("submit", function (event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
  
          form.classList.add("was-validated");
        }, false);
      });
  })();