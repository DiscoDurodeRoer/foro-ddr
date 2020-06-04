
function init() {
    initCheckEditor();
    initEvents();
}

function initEvents() {
    document.getElementById("icon-search").addEventListener("click", function () {
        showHideSearch();
    })
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