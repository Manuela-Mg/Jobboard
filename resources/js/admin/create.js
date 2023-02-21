let httpRequest;
const button = document.getElementById("sign-button");
// make POST request
button.onclick = () => {
    console.log("test");
    const formInput = document.querySelectorAll("form input");
    console.log(formInput);
    makeRequest('http://127.0.0.1:8000/api/new/user');
};
function makeRequest(url) {
    httpRequest = new XMLHttpRequest();
    if (!httpRequest) {
        alert("Giving up :( Cannot create an XMLHTTP instance");
        return false;
    }
    httpRequest.onreadystatechange = alertContents;
    httpRequest.open('POST', url);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.send(`userName=${encodeURIComponent(userName)}`);
}

function alertContents() {
    try {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                // managin html or json response
                // alert(httpRequest.responseText);
                // managing xml response
                // const xmldoc = httpRequest.responseXML;
                // const root_node = xmldoc.querySelector('root');
                // alert(root_node.firstChild.data);
                // parsing json response
                const response = JSON.parse(httpRequest.responseText);
                alert(response.firstName);
                // parsiing response with post request
                // const response = JSON.parse(httpRequest.responseText);

                // alert(response.computedString);
            } else {
                alert("There was a problem with the request.");
            }
        }
    } catch (e) {
        alert(`Exception: ${e.description}`)
    }
}