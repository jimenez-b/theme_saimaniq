/**
 * Function to move around things
 * @param {int} movementX position of the element in the X axis
 * @param {int} movementY position of the element in the Y axis
 */
/*function onDrag (movementX, movementY) {
    const wrapper = document.querySelector("#saimaniq-help-section");
    let getStyle = window.getComputedStyle(wrapper);
    let leftVal  = parseInt(getStyle.left);
    let topVal   = parseInt(getStyle.top);
    window.console.log('left '+leftVal+' top '+topVal);
    window.console.log('x '+movementX+' y '+movementY);
    wrapper.style.left = `${leftVal + movementX}px`;
    wrapper.style.top  = `${topVal  + movementY}px`;
}*/

/**
 * Function onDrag2 to move around things
 * @param {object} event position of the element in the Y axis
 */
function onDrag2 (event) {
    const wrapper = document.querySelector("#saimaniq-help-section");
    let getStyle = window.getComputedStyle(wrapper);
    let leftVal  = parseInt(getStyle.left);
    let topVal   = parseInt(getStyle.top);
    window.console.log('left '+leftVal+' top '+topVal);
    window.console.log('x '+ `${event.movementX}` +' y ' + `${event.movementY}`);
    wrapper.style.left = `${leftVal + event.movementX}px`;
    wrapper.style.top  = `${topVal  + event.movementY}px`;
}

export const dragger = () => {
    // let element = document.querySelector("#saimaniq-faq-info");
    const wrapper = document.querySelector("#saimaniq-help-section");
    let element = wrapper.querySelector("header.h4");

    element.addEventListener("mousedown", ()=>{
        window.console.log('clicked');
        element.classList.add("active");
        //element.addEventListener("mousemove", onDrag);
        /*selector.addEventListener("click", () => {
            statusModals.where = selector;
            checkSingle(statusModals);
        });*/
        element.addEventListener("mousemove", onDrag2);
    });

    document.addEventListener("mouseup", ()=>{
        window.console.log('removed');
        element.classList.remove("active");
        element.removeEventListener("mousemove", onDrag2);
    });
};