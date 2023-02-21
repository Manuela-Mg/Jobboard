import './bootstrap';

// const signUp = document.getElementById("sign-button");
const form = document.querySelector('form');

const signUrl = "/api/signup";

form.addEventListener("submit", handleFormSubmit);

async function handleFormSubmit(event) {

	event.preventDefault();
    const FD = new FormData(form);

    axios.post(signUrl, FD)
    .then(res => console.log(res))
    .catch(err => console.log(err))

    // const payload = new FormData(form);
    // console.log(payload);
    // console.log("test");
    // fetch(signUrl, {
    // method: 'POST',
    // body: JSON.stringify(payload),
    // })
    // .then(res => res.json())
    // .then(data => {
    //     console.log(data);
    //     const infos = data.user;
    //     console.log(infos);
    // })
}


// signUp.addEventListener('click',()=>{

// form.addEventListener('submit', function(event){
//     event.preventDefault();

//     const form = document.getElementById('userForm');
    // form.addEventListener('submit', function(e) {
    //     e.preventDefault();
//     const payload = new FormData(document.forms.signForm);
//     console.log("test");
//     fetch(signUrl, {
//     method: 'POST',
//     body: JSON.stringify(payload),
//     })
//     .then(res => res.json())
//     .then(data => {
//         console.log(data);
//         const infos = data.user;
//         console.log(infos);
//     })
// })
//     let data = new FormData(document.forms.signForm);
//     const xhr = new XMLHttpRequest();
//     xhr.open("POST", signUrl, true);

//     xhr.onreadystatechange = () => { // Call a function when the state changes.
//     if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
//         console.log(xhr.responseText);
//         console.log(xhr);
//     }
//     }
//     xhr.send(JSON.stringify(data));
// })

