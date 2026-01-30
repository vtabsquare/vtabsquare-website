    <script>
    (() => {
        "use strict";

        let $, gform, jar;

        function assembleInputs(uinputs) {
            const inputs = {};
            let key;

            Object.keys(uinputs)
                .filter(k => k.indexOf(".") > 0)
                .map(k => k.split(".")[0])
                .filter((k, i, o) => o.indexOf(k) === i)
                .forEach(k => inputs[k] = {});

            for (const [k, v] of Object.entries(uinputs)) {
                delete uinputs[k];

                if (k.indexOf(".") > 0) {
                    key = k.split(".");

                    inputs[key[0]][key[1]] = v;
                } else {
                    inputs[k] = v;
                }
            }

            Object.assign(uinputs, inputs);

            return inputs;
        }

        function getFiles(form) {
            const files = {};
            let uconfig, i, fk;

            for (let elm of $("input[type=file]", form).toArray()) {
                i = 0;
                elm = $(elm);

                if (!elm.attr("data-name") || !elm.prop("files").length) {
                    continue;
                }

                uconfig = {
                    error: (e) => gform.error(e, jar),
                    size: elm.attr("data-size"),
                    types: elm.attr("data-types").split(",")
                };

                for (const file of Array.from(elm.prop("files"))) {
                    uconfig.file = file;

                    if (!gform.isValidFile(uconfig)) {
                        return false;
                    }

                    fk = elm.attr("data-index") || i;
                    files[elm.attr("data-name") + "." + fk] = file;
                    i += 1;
                }
            }

            return files;
        }

        function submitData() {
            const uinputs = {},
            form = $("form", jar);

            for (const elm of $("[name]", form).toArray()) {
                uinputs[$(elm).attr("name")] = $(elm).val();
            }

            assembleInputs(uinputs);

            gform.request(form.attr("data-method") || form.attr("method"), form.attr("data-url"))
                .data(uinputs)
                .on("progress", gform.progress)
                .send()
                .then((response) => {
                    const {errors, data} = response;

                    if (errors) {
                        gform.error(errors, jar);
                        return;
                    }

                    $(".j-success", jar).text(data.message).removeClass("d-none");
                    form.addClass("d-none");

                    if (typeof data.link === "string") {
                        setTimeout(() => {
                            location.href = data.link;
                        }, Number(form.attr("data-timeout")));
                    }
                });
        }

        function uploadFile(name, file, callback) {
            const uinputs = {
                file: name.split(".")[0]
            };

            uinputs[name] = file;

            assembleInputs(uinputs);

            gform.request("post", $(jar).attr("data-image-url"))
                .data(uinputs)
                .on("progress", gform.progress)
                .upload(true)
                .send()
                .then((response) => {
                    const {errors} = response;

                    if (errors) {
                        gform.error(errors, jar);
                        return;
                    }

                    callback();
                });
        }

        function uploadQueue(files) {
            const file = files.pop();

            if (file) {
                uploadFile(file[0], file[1], () => {
                    setTimeout(
                        () => uploadQueue(files),
                        250
                    );
                });
            } else {
                submitData();
            }
        }

        function submitForm(form) {
            const files = getFiles(form);

            if (!files) {
                return;
            }

            uploadQueue(Object.entries(files).reverse());
        }

        function init() {
            $ = jQuery;
            gform = new GForm();
            jar = document.querySelector("#j-ar");

            $("form", jar).on("submit", (e) => {
                e.preventDefault();
                submitForm($(e.target));
            });
        }

        (window._jq = window._jq || []).push(init);
    })();
    </script>

    <script type="text/x-async-js" data-src="js/form.js" data-type="module" class="j-ajs"></script>
