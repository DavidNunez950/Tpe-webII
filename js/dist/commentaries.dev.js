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

  function _deleteCommentary(id) {
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
    ;
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
  } // Capturar el evento sumbit, armar los datos, y llamar a la api


  form.addEventListener("submit", function (e) {
    e.preventDefault();
    var date = new Date();
    var anio = date.getFullYear();
    var mes = date.getMonth() + 1;
    var dia = date.getDate() > 9 ? date.getDate() : "0" + date.getDate();
    var dateS = anio + "-" + mes + "-" + dia;
    var obj = {
      "text": form.querySelector('input[type="text"]').value,
      "star": form.querySelector('input[type="radio"]:checked').value,
      "date": dateS,
      "id_product": form.getAttribute("data-id-product"),
      "id_user": "0"
    };
    insertCommentary(obj);
  });
  Vue.component('app-input-star', {
    props: ['value', 'commentaryid'],
    template: "\n        <div>\n            <input v-bind:name=\"commentaryid\" type=\"radio\" v-bind:value=\"value\">\n            <label class=\"mr-1\" v-bind:for=\"commentaryid\">\n                <i class=\"fas fa-star\" v-on:click=\"$emit('click-star', $event)\" ></i>\n            </label>\n        </div>"
  });
  var menuBtn = Vue.component('app-menu-btn', {
    props: ['displaybtnremove', 'commentaryid', 'displaybtnedit'],
    template: "\n        <div v-if=\"displaybtnedit || displaybtnremove\">\n            <button type=\"button\" class=\"btn  btn-outline-secondary border-white rounded-circle\" data-toggle=\"dropdown\" aria-haspopup=\"false\" aria-expanded=\"false\">\n                <i class=\"fas fa-ellipsis-h\"></i>\n            </button>\n            <div class=\"dropdown-menu dropdown-menu-right dropdown-menu-min\">\n                <button class=\"btn\" v-if=\"displaybtnremove\">Borrar\n                    <div class=\"btn btn-danger rounded-circle\">\n                        <i class=\"fas fa-trash-alt btn-delete\" \n                            v-on:click=\"$emit('event-remove', $event)\" \n                            v-bind:data-id-commentary=\"commentaryid\"\n                        ></i>\n                    </div>\n                </button>\n                <button class=\"btn\" v-if=\"displaybtnedit\">Editar\n                    <div class=\"btn btn-primary rounded-circle\">\n                        <i class=\"far fa-edit btn-edit\" \n                            v-on:click=\"$emit('start-edit', $event)\" \n                            v-bind:data-id-commentary=\"commentaryid\"\n                        ></i>\n                    </div>\n                </button>\n            </div>\n        </div>"
  });
  Vue.component('app-commentary-text', {
    props: ['commentaryid', 'commentarytext', "editCommentary"],
    template: "\n        <div>\n            <div class=\"d-flex justify-content-between\">\n                <div class=\"text-break\" contentEditable=\"false\">\n                    {{commentarytext}}\n                </div>\n                <button class=\"btn rounded-circle p-0\" v-if=\"editCommentary == true\">\n                    <div class=\"btn btn-primary  rounded-circle\">\n                        <i class=\"fas fa-paper-plane\" \n                        v-bind:data-id-commentary=\"commentaryid\" \n                        v-on:click=\"$emit('finish-edit', $event)\"></i>\n                    </div>\n                </button>\n            </div>\n        </div>"
  }); // Vue js

  Vue.component('app-list-commentaries', {
    props: ['commentaryid', 'commentary', 'rolcolab', 'roladmin', 'userid'],
    data: function data() {
      return {
        editCommentary: false
      };
    },
    template: "\n        <li class=\"list-group-item\" \n            v-bind:data-id-commentary=\"commentary.id\" \n            v-bind:data-id-user=\"commentary.id_user\">\n            <div class=\"w-100\">\n                <div  class=\"d-flex align-items-center justify-content-between\">\n                    <div class=\"d-flex align-items-center\">\n                        <samp class=\"mr-2\">\n                            <i class=\"fas fa-user-circle icon-user\"></i>\n                        </samp>\n                        <h6 class=\"pr-3\">\n                            <a class=\"text-dark\" v-bind:href=\"'users/' + commentary.id_user\">\n                                {{commentary.name}}\n                            </a>\n                        </h6>\n                        <div class=\"form-group clasificacion pt-3 d-flex flex-row flex-nowrap pr-5\">\n                            <app-input-star \n                                v-for=\"i in 5\" \n                                v-bind:value=\"6-i\" \n                                v-bind:commentaryid=\"commentary.id\" \n                                v-bind:class=\"{'mark-star' : commentary.star == (6-i)}\" \n                                v-on:click-star=\"markStars\"\n                                v-bind:key=\"i\"\n                            ></app-input-star>\n                        </div>\n                    </div>\n                    <div class=\"dropdown\">\n                        <app-menu-btn \n                            v-if=\"editCommentary == false\" \n                            v-bind:displaybtnremove=\"(commentary.id_user == userid)\" \n                            v-bind:displaybtnedit=\"(commentary.id_user == userid) && editCommentary == false\" \n                            v-bind:commentaryid=\"commentary.id\" v-bind:commentary.userid=\"commentary.id_user\" \n                            v-on:start-edit=\"edtiCommentary\" v-bind:userid=\"commentary.id_user\"  \n                            v-on:event-remove=\"deleteCommentary\"\n                        ></app-menu-btn>\n                    </div>\n                </div>\n                <app-commentary-text \n                    v-bind:editCommentary=\"editCommentary\"\n                    v-bind:commentaryid=\"commentary.id\" \n                    v-bind:commentarytext=\"commentary.text\" \n                    v-on:finish-edit=\"edtiCommentary\"\n                ></app-commentary-text>\n            </div>\n        </li>",
    methods: {
      deleteCommentary: function deleteCommentary(event) {
        var btn = event.target;

        _deleteCommentary(btn.getAttribute("data-id-commentary"));
      },
      edtiCommentary: function edtiCommentary(event) {
        this.editCommentary = this.editCommentary ? false : true;
        var btn = event.target;
        var li = document.querySelector('li[data-id-commentary="' + btn.getAttribute("data-id-commentary") + '"]');
        var div = li.firstChild.lastChild.firstChild.firstChild;
        this.markStars({
          'target': li.querySelector('.mark-star').lastChild.firstChild
        });

        if (this.editCommentary) {
          div.contentEditable = 'true';
        } else {
          div.contentEditable = 'false';
          var text = div.innerHTML;
          this.editCommentary = false;
          updateComentary({
            text: text.trim("\n"),
            star: li.querySelector('input[type="radio"]:checked').value
          }, btn.getAttribute("data-id-commentary"));
        }
      },
      markStars: function markStars(event) {
        if (this.editCommentary) {
          var label = event.target.parentElement.parentElement;
          label.parentElement.querySelectorAll("div").forEach(function (div) {
            div.classList.remove("mark-star");
          });
          label.classList.add("mark-star");
          label.firstChild.setAttribute('checked', 'true');
        }
      }
    }
  });
  var app = new Vue({
    el: '#commentary',
    data: {
      commentaries: []
    }
  });
});