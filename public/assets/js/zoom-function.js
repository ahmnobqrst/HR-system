let textContent = document.getElementById("textContent");
let btnZoomIn = document.getElementById("zoomIn");
let btnZoomOut = document.getElementById("zoomOut");
let btnZoomReset = document.getElementById("zoomReset");

let zoomLevel = 1;

btnZoomIn.addEventListener("click", () => {
    if (zoomLevel <= 2) {
        zoomLevel += 0.1;
        textContent.style.transform = `scale(${zoomLevel})`;
        // textContent.style.transformOrigin = `center center`;
        // textContent.style.width = `${zoomLevel*100}%`;
    }
});
btnZoomOut.addEventListener("click", () => {
    if (zoomLevel >= 0) {
        textContent.style.transform = `scale(${zoomLevel})`;
        zoomLevel -= 0.1;
        // textContent.style.transformOrigin = `center center`;
        // textContent.style.width = `${zoomLevel*100}%`;
    } 
    // else {
    //     zoomLevel -= 0.1;
    //     textContent.style.transform = `scale(${zoomLevel})`;
    // }
});
btnZoomReset.addEventListener("click", () => {
    // if (zoomLevel >= 1) {
        //     // textContent.style.transformOrigin = `center center`;
        //     // textContent.style.width = `${zoomLevel*100}%`;
        // }
    zoomLevel = 1;
    textContent.style.transform = `scale(1)`;
});

Zoomerang.config({
    maxHeight: 600,
    maxWidth: 800,
    bgColor: "#000",
    bgOpacity: 0.85,
    onOpen: openCallback,
    onClose: closeCallback,
    onBeforeOpen: beforeOpenCallback,
    onBeforeClose: beforeCloseCallback,
}).listen(".zoom");

function openCallback(el) {
    // console.log('zoomed in on: ')
    // console.log(el)
}

function closeCallback(el) {
    // console.log('zoomed out on: ')
    // console.log(el)
}

function beforeOpenCallback(el) {
    // console.log('on before zoomed in on:')
    // console.log(el)
}

function beforeCloseCallback(el) {
    // console.log('on before zoomed out on:')
    // console.log(el)
}
