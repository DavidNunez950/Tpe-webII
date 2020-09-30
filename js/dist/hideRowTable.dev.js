"use strict";

document.addEventListener("DOMContentLoaded", function () {
  "use strict";

  var trs = document.querySelectorAll("tbody tr");
  trs.forEach(function (tr) {
    tr.addEventListener("click", function (_) {
      tr.classList.toggle("hideTableRow");
      tr.querySelectorAll("td button");
    });
  });
});