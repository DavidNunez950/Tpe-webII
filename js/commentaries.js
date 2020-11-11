document.addEventListener('DOMContentLoaded', () => {
    "use strict"

    const url = "api/commentary/";
    const form = document.getElementById("form-commentary");
    const ul = document.querySelector("ul");

    getCommentaries();

    function getCommentaries() {
        let id = form.getAttribute("data-id-product");
        fetch(url + id)
            .then(response => response.json())
            .then(commentary => app.commentaries = commentary)
            .catch(error => console.log(error));
    }

    function deleteCommentary() {
        id = form.getAttribute("data-id-product");
        fetch(url + id)
            .then(response => response.json())
            .then(commentary => app.commentaries = commentary)
            .catch(error => console.log(error));
    }


    let app = new Vue({
        el: '#commentary',
        data: {
            commentaries: []
        }
    });


    // getTasks();

    // document.querySelector('#form-task').addEventListener('submit', e => {
    //     // evita el envio del form default
    //     e.preventDefault();

    //     addTask();
    // });



    // function getTasks() {
    //     fetch('api/tareas')
    //         .then(response => response.json())
    //         .then(tareas => app.tasks = tareas)
    //         .catch(error => console.log(error));
    // }

    // function addTask() {

    //     const task = {
    //         title: document.querySelector('input[name="input_title"]').value,
    //         description: document.querySelector('input[name="input_description"]').value,
    //         completed: document.querySelector('input[name="input_completed"]').checked,
    //         priority: document.querySelector('input[name="input_priority"]').value
    //     }

    //     fetch('api/tareas', {
    //             method: 'POST',
    //             headers: { "Content-Type": "application/json" },
    //             body: JSON.stringify(task)
    //         })
    //         .then(response => response.json())
    //         .then(task => app.tasks.push(task))
    //         .catch(error => console.log(error));

    // }

});