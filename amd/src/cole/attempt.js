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