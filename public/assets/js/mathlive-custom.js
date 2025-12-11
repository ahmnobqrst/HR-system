const mf = document.getElementById("formula");
const variableName = document.getElementById("variableName");
const variableDescription = document.getElementById("variableDescription");
const variableValue = document.getElementById("variableValue");
const resetBtn = document.getElementById("resetBtn");
const deleteBtnVar = document.querySelectorAll(".deleteBtnVar");
const insertVariable = document.getElementById("insertVariable");
const addedVariables = document.getElementById("addedVariables");



insertVariable.addEventListener("click", () => {

    if(variableName.value =='' || variableDescription.value =='' || variableValue.value =='') {
        variableName.placeholder = 'Required Input';
        variableName.classList.add("placeholder-danger");
        variableDescription.placeholder = 'Required Input';
        variableDescription.classList.add("placeholder-danger");
        variableValue.placeholder = 'Required Input';
        variableValue.classList.add("placeholder-danger");
    } else {
        mf.insert( variableName.value, {suppressChangeNotifications: true});
        variableName.placeholder = 'Var Screen Name';
        variableName.classList.remove("placeholder-danger");
        variableDescription.placeholder = 'Description';
        variableDescription.classList.remove("placeholder-danger");
        variableValue.placeholder = 'Value';
        variableValue.classList.remove("placeholder-danger");
        addedVariables.innerHTML += `
        <li class="list-group-item">
            <div class="d-flex align-items-center justify-content-between variablesParent">
                <div class="d-flex align-items-center gap-2 ">
                    <h6 class="m-0 globalVariable">
                        ${variableName.value}
                    </h6>
                    <p class="m-0 text-capitalize">
                        : ${variableDescription.value}
                    </p>
                </div>
    
                <span class="value">
                    ${variableValue.value}

                    <button class="btn btn-icon btn-danger-transparent btn-sm ms-3 btn-wave deleteBtnVar waves-effect waves-light">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </span>
            </div>
        </li>
        `;
    }

    variableName.value = '';
    variableDescription.value = '';
    variableValue.value = '';

});

resetBtn.addEventListener("click", () => {
    variableName.value = '';
    variableDescription.value = '';
    variableValue.value = '';
});

// deleteBtnVar.forEach((el) => {

//     el.addEventListener("click", () => {
    
//     });
// });


// (function () {
//     "use strict"

//     deleteBtnVar.forEach((e) => {
//         let i = document.querySelectorAll(".deleteBtnVar").length


//         e.onclick = () => {
//             Swal.fire({
//                 title: 'Are you sure?',
//                 text: "You want to remove from wishlist",
//                 icon: 'warning',
//                 showCancelButton: true,
//                 confirmButtonColor: '#3085d6',
//                 cancelButtonColor: '#d33',
//                 confirmButtonText: 'Remove'
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     Swal.fire(
//                         'Removed',
//                         'Item removed from wishlist.',
//                         'success'
//                     )
//                     e.parentElement.parentElement.parentElement.remove()
//                     i = document.querySelectorAll(".deleteBtnVar").length
//                 }
//             })
//         }
//     })

// })();


let globalVariable = document.querySelectorAll('.variablesParent');
console.log(globalVariable);

globalVariable.forEach((element) => {
    let deleteBtnVar = element.querySelector('.deleteBtnVar');
    // console.log(deleteBtnVar);
    
    element.addEventListener('click', (e) => {
        let inputVariable = element.querySelector('.globalVariable').innerHTML.trim();
        let globalDescription = element.querySelector('.globalDescription').innerHTML.trim();
        console.log(e);

        mf.insert( inputVariable, {suppressChangeNotifications: true});
        this.addedVariables.innerHTML += `
        <li class="list-group-item">
            <div class="d-flex align-items-center justify-content-between variablesParent">
                <div class="d-flex align-items-center gap-2 ">
                    <h6 class="m-0 globalVariable">
                        ${inputVariable}
                    </h6>
                    <p class="m-0 text-capitalize">
                        ${globalDescription}
                    </p>
                </div>
    
                <span class="value">

                    <button class="btn btn-icon btn-danger-transparent btn-sm ms-3 btn-wave deleteBtnVar">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </span>
            </div>
        </li>
        `;

        // console.log(addedVariables);
    });

    // element.forEach((e) => {
    //     let i = document.querySelectorAll(".deleteBtnVar").length

    deleteBtnVar.onclick = () => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to remove from wishlist",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Remove'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Removed',
                    'Item removed from Variables List.',
                    'success'
                )
                deleteBtnVar.parentElement.parentElement.parentElement.remove()
                i = document.querySelectorAll(".deleteBtnVar").length
                console.log(i)
            }
        })
    }

    // })
    
})

