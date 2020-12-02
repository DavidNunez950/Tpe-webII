document.addEventListener('DOMContentLoaded', () => {
    "use strict"
    const url = "api/commentary/";
    const form = document.getElementById("form-commentary");

    getCommentaries();

    // funciones de la api
    function getCommentaries() {
        let id = form.getAttribute("data-id-product");
        fetch(url + id)
            .then(response => response.json())
            .then(commentaries => app.commentaries = commentaries)
            .catch(error => console.log(error));
    }


    function deleteCommentary(id) {
        fetch(url + id, {
                "method": "DELETE",
                "headers": { "Content-type": "application/json" }
            })
            .then(r => getCommentaries())
            .catch(error => console.log(error));
    }

    function updateComentary(obj, id) {
        console.log(JSON.stringify(obj))
        fetch(url + id, {
                "method": "PUT",
                "headers": { "Content-type": "application/json" },
                "body": JSON.stringify(obj)
            })
            .catch(error => console.log(error));
    }

    function insertCommentary(obj) {
        console.log(JSON.stringify(obj));
        fetch(url, {
                "method": "POST",
                "headers": { "Content-type": "application/json" },
                "body": JSON.stringify(obj)
            })
            .then(r => r.json())
            .then(commentary => {
                app.commentaries.push(commentary)
            })
            .catch(error => console.log(error));
        console.log(app.commentaries);
    }

    // Capturar el evento sumbit, armar los datos, y llamar a la api
    form.addEventListener("submit", e => {
        e.preventDefault();
        console.log(form.querySelector('input[type="text"]'));
        console.log(form.querySelector('input[type="radio"]:checked'));
        let date = new Date();
        let anio = date.getFullYear();
        let mes = date.getMonth() + 1;
        let dia = (date.getDate() > 9) ? date.getDate() : "0" + date.getDate();
        let dateS = anio + "-" + mes + "-" + dia;
        console.log(dateS);
        let obj = {
            "text": form.querySelector('input[type="text"]').value,
            "star": form.querySelector('input[type="radio"]:checked').value,
            "date": dateS,
            "id_product": form.getAttribute("data-id-product"),
            "id_user": "0",
        }
        console.log(obj);
        insertCommentary(obj);
    })

    Vue.component('app-input-star', {
        props: ['value', 'commentaryid'],
        template: `
        <div>
            <input v-bind:name="commentaryid" type="radio" v-bind:value="value">
            <label v-bind:for="commentaryid" class="mr-1">
                <i class="fas fa-star" v-on:click="$emit('click-star', $event)" ></i>
            </label>
        </div>`
    })

    let menuBtn = Vue.component('app-menu-btn', {
        props: ['displaybtnremove', 'commentaryid', 'displaybtnedit'],
        template: `
        <div v-if="displaybtnedit || displaybtnremove">
            <button type="button" class="btn  btn-outline-secondary border-white rounded-circle" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-min">
                <button class="btn" v-if="displaybtnremove">Borrar
                    <div class="btn btn-danger rounded-circle">
                        <i class="fas fa-trash-alt btn-delete" v-on:click="$emit('event-remove', $event)" v-bind:data-id-commentary="commentaryid"></i>
                    </div>
                </button>
                <button class="btn" v-if="displaybtnedit">Editar
                    <div class="btn btn-primary rounded-circle">
                        <i class="far fa-edit btn-edit" v-on:click="$emit('start-edit', $event)" v-bind:data-id-commentary="commentaryid"></i>
                    </div>
                </button>
            </div>
        </div>`,
    })

    Vue.component('app-commentary-text', {
        props: ['commentaryid', 'commentarytext', "editCommentary"],
        template: `
        <div>
            <div class="d-flex justify-content-between" v-bind:text-commentary="commentaryid">
                <div class="text-break" contentEditable="false">
                    {{commentarytext}}
                </div>
                <button v-if="editCommentary == true" class="btn rounded-circle p-0">
                    <div class="btn btn-primary  rounded-circle">
                        <i class="fas fa-paper-plane" v-bind:data-id-commentary="commentaryid" v-on:click="$emit('finish-edit', $event)"></i>
                    </div>
                </button>
            </div>
        </div>`
    })

    // Vue js
    Vue.component('app-list-commentaries', {
        props: ['commentaryid', 'commentary', 'rolcolab', 'roladmin', 'userid'],
        data: function() {
            return {
                editCommentary: false
            }
        },
        template: `
        <li class="list-group-item d-flex flex-row justify-content-between commentary" v-bind:data-id-commentary="commentary.id" v-bind:data-id-user="commentary.id_user">
            <div class="w-100">
                <div  class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <samp class="mr-2">
                            <i class="fas fa-user-circle icon-user"></i>
                        </samp>
                        <h6 class="pr-3">
                            <a v-bind:href="'users/' + commentary.id_user" class="text-dark">{{commentary.name}}</a>
                        </h6>
                        <div class="form-group clasificacion pt-3 d-flex flex-row flex-nowrap pr-5">
                            <app-input-star v-for="i in 5" v-bind:value="6-i" v-bind:commentaryid="commentary.id" v-bind:class="{'mark-star' : commentary.star == (6-i)}" v-on:click-star="markStars" ></app-input-star>
                        </div>
                    </div>
                    <div class="dropdown">
                        <app-menu-btn v-if="editCommentary == false" v-bind:displaybtnremove="(commentary.id_user == userid)" v-bind:displaybtnedit="(commentary.id_user == userid) && editCommentary == false" v-bind:commentaryid="commentary.id" v-bind:commentary.userid="commentary.id_user" v-on:start-edit="edtiCommentary" v-bind:userid="commentary.id_user"  v-on:event-remove="deleteCommentary"></app-menu-btn>
                    </div>
                </div>
                <app-commentary-text v-bind:editCommentary="editCommentary" v-bind:commentaryid="commentary.id" v-bind:commentarytext="commentary.text" v-on:finish-edit="edtiCommentary"></app-commentary-text>
            </div>
        </li>`,
        methods: {
            deleteCommentary: function(event) {
                let btn = event.target;
                deleteCommentary(btn.getAttribute("data-id-commentary"));
            },
            edtiCommentary: function(event) {
                this.editCommentary = (this.editCommentary) ? false : true;
                let btn = event.target;
                let li = document.querySelector('li[data-id-commentary="' + btn.getAttribute("data-id-commentary") + '"]');
                let div = li.firstChild.lastChild.firstChild.firstChild;
                this.markStars({ 'target': li.querySelector('.mark-star').lastChild.firstChild });
                if (this.editCommentary) {
                    div.contentEditable = 'true';
                } else {
                    console
                    div.contentEditable = 'false';
                    let text = div.innerHTML;
                    this.editCommentary = false;
                    updateComentary({ text: text.trim("\n"), star: li.querySelector('input[type="radio"]:checked').value }, btn.getAttribute("data-id-commentary"));
                }
            },
            markStars: function(event) {
                console.log(event)
                if (this.editCommentary) {
                    let label = event.target.parentElement.parentElement;
                    label.parentElement.querySelectorAll("div").forEach(div => {
                        div.classList.remove("mark-star");
                    });
                    label.classList.add("mark-star");
                    label.firstChild.setAttribute('checked', 'true');
                }
            }
        }
    });

    let app = new Vue({
        el: '#commentary',
        data: {
            commentaries: [],
        }
    });

});