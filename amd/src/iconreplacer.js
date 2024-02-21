/* eslint-disable promise/always-return */
/* eslint-disable no-console */
define(function() {

    return {
        iconReplacer: function() {
            fetch("../theme/saimaniq/classes.json")
                .then((res) => {
                    if (!res.ok) {
                        throw new Error(`HTTP error! Status: ${res.status}`);
                    }
                    return res.json();
                })
                .then((data) => {
                      console.log(data); // To be erased
                      console.log('********'); // To be erased
                      data.classes.forEach((classToReplace) => {
                        let oldClasses = document.querySelectorAll('.' + classToReplace.oldClass);
                        if (oldClasses !== null) {
                            console.log('length is ' + oldClasses.length); // To be erased
                            console.log('-----------'); // To be erased
                            oldClasses.forEach(oldClass => {
                                /*
                                 The regular structure goes as follows:
                                 icon fa fa-oldClass
                                 to be replaced by:
                                 icon-saimaniq bi bi-newClass
                                */
                                oldClass.classList.replace('icon', 'icon-saimaniq');
                                oldClass.classList.replace('fa', 'bi');
                                oldClass.classList.replace(classToReplace.oldClass, classToReplace.newClass);
                            });
                        }
                      });
                    })
                .catch((error) =>
                       console.error("Unable to fetch data:", error));
        }
        // Foreach(oldelement){
            // queryselector(oldelement)
            // reemplazarclass(oldelement, new)
        // }
    };
});
