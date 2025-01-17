/* eslint-disable linebreak-style */
// Code adapted from theme_quizzer
// converted from jQuery into an ESM module


/**
 * Function to check both
 */
function bothCheck() {
    if (document.querySelector('input#instructions_verification').checked == true &&
        document.querySelector('input#copyrightnotice').checked == true) {
            document.querySelector('.quizstartbuttondiv button[type="submit"]').disabled = false;
        } else {
            document.querySelector('.quizstartbuttondiv button[type="submit"]').disabled = true;
        }
}

export const init = () => {
    document.querySelector("body#page-mod-quiz-view div#intro p").classList.add('d-none');
};

export const bolder = () => {
    let selector = document.querySelectorAll('div.box.quizinfo p');
    selector.forEach((paragraph) => {
        paragraph.innerHTML = '<strong>'+
                                paragraph.innerText.substr(0, paragraph.innerText.indexOf(':')+1)+
                              '</strong>'+
                                paragraph.innerText.substr(paragraph.innerText.indexOf(':')+1);
    });
};

export const checkboxEnabler = (instructions, copyright) => {
    //first, we check if both settings are disabled
    if (instructions === "" && copyright === "") {
        //window.console.log('nothing to see here');
        return;
    } else {
        document.querySelector('.quizstartbuttondiv button[type="submit"]').disabled = true;
        //now, we check which of the two or both
        document.querySelector('input#instructions_verification').addEventListener("click", bothCheck);
        document.querySelector('input#copyrightnotice').addEventListener("click", bothCheck);
    }
};

export const qrchanges = () => {
    let upper = document.querySelector('#saimaniq-quiz-landing-container');
    upper.classList.remove("d-none");
    if (document.querySelector(".k1-qrcode")) {
        upper.classList.add("d-none");
    }
};