export const init = () => {
    let inputs = document.querySelectorAll('body#page-mod-quiz-attempt .que .answer input[type="radio"][name$="_answer"]');
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
    let clearChoice = document.querySelector('body#page-mod-quiz-attempt .que div[id$="_clearchoice"] a');
    if (clearChoice) {
        clearChoice.addEventListener('click', () => {
            inputs.forEach(input2 => {
                input2.closest('div[class^="r"]').classList.remove('checked');
            });
        });
    }
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