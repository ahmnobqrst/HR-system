var addBtn1 = document.getElementById("addBtn1");
var addBtn2 = document.getElementById("addBtn2");
var addBtn3 = document.getElementById("addBtn3");
var addBtn4 = document.getElementById("addBtn4");
var addBtn5 = document.getElementById("addBtn5");

// Problem
var editBtn = document.querySelector(".edit-function");
var deleteBtn = document.querySelectorAll(".delete-function");

var inputTitle1 = document.getElementById("disease-name");
var inputTitleDescription1 = document.getElementById("disease-description");
var diseaseList1 = document.getElementById("disease-list");

var inputTitle2 = document.getElementById("illness-name");
var inputTitleDescription2 = document.getElementById("illness-description");
var diseaseList2 = document.getElementById("illness-list");

var inputTitle3 = document.getElementById("surgery-name");
var inputTitleDescription3 = document.getElementById("surgery-description");
var diseaseList3 = document.getElementById("surgery-list");

var inputTitle4 = document.getElementById("surgical-endoscope-name");
var inputTitleDescription4 = document.getElementById("surgical-endoscope-description");
var diseaseList4 = document.getElementById("surgical-endoscope-list");

var inputTitle5 = document.getElementById("drug-name");
var inputTitleDescription5 = document.getElementById("drug-description");
var diseaseList5 = document.getElementById("drug-list");

var diseaseListChild = document.querySelectorAll("#disease-list li");


// Add Function 
addBtn1.addEventListener("click", () => {
    let inputTitleValue = inputTitle1.value.trim();
    let inputTitleDescriptionValue = inputTitleDescription1.value.trim();

    // if(inputTitle1.value == "" && inputTitleDescription1.value == "") {
    //     addBtn1.classList.add("disabled");
    // } else {
    //     addBtn1.classList.remove("disabled");
    // }

    diseaseList1.innerHTML += `
        <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto text-muted">
            <div class="fw-semibold fs-14 text-default text-capitalize inputTitle">${inputTitleValue}</div>
            <span class="inputTitleDescription">${inputTitleDescriptionValue}</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-icon btn-primary-transparent btn-wave btn-sm edit-function">
                <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn btn-icon btn-danger-transparent btn-wave btn-sm delete-function">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        </li>
    `;
    inputTitle1.value = "";
    inputTitleDescription1.value = "";

});

// Add Function 
addBtn2.addEventListener("click", () => {1
    let inputTitleValue = inputTitle2.value.trim();
    let inputTitleDescriptionValue = inputTitleDescription2.value.trim();

    diseaseList2.innerHTML += `
        <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto text-muted">
            <div class="fw-semibold fs-14 text-default text-capitalize inputTitle">${inputTitleValue}</div>
            <span class="inputTitleDescription">${inputTitleDescriptionValue}</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-icon btn-primary-transparent btn-wave btn-sm edit-function">
                <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn btn-icon btn-danger-transparent btn-wave btn-sm delete-function">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        </li>
    `;
    inputTitle2.value = "";
    inputTitleDescription2.value = "";

});

// Add Function 
addBtn3.addEventListener("click", () => {
    let inputTitleValue = inputTitle3.value.trim();
    let inputTitleDescriptionValue = inputTitleDescription3.value.trim();

    diseaseList3.innerHTML += `
        <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto text-muted">
            <div class="fw-semibold fs-14 text-default text-capitalize inputTitle">${inputTitleValue}</div>
            <span class="inputTitleDescription">${inputTitleDescriptionValue}</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-icon btn-primary-transparent btn-wave btn-sm edit-function">
                <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn btn-icon btn-danger-transparent btn-wave btn-sm delete-function">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        </li>
    `;
    inputTitle3.value = "";
    inputTitleDescription3.value = "";

});

// Add Function 
addBtn4.addEventListener("click", () => {
    let inputTitleValue = inputTitle4.value.trim();
    let inputTitleDescriptionValue = inputTitleDescription4.value.trim();

    diseaseList4.innerHTML += `
        <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto text-muted">
            <div class="fw-semibold fs-14 text-default text-capitalize inputTitle">${inputTitleValue}</div>
            <span class="inputTitleDescription">${inputTitleDescriptionValue}</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-icon btn-primary-transparent btn-wave btn-sm edit-function">
                <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn btn-icon btn-danger-transparent btn-wave btn-sm delete-function">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        </li>
    `;
    inputTitle4.value = "";
    inputTitleDescription4.value = "";

});

// Add Function 
addBtn5.addEventListener("click", () => {
    let inputTitleValue = inputTitle5.value.trim();
    let inputTitleDescriptionValue = inputTitleDescription5.value.trim();

    diseaseList5.innerHTML += `
        <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto text-muted">
            <div class="fw-semibold fs-14 text-default text-capitalize inputTitle">${inputTitleValue}</div>
            <span class="inputTitleDescription">${inputTitleDescriptionValue}</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-icon btn-primary-transparent btn-wave btn-sm edit-function">
                <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn btn-icon btn-danger-transparent btn-wave btn-sm delete-function">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        </li>
    `;
    inputTitle5.value = "";
    inputTitleDescription5.value = "";

});


// Edit Function 
// Problem
editBtn.addEventListener('click', () => {
    diseaseListChild.forEach((edit) => {
        edit.addEventListener("click", () => {
            let inputTitleText = document.querySelectorAll(".inputTitle")[0].childNodes[0].data;
            let inputTitleDescriptionText = document.querySelectorAll(".inputTitleDescription")[0].childNodes[0].data;
            // console.log(inputTitleText, inputTitleDescriptionText);
            inputTitle.value = inputTitleText;
            inputTitleDescription.value = inputTitleDescriptionText;
        });
    });
    console.log('Badr');
}) 


// let inputTitleTextEdit = inputTitleText.innerHTML;
// let inputTitleDescriptionTextEdit = inputTitleDescriptionText.innerHTML;
// console.log(inputTitleTextEdit, inputTitleDescriptionTextEdit);

// diseaseListChild.addEventListener("click", () => {

// })

/* Crud Li */
// var addBtn = document.getElementById("#addBtn");
// var inputTitle = document.getElementById("disease-name");
// var inputDescription = document.getElementById("disease-description");
// var list = document.getElementById("list");
// var items = document.querySelectorAll("#list li");
// var tab = [];
// var index;

// for (var i = 0; i < items.length; i++) {
//     tab.push(items[i].innerText);
//     items[i].onclick = function () {
//         index = tab.indexOf(this.innerText);
//         input.value = items[index].innerText;
//     };
// }

// function refresh() {
//     tab.length = 0;
//     items = document.querySelectorAll("#list li");
//     for (var i = 0; i < items.length; i++) {
//         tab.push(items[i].innerText);
//     }
// }

// addBtn.addEventListener('click', () => {
//     let li = document.createElement(`
//     <li class="list-group-item d-flex justify-content-between align-items-start">
//     <div class="ms-2 me-auto text-muted">
//         <div class="fw-semibold fs-14 text-default">${inputTitle}</div>
//         ${inputDescription}
//     </div>
//     <div class="d-flex align-items-center gap-2">
//         <button class="btn btn-icon btn-primary-transparent btn-wave btn-sm">
//             <i class="bi bi-pencil-square"></i>
//         </button>
//         <button class="btn btn-icon btn-danger-transparent btn-wave btn-sm">
//             <i class="bi bi-trash"></i>
//         </button>
//     </div>
//     </li>
//     `);

//     console.log(li);

//     // list.appendChild(li);
//     // inputTitle.value = "";
//     // inputDescription.value = "";
//     // tab.push(li);
//     // refresh();
//     // li.onclick = function () {
//     //     index = tab.indexOf(li.innerText);
//     //     inputTitle.value = items[index].innerText;
//     //     inputDescription.value = items[index].innerText;
//     // };
// })

// function edit() {
//     items[index].innerText = inputTitle.value;
//     items[index].innerText = inputDescription.value;
//     refresh();
// }

// function x() {
//     items[index].parentNode.removeChild(items[index]);
// }
/* Crud Li */
