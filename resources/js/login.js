import './bootstrap';


const form = document.querySelector('form');

const signUrl = "/api/login";

form.addEventListener("submit", handleFormSubmit);

async function handleFormSubmit(event) {

	event.preventDefault();
    const FD = new FormData(form);

    axios.post(signUrl, FD)
    .then(res => {
        console.log(res);
        if (res.status === 200) {
            window.location.replace('/');
        }
    })
    .catch(err => console.log(err))
}
