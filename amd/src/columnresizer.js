define(function() {
    return {
        columnResizer: function(parameter = {}) {
            if (parameter.element == undefined) {
                parameter.element = document.body;
            }

            let element = parameter.element;

            let identifier = element.querySelector(".backup_stage_current") !== null;
            if (identifier) {
                let additionalClass = identifier.innerHTML.substr(3);
                additionalClass = additionalClass.toLowerCase();
                additionalClass = additionalClass.replaceAll(' ', '-');
                additionalClass = 'saimaniq-step-' + additionalClass;
                element.classList.add(additionalClass);
            } else {
                console.log ('No such element exists');
            }
            // 1. determine if we're on the right page
            if (element.id == 'page-backup-restore' || element.id == 'page-backup-backup') {
                // 2. select the correct element
                // we have to verify we're on the REVIEW PAGE
                // <span class="backup_stage backup_stage_current">5. Review</span>
                let identifier = element.querySelector(".backup_stage_current");
                if (identifier.innerHTML == '5. Review' || identifier.innerHTML == '3. Confirmation and review') {
                    let courseSettingsContainer = element.querySelector("#id_coursesettingscontainer");
                    // We select all divs <div class="col-md-3 col-form-label d-flex pb-0 pr-md-0">
                    let firstColumn = courseSettingsContainer.querySelectorAll(".col-md-3.col-form-label.d-flex.pb-0.pr-md-0");
                    // We select all divs <div class="col-md-9 form-inline align-items-start felement" data-fieldtype="static">
                    let secondColumn = courseSettingsContainer.querySelectorAll(".col-md-9.form-inline.align-items-start.felement");
                    // 3. we replace the column classes
                    firstColumn.forEach(function(singleColumn) {
                        singleColumn.classList.replace('col-md-3', 'col-md-8');
                    });
                    secondColumn.forEach(function(singleColumn) {
                        singleColumn.classList.replace('col-md-9', 'col-md-4');
                    });
                }
            }
        }
    };
});