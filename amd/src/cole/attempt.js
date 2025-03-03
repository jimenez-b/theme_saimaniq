export const init = () => {
    let questions = document.querySelectorAll('div[id^="question-"]');
    questions.forEach(question => {
        let inputs = question.querySelectorAll('div.answer input[type="radio"][name$="_answer"]');
        inputs.forEach(input => {
            if(input.checked) {
                input.closest('div[class^="r"]').classList.add('checked');
            } else {
                input.closest('div[class^="r"]').classList.remove('checked');
            }
            input.addEventListener('click', () => {
                inputs.forEach(input2 => {
                    input2.closest('div[class^="r"]').classList.remove('checked');
                });
                input.closest('div[class^="r"]').classList.add('checked');
            });
        });
    });
    /*let inputs = document.querySelectorAll('body#page-mod-quiz-attempt .que .answer input[type="radio"][name$="_answer"]');
    inputs.forEach(input => {
        if(input.checked) {
            input.closest('div[class^="r"]').classList.add('checked');
        } else {
            input.closest('div[class^="r"]').classList.remove('checked');
        }
        input.addEventListener('click', () => {
            inputs.forEach(input2 => {
                input2.closest('div[class^="r"]').classList.remove('checked');
            });
            input.closest('div[class^="r"]').classList.add('checked');
        });
    });
    let clearChoices = document.querySelectorAll('body#page-mod-quiz-attempt .que div[id$="_clearchoice"] a');
    if (clearChoices) {
        clearChoices.forEach(clearChoice => {
            clearChoice.addEventListener('click', () => {
                inputs.forEach(input2 => {
                    input2.closest('div[class^="r"]').classList.remove('checked');
                });
            });
        });
    }*/
};

export const modal_images = () => {
    let images = document.querySelectorAll('#page-mod-quiz-attempt .que:not(.informationitem) .content .formulation img');
    if (images) {
        images.forEach(image => {
            //first we wrap around the image in a simple tag
            // eslint-disable-next-line max-len
            image.outerHTML = '<a href="#" data-toggle="modal" data-target="#saimaniq-modal-image" class="saimaniq-modal-link">'+image.outerHTML+'</a>';
        });
        let links = document.querySelectorAll('#page-mod-quiz-attempt .saimaniq-modal-link');
        links.forEach(link => {
            link.addEventListener('click', () => {
                let modalContent = document.querySelector('#page-mod-quiz-attempt #saimaniq-modal-image');
                let modalBody = modalContent.querySelector('#saimaniq-modal-body');
                modalBody.innerHTML = link.innerHTML;
            });
        });
    }
};

export const clean_clearmychoice = () => {
    //let choices = document.querySelectorAll('.qtype_multichoice_clearchoice a[role="button"]');
    let choices = document.querySelectorAll('.qtype_multichoice_clearchoice');
    if (choices) {
        choices.forEach(choice => {
            let link = choice.querySelector('a[role="button"]');
            link.classList.remove(...link.classList);
            link.classList.add('saimaniq-custom-link');
            link.addEventListener('click', () => {
                let clearRow = choice.previousSibling.querySelector('.checked');
                clearRow.classList.remove('checked');
            });
        });
    }
};