"use strict";

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll('input[type="file"]').forEach(function (input) {
    console.log(input);
    input.removeAttribute("upload");
    input.addEventListener("input", function () {
      var uploaded = input.files.length > 0 ? true : false;
      input.setAttribute("upload", uploaded);
    });
  });
});