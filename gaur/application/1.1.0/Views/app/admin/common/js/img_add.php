    <div class="j-img-frg d-none">
        <div class="col-md-4 form-group j-img-item">
            <label>Image </label>
            <div class="input-group">
                <input class="form-control" data-name="images" data-size="10MB" data-types="jpeg,jpg,png" type="file">
                <div class="input-group-append">
                    <input type="checkbox" data-name="images" class="d-none">
                    <button class="btn btn-danger" type="button" data-action="remove">
                        <span class="fas fa-minus"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    (() => {
        "use strict";

        let $, jar;

        function addHandler() {
            const frg = $(".j-img-frg").children();

            $(".j-img-add", jar).on("click", (e) => {
                const elm = $(e.target).closest(".j-img-add"),
                cfrg = frg.clone(),
                index = Number(elm.attr("data-index"));

                let telm;

                if (index >= elm.attr("data-limit")) {
                    return;
                }

                telm = cfrg.find("label");
                telm.text(telm.text() + (index + 1));

                telm = cfrg.find("input[type=checkbox]");
                telm.attr(
                    "data-name",
                    telm.attr("data-name") + "." + index
                ).val(index);

                cfrg.find("input[type=file]").attr(
                    "data-index",
                    index
                );

                elm.closest(".j-img-item").before(cfrg);
                elm.attr("data-index", index + 1);

                if (index + 1 >= elm.attr("data-limit")) {
                    elm.addClass("d-none");
                }
            });
        }

        function init() {
            $ = jQuery;
            jar = document.querySelector("#j-ar");

            addHandler();
        }

        (window._jq = window._jq || []).push(init);
    })();
    </script>
