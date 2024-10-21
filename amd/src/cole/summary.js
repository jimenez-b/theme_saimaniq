
/* eslint-disable linebreak-style */
// Code adapted from theme_quizzer
// converted from jQuery into an ESM module

/**
 * Function to check modals
 * @param {object} statusModals status of the modals
 * @param {object} element element to be tested
 */

/**
 * Function to change the state the buttons
 * @param {object} button the button affected
 * @param {object} buttons array of buttons
 */
function changeState(button, buttons) {
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].setAttribute('data-filter', 'disabled');
    }
    button.setAttribute('data-filter', 'enabled');
    let rows = document.getElementsByClassName('answerrow');
    var classCompare = '';
    switch (button.name) {
        case "invalidanswer":
        case "filterall":
            classCompare = button.name;
            break;
        case "answered":
            classCompare = 'answersaved';
            break;
        case "unsure":
            classCompare = 'flagged';
            break;
        case "unanswered":
            classCompare = 'notyetanswered';
            break;
        default:
            classCompare = "it's never lupus";
    }
    for (let i = 0; i < rows.length; i++) {
        if (classCompare == 'filterall') {
            rows[i].classList.remove('d-none');
        } else {
            if (rows[i].classList.contains(classCompare)) {
                rows[i].classList.add('show');
                rows[i].classList.remove('d-none');
            } else {
                rows[i].classList.add('d-none');
                rows[i].classList.remove('show');
            }
        }
    }
}


export const init = () => {
    let buttons = document.querySelectorAll('.sortbtn');
    buttons.forEach(button => {
        button.addEventListener('click', ()=>{
            changeState(button, buttons);
        });
    });
};

export const modalSummary = () => {
    //window.addEventListener('DOMContentLoaded', (event) => {
    if (document.readyState !== 'loading') {
        const domObserver = new MutationObserver(() => {
            var button = document.querySelector('.modal-dialog-scrollable[data-region="modal"] button.btn-primary');
            if (button) {
                button.addEventListener('click', () => {
                    var modal = document.querySelector('#exam-submit-confirmation');
                    var bodySu = document.querySelector('div#page-wrapper');
                    modal.classList.remove('d-none');
                    bodySu.classList.add('d-none');
                    setTimeout(() => { window.console.log('Checked'); }, 5000);
                });

                // No need to observe anymore. Clean up!
                domObserver.disconnect();
            }
        });
        domObserver.observe(document.body, { childList: true, subtree: true });
    }
};
