
function init() {
    initCheckEditor();
    initEvents();
}

function initEvents() {
    document.getElementById("icon-search").addEventListener("click", function () {
        showHideSearch();
    });
    if (document.getElementById("password")) {
        document.getElementById("password").addEventListener("keyup", function (e) {
            let regex = new RegExp(/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,20}$/);
            validateField("password", regex);
        })
    }
    if (document.getElementById("email")) {
        document.getElementById("email").addEventListener("keyup", function (e) {
            let regex = new RegExp(/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/);
            validateField("email", regex);
        })
    }
    if (document.getElementById("formUser")) {
        document.getElementById("formUser").addEventListener("submit", function (e) {
            let regexPass = new RegExp(/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,20}$/);
            validateField("password", regexPass);
            regexEmail = new RegExp(/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/);
            validateField("email", regexEmail);
        })
    }
    if (document.getElementsByName("back") && document.getElementsByName("back").length > 0) {
        document.getElementsByName("back")[0].addEventListener("click", function () {
            window.history.back();
        })
    }
}

function validateField(id, regex) {

    let value = document.getElementById(id).value;

    if (regex.test(value)) {
        document.getElementById(id).setAttribute("class", "form-control is-valid");

    } else {
        document.getElementById(id).setAttribute("class", "form-control is-invalid");
        event.preventDefault();
    }
}


function initCheckEditor() {

    if (document.querySelector('#editor')) {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                codeBlock: {
                    languages: [{
                        language: 'plaintext',
                        label: 'Plain text'
                    }, // The default language.
                    {
                        language: 'c',
                        label: 'C'
                    },
                    {
                        language: 'cs',
                        label: 'C#'
                    },
                    {
                        language: 'cpp',
                        label: 'C++'
                    },
                    {
                        language: 'css',
                        label: 'CSS'
                    },
                    {
                        language: 'diff',
                        label: 'Diff'
                    },
                    {
                        language: 'xml',
                        label: 'HTML/XML'
                    },
                    {
                        language: 'java',
                        label: 'Java'
                    },
                    {
                        language: 'javascript',
                        label: 'JavaScript'
                    },
                    {
                        language: 'php',
                        label: 'PHP'
                    },
                    {
                        language: 'python',
                        label: 'Python'
                    },
                    {
                        language: 'ruby',
                        label: 'Ruby'
                    },
                    {
                        language: 'typescript',
                        label: 'TypeScript'
                    }
                    ]
                }

            })
            .catch(error => {
                console.error(error);
            });
    }


}

function showHideSearch() {

    const formSearch = document.getElementById("form-search");
    const iconSearch = document.getElementById("icon-search");

    if (formSearch.getAttribute("class").includes("d-none")) {
        formSearch.setAttribute("class", "d-block");
        iconSearch.setAttribute("class", "fa fa-times");
    } else {
        formSearch.setAttribute("class", "d-none");
        iconSearch.setAttribute("class", "fa fa-search");
    }

}

window.onload = init;