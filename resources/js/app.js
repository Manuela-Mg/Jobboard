import './bootstrap';

import { functions } from 'lodash';


const adsUrl = "http://localhost:8000/api/ads/list";

const nbElmsByPage = 10;

let pageIndex = 0;
const pages = [];
let page = [];

fetch(adsUrl)
  .then(response => response.json())
  .then(resJson => {
    const ads = resJson.advertisement;
    const adsEl = document.getElementById('ads-container');
    let str = '';
    let i = 1, hide = false;
    for (const ad of ads) {
      page.push(ad);

      if (i === nbElmsByPage) {
        pages.push(page);
        page = [];
        i = 0;
      }
      <Navbar/>
      i++;
    }

    console.log(pages);

    const previousElem = document.getElementById('previousPage');
    const nextElement = document.getElementById('nextPage');
    // const pageNumbersElem = document.getElementById("page-numbers");
    
    
    // for(let i = 1; i <= pages.length; i++) {
    //   const li = document.createElement('li');
    //   li.innerText = i;
    //   pageNumbersElem.appendChild(li);
    //   li.addEventListener("click", () => {
    //     pageIndex = i-1;
    //   })
    // }
    for (let i = 0; i < nbElmsByPage; i++) {
      // adsEl.innerHTML += '<div class="ads-block">'+
        // '<label for="title"></label> <span id="title">'+ ads[i].title +'</span><br>'+
        // '<label for="description"></label> <span id="description-' + i + '">'+ ads[i].description.slice(0, 40) + "..." +'</span><br>'+
        // '<label for="created-at">Date of creation: </label> <span id="created">'+ ads[i].created_at +'</span><br>'+
        // '<button type="button" class="info-box" id="learn-button-'+ i + '">Learn More...</button>'+
        // '<button type="button" class="apply-box" id="apply-button">Apply</button> '+
        // '</div>';
        const adsBlock = document.createElement('div');
        adsBlock.classList.add('ads-block');
        adsBlock.innerHTML =
        '<label for="title"></label> <span id="title">'+ ads[i].title +'</span><br>'+
        '<label for="description"></label> <span id="description-' + i + '">'+ ads[i].description.slice(0, 40) + "..." +'</span><br>'+
        '<label for="created-at">Date of creation: </label> <span id="created">'+ ads[i].created_at +'</span><br>'+
        '<button type="button" class="info-box" id="learn-button-'+ i + '">Learn More...</button>' +
        '<button type="button" class="apply-box" id="apply-button-'+ i + '">Apply</button> ';
        adsEl.appendChild(adsBlock);

        document.getElementById("apply-button-" + i).style.display = "none";
        const test = document.getElementById('learn-button-' + i);
        const des = document.getElementById('description-' + i);
        let out = false;
        test.addEventListener("click", () => {
          if (out === false) {
          console.log('learn-button clicked');
          des.textContent = ads[i].description;
          document.getElementById("apply-button-" + i).style.display = "block";
          apply(document.getElementById("apply-button-" + i));
          test.textContent = "Less...";
          out = true;
          } else {
            des.textContent = ads[i].description.slice(0, 40) + "...";
            out = false;
            document.getElementById("apply-button-" + i).style.display = "none";
            test.textContent = "Learn More...";
          }
        })
    }

    function apply(applyButton) {
      applyButton.addEventListener("click", () => {
        const mainbox = document.getElementById('mainbox')
        const closeapp = document.getElementById('close-apply')
        const showClass = 'show-apply'
        const hideApp = 'hide-apply'

          // if(!appOpen) {
              console.log("HAAAAAAAAA")
              mainbox.classList.add(showClass)
              mainbox.classList.remove(hideApp)
          // }
          closeapp.addEventListener("click", () => {
            mainbox.classList.remove(showClass)
            mainbox.classList.add(hideApp)

          });
          // else {
          //     appOpen = false
          //     appBox.classList.remove(showClass)
          //     // appBox.classList.add(hideApp)
          // }
      });
    }

    nextElement.addEventListener("click", () =>
      {
        adsEl.innerHTML = ''; 
        if (pageIndex < pages.length) {
          pageIndex++;
        }
        if (pageIndex === (pages.length) - 1) {
          hide = true;
          nextElement.style.display="none";
        }
        for (let i = 0; i < nbElmsByPage && pageIndex != pages.length; i++) {
         
          const adsBlock = document.createElement('div');
          adsBlock.classList.add('ads-block');
          adsBlock.innerHTML =
          '<label for="title"></label> <span id="title">'+ pages[pageIndex][i].title +'</span><br>'+
          '<label for="description"></label> <span id="description-' + i + '">'+ pages[pageIndex][i].description.slice(0, 40) + "..." +'</span><br>'+
          '<label for="created-at">Date of creation: </label> <span id="created">'+ pages[pageIndex][i].created_at +'</span><br>'+
          '<button type="button" class="info-box" id="learn-button-'+ i + '">Learn More...</button>'+
          '<button type="button" class="apply-box" id="apply-button-'+ i + '">Apply</button> ';
          adsEl.appendChild(adsBlock);

          document.getElementById("apply-button-" + i).style.display = "none";
          const test = document.getElementById('learn-button-' + i);
          const des = document.getElementById('description-' + i);
          let out = false;
          test.addEventListener("click", () => {
            if (out === false) {
            console.log('learn-button clicked');
            des.textContent = pages[pageIndex][i].description;
            document.getElementById("apply-button-" + i).style.display = "block";
            apply(document.getElementById("apply-button-" + i));
            test.textContent = "Less...";
            out = true;
            } else {
              des.textContent = pages[pageIndex][i].description.slice(0, 40) + "...";
              out = false;
              document.getElementById("apply-button-" + i).style.display = "none";
              test.textContent = "Learn More...";
            }
          })

        }
        // adsEl.innerHTML = str;
      }
    )

    previousElem.addEventListener("click", () =>
      {
        if (hide === true) {
          nextElement.style.display = 'block';
          hide = false;
        }
        adsEl.innerHTML = '';
        if (pageIndex > 0) {
          pageIndex--;
        }
        
        for (let i = 0; i < nbElmsByPage; i++) {
          // adsEl.innerHTML += '<div class="ads-block">'+
          //   '<label for="title"></label> <span id="title">'+ pages[pageIndex][i].title +'</span><br>'+
          //   '<label for="description"></label> <span id="description">'+ pages[pageIndex][i].description.slice(0, 40) + "..." +'</span><br>'+
          //   '<label for="created-at">Date of creation: </label> <span id="created">'+ pages[pageIndex][i].created_at +'</span><br>'+
          //   '<button type="button" class="info-box" id="learn-button">Learn More...</button> '+
          //   '<button type="button" class="apply-box" id="button">Apply</button> '+
          //   '</div>';
          // // str += divStr;
          const adsBlock = document.createElement('div');
          adsBlock.classList.add('ads-block');
          adsBlock.innerHTML =
          '<label for="title"></label> <span id="title">'+ pages[pageIndex][i].title +'</span><br>'+
          '<label for="description"></label> <span id="description-' + i + '">'+ pages[pageIndex][i].description.slice(0, 40) + "..." +'</span><br>'+
          '<label for="created-at">Date of creation: </label> <span id="created">'+ pages[pageIndex][i].created_at +'</span><br>'+
          '<button type="button" class="info-box" id="learn-button-'+ i + '">Learn More...</button>'+
          '<button type="button" class="apply-box" id="apply-button-'+ i + '">Apply</button> ';
          adsEl.appendChild(adsBlock);
          
          document.getElementById("apply-button-" + i).style.display = "none";
          const test = document.getElementById('learn-button-' + i);
          const des = document.getElementById('description-' + i);
          let out = false;
          test.addEventListener("click", () => {
            if (out === false) {
            console.log('learn-button clicked');
            des.textContent = pages[pageIndex][i].description;
            document.getElementById("apply-button-" + i).style.display = "block";
            apply(document.getElementById("apply-button-" + i));
            test.textContent = "Less...";
            out = true;
            } else {
              des.textContent = pages[pageIndex][i].description.slice(0, 40) + "...";
              out = false;
              document.getElementById("apply-button-" + i).style.display = "none";
              test.textContent = "Learn More...";
            }
          })
        }
        // adsEl.innerHTML = str;
        console.log(pages[pageIndex]);
      }
    )
  
  })

