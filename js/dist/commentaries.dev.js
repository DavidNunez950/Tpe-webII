"use strict";

document.addEventListener('DOMContentLoaded', function () {
  "use strict";

  var url = "api/commentary/";
  var form = document.getElementById("form-commentary");
  getCommentaries(); // funciones de la api

  function getCommentaries() {
    var id = form.getAttribute("data-id-product");
    fetch(url + id).then(function (response) {
      return response.json();
    }).then(function (commentaries) {
      return app.commentaries = commentaries;
    })["catch"](function (error) {
      return console.log(error);
    });
  }

  function deleteCommentary(id) {
    fetch(url + id, {
      "method": "DELETE",
      "headers": {
        "Content-type": "application/json"
      }
    }).then(function (r) {
      return getCommentaries();
    })["catch"](function (error) {
      return console.log(error);
    });
  }

  function updateComentary(obj, id) {
    console.log(JSON.stringify(obj));
    fetch(url + id, {
      "method": "PUT",
      "headers": {
        "Content-type": "application/json"
      },
      "body": JSON.stringify(obj)
    })["catch"](function (error) {
      return console.log(error);
    });
  }

  function insertCommentary(obj) {
    fetch(url, {
      "method": "POST",
      "headers": {
        "Content-type": "application/json"
      },
      "body": JSON.stringify(obj)
    }).then(function (r) {
      return r.json();
    }).then(function (commentary) {
      app.commentaries.push(commentary);
    })["catch"](function (error) {
      return console.log(error);
    });
  } // Añadir eventos
  // function addEventsBtn() {
  //     document.querySelectorAll(".btn-delete").forEach(btn => {
  //         btn.addEventListener("click", () => {
  //             deleteCommentary(btn.parentElement.getAttribute("data-id-commentary"));
  //         });
  //     });
  //     document.querySelectorAll(".btn-edit").forEach(btn => {
  //         btn.addEventListener("click", () => {
  //             btn.parentElement.contentEditable = true;
  //             btn.addEventListener("click", () => {
  //                 btn.parentElement.contentEditable = false;
  //                 let text = btn.previousElementSibling.previousElementSibling.innerHTML;
  //                 updateComentary({text: text.trim("\n"), star: 5},btn.parentElement.getAttribute("data-id-commentary"));
  //             });
  //         });
  //     });
  // }
  // Capturar el evento sumbit, armar los datos, y llamar a la api


  form.addEventListener("submit", function (e) {
    e.preventDefault();
    console.log(form.querySelector('input[type="text"]'));
    console.log(form.querySelector('input[type="radio"]:checked'));
    var date = new Date();
    var dateS = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
    console.log(dateS);
    var obj = {
      "text": form.querySelector('input[type="text"]').value,
      "star": form.querySelector('input[type="radio"]:checked').value,
      "date": dateS,
      "id_product": form.getAttribute("data-id-product"),
      "id_user": "1"
    };
    insertCommentary(obj);
  }); // Vue js

  var app = new Vue({
    el: '#commentary',
    data: {
      commentaries: []
    },
    methods: {
      remove: function remove(event) {
        var btn = event.target;
        deleteCommentary(btn.parentElement.getAttribute("data-id-commentary"));
      },
      edit: function edit(event) {
        var btn = event.target;
        var div = btn.previousElementSibling.previousElementSibling;
        div.contentEditable = !div.contentEditable ? true : true;

        if (div.contentEditable == false) {
          div.contentEditable = true;
          var text = div.innerHTML;
          updateComentary({
            text: text.trim("\n"),
            star: 5
          }, btn.parentElement.getAttribute("data-id-commentary"));
        }
      }
    }
  });
});