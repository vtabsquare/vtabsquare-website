    <div class="modal fade" id="j-browse-image-modal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Browse images</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= view('app/admin/common/app/content_top') ?>

                   <div data-jitem="items"></div>
 
                    <?= view('app/admin/common/app/content_bottom') ?>
                    <?= view('app/admin/common/app/footer') ?>
                </div>
            </div>
        </div>
    </div>

    <script>
    (() => {
        "use strict";

        let $, jar;

        class Editor {
            static init() {
                const configs = {
                    callbacks: {
                        onChange(code, elms) {
                            Editor.updateEmbeds(elms);
                        },

                        onImageLinkInsert(url) {
                            Editor.insertImage(url);
                        },

                        onImageUpload(files) {
                            Image.upload(Array.from(files));
                        }
                    },
                    height: 400,
                    toolbar: [
                        ["font", ["fontname", "fontsize", "color", "bold", "italic", "underline", "strikethrough", "superscript", "subscript", "clear"]],
                        ["insert", ["picture", "link", "video", "table", "hr"]],
                        ["paragraph", ["style", "ol", "ul", "paragraph", "height"]],
                        ["misc", ["fullscreen", "codeview", "undo", "redo", "help"]]
                    ]
                };

                this.editorElm = $(".j-editor", jar);
                this.editor = this.editorElm.summernote(configs);
            }

            static insertImage(url) {
                const img = document.createElement("img");
                img.src = url;
                img.className = "img-fluid";
                img.style.margin = "0 10px";

                this.editor.summernote("insertNode", img);
            }

            static updateEmbeds(elms) {
                for (const elm of $("iframe", elms).toArray()) {
                    $(elm).css({
                        "max-width": "100%"
                    });
                }
            }
        }

        class Image {
            static init() {
                this.browseImageModal = $("#j-browse-image-modal");
                this.insertImageModal = $(".note-group-select-from-files").closest(".modal");

                const configs = {
                    context: this.browseImageModal[0],
                    listCount: 10,
                    url: "admin/images/" + Editor.editorElm.attr("data-image"),
                    postMessage(message, param) {
                        if (ImageCallback[message]) {
                            ImageCallback[message](param);
                        }
                    }
                };

                this.image = new GImage();
                this.image.init(configs);
            }

            static upload(files) {
                this.image.upload(
                    files,
                    Editor.editorElm.attr("data-size"),
                    Editor.editorElm.attr("data-types").split(",")
                );
            }
        }

        class ImageCallback {
            static addbrowseimagebutton({ elm }) {
                Image.insertImageModal.find(".modal-footer").prepend(elm);
            }

            static hidebrowseimagemodal() {
                Image.browseImageModal.modal("hide");
            }

            static hideinsertimagemodal() {
                Image.insertImageModal.modal("hide");
            }

            static insertimage({ url }) {
                Editor.insertImage(url);
            }

            static showbrowseimagemodal() {
                Image.browseImageModal.modal("show");
            }

            static showerrors({ errors }) {
                (new GForm()).error(errors, jar);
            }
        }

        function init() {
            $ = jQuery;
            jar = document.querySelector("#j-ar");

            Editor.init();
            Image.init();
        }

        (window._jq = window._jq || []).push(init);
    })();
    </script>

    <script type="text/x-async-js" data-src="js/image.js" data-type="module" class="j-ajs"></script>

    <!-- summernote -->
    <script type="text/x-async-js" data-src="https://cdn.jsdelivr.net/gh/FezVrasta/popper.js@1.16.1/dist/umd/popper.min.js" data-integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" class="j-ajs"></script>
    <script type="text/x-async-js" data-src="https://cdn.jsdelivr.net/gh/twbs/bootstrap@4.5.2/dist/js/bootstrap.min.js" data-integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" class="j-ajs"></script>
    <script type="text/x-async-css" data-src="https://cdn.jsdelivr.net/gh/summernote/summernote@0.8.18/dist/summernote-bs4.min.css" data-integrity="sha384-6mflaypJfpnY2bh8RD/nFoaOC8Isbpqg5t4Llivq2tf6k1taR8hdoP3hQIph4qIo" class="j-acss"></script>
    <script type="text/x-async-js" data-src="https://cdn.jsdelivr.net/gh/summernote/summernote@0.8.18/dist/summernote-bs4.min.js" data-integrity="sha384-i2Bp4eSJchLbcNhKfUAYCjD+Og0pvh5YgJRQ9PFln4m2cLs10fQa+gkhwdviv0ap" class="j-ajs"></script>
