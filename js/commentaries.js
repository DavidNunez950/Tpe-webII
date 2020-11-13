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
            "headers": {"Content-type" : "application/json"}
        })
        .then(r => getCommentaries())
        .catch(error => console.log(error));
    }

    function updateComentary(obj, id) {
        console.log(JSON.stringify(obj))
        fetch(url + id, {
            "method": "PUT",
            "headers": {"Content-type" : "application/json"},
            "body": JSON.stringify(obj)
        })
        .catch(error => console.log(error));
    }

    function insertCommentary(obj) {
        fetch(url, {
            "method": "POST",
            "headers": {"Content-type" : "application/json"},
            "body": JSON.stringify(obj)
        })
        .then(r => r.json())
        .then( commentary => {
            app.commentaries.push(commentary)
        })
        .catch(error => console.log(error));
    }

    // Añadir eventos
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
    form.addEventListener("submit", e=> {
        e.preventDefault();
        console.log(form.querySelector('input[type="text"]'));
        console.log(form.querySelector('input[type="radio"]:checked'));
        let date = new Date();
        let dateS = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+ date.getDate();
        console.log(dateS);
        let obj = {
            "text": form.querySelector('input[type="text"]').value,
            "star": form.querySelector('input[type="radio"]:checked').value,
            "date": dateS,
            "id_product": form.getAttribute("data-id-product"),
            "id_user": "1",
        }
        insertCommentary(obj);
    });


    // Vue js
    let app = new Vue({
        el: '#commentary',
        data: {
            commentaries: []
        },
        methods: {
            remove: function (event) {
                let btn = event.target;
                deleteCommentary(btn.parentElement.getAttribute("data-id-commentary"));
            },
            edit: function (event) {
                let btn = event.target;
                let div = btn.previousElementSibling.previousElementSibling;
                console.log((div))
                div.contentEditable = (!div.contentEditable) ? true : false;
                if (div.contentEditable == false){
                    let text = div.innerHTML;
                    updateComentary({text: text.trim("\n"), star: 5},btn.parentElement.getAttribute("data-id-commentary"));
                }
            }
        }
    });

});