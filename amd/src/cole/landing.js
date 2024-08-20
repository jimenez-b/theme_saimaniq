/* eslint-disable linebreak-style */
// Code adapted from theme_quizzer
// converted from jQuery into an ESM module

/**
 * Function to check the status of the element provided
 * @param {object} element element to be tested
 */
function singleCheck(element) {
    if (element.checked == true) {
            document.querySelector('.quizstartbuttondiv button[type="submit"]').disabled = false;
        } else {
            document.querySelector('.quizstartbuttondiv button[type="submit"]').disabled = true;
        }
}

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
/**
 * Function to check modals
 * @param {object} statusModals status of the modals
 */
function checkSingle(statusModals) {
    if (statusModals.copyrightModal == 1 && statusModals.termsModal == 1) {
        singleCheck(statusModals.where);
    } else {
        // eslint-disable-next-line no-alert
        window.alert('You need to read both the Copyright and the Terms and Conditions');
        statusModals.where.checked = false;
    }
}

/**
 * Function to check modals
 * @param {object} statusModals status of the modals
 */
function checkSingle2(statusModals) {
    if (statusModals.copyrightModal != 1 || statusModals.termsModal != 1) {
        // eslint-disable-next-line no-alert
        window.alert('You need to read both the Copyright and the Terms and Conditions');
        statusModals.where.checked = false;
    }
}

/**
 * Function to check modals
 * @param {object} statusModals status of the modals
 * @param {object} element element to be tested
 */
function modalClose(statusModals, element) {
    if (element.id == 'copyright-modal') {
        statusModals.copyrightModal = 1;
    }
    if (element.id == 'terms-modal') {
        statusModals.termsModal = 1;
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
    // First, we disable the button
    document.querySelector('.quizstartbuttondiv button[type="submit"]').disabled = true;
    let statusModals = {
        copyrightModal: 0,
        termsModal: 0,
        where: ''
    };
    if (instructions !== "" && copyright !== "") {
        document.querySelector('input#instructions_verification').addEventListener("click", bothCheck);
        document.querySelector('input#copyrightnotice').addEventListener("click", bothCheck);
        // It is to be rendered
        let selectorCloser = document.querySelectorAll('button.saimaniq-close-modal');
        selectorCloser.forEach((closerModal) => {
            closerModal.addEventListener("click", () => {
                modalClose(statusModals, closerModal.closest('.saimaniq-modal-box'));
            });
        });

        let selector = document.querySelector('input#copyrightnotice');
        selector.addEventListener("click", () => {
            statusModals.where = selector;
            checkSingle2(statusModals);
        });
    } else {
        // We check if instructions is to be rendered by config
        if (instructions !== "") {
            // It is to be rendered
            let selector = document.querySelector('input#instructions_verification');
            selector.addEventListener("click", () => {
                singleCheck(selector);
            });
        }
        if (copyright !== "") {
            // It is to be rendered
            let selectorCloser = document.querySelectorAll('button.saimaniq-close-modal');
            selectorCloser.forEach((closerModal) => {
                closerModal.addEventListener("click", () => {
                    modalClose(statusModals, closerModal.closest('.saimaniq-modal-box'));
                });
            });

            let selector = document.querySelector('input#copyrightnotice');
            selector.addEventListener("click", () => {
                statusModals.where = selector;
                checkSingle(statusModals);
            });
        }
    }
};