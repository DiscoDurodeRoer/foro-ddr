                </div>
                </div>
                </div>
                </div>
                <!-- Fin contenido -->

                <div class="row-no-gutters" id="footer">
                    <div class="col-12">
                        <div class="container">
                            <div class="footer-start">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <span>
                                            V-0.0.1
                                            | <a href="#">Reglas del foro </a>
                                            | <a target="_blank" href="https://www.discoduroderoer.es/contactanos/">Contacto</a>
                                            | <a href="#">Cookies</a>
                                            | <a href="#">Ayuda</a>
                                            | <a target="_blank" href="https://github.com/DiscoDurodeRoer/foro-ddr">Github</a>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center pt-2 pb-2">
                                        <span>&#169; <b>Disco Duro de Roer.</b> Todos los derechos reservados</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Scripts -->

                <script src="./includes/jquery-3.4.1/jquery-3.4.1.min.js"></script>
                <script src="./includes/bootstrap-4.1.3/js/bootstrap.min.js"></script>
                <script src="./includes/ckeditor5/ckeditor.js"></script>


                <script>
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
                </script>

                </body>

                </html>