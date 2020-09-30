document.addEventListener("DOMContentLoaded", function () {
    "use strict";
    let trs = document.querySelectorAll("tbody tr");
    trs.forEach(tr => {
        tr.addEventListener("click", _ => {
            tr.classList.toggle("hideTableRow")
            tr.querySelectorAll("td button")
        });
    });
});