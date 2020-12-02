document.addEventListener("DOMContentLoaded", ()=> {
    document.querySelectorAll('input[type="file"]')
    .forEach(input => {
        console.log(input)
        input.removeAttribute("upload");
        input.addEventListener("input", ()=> {
            let uploaded = (input.files.length>0)?true:false;
            input.setAttribute("upload", uploaded);
        })
    })
});