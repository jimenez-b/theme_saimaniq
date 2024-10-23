export const columnResizer = () => {
    const locations = ["/moodle", "/moodle41", ""];
    var urlToSend = '';

    locations.forEach(async(location) => {
        let urlVar = window.location.origin + location + "/theme/saimaniq/classes.json";
        // console.log("location is: " + urlVar);
        var http = new XMLHttpRequest();
        http.open('HEAD', urlVar, false);
        http.send();

        if (http.status != "404") {
            /* A  console.log('The file does not exists');
        } else {
            console.log('The file does exist');*/
            urlToSend = urlVar;
        }
    });
    // console.log('location that exists ' + urlToSend);

    fetch(urlToSend)
        .then((res) => {
            if (!res.ok) {
                throw new Error(`HTTP error! Status: ${res.status}`);
            }
            return res.json();
        })
        .then((data) => {
                // console.log(data); // To be erased
                // console.log('********'); // To be erased
                data.classes.forEach((classToReplace) => {
                let oldClasses = document.querySelectorAll('.' + classToReplace.oldClass);
                if (oldClasses !== null) {
                    // console.log('length is ' + oldClasses.length); // To be erased
                    // console.log('-----------'); // To be erased
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
                window.console.error("Unable to fetch data:", error));
};
