    <script>
    (() => {
        "use strict";

        let $, jar;

        function removeHandler() {
            $(".j-img-remove", jar).on("click", (e) => {
                let elm = $(e.target);

                if (elm.prop("tagName") === "SPAN") {
                    elm = elm.parent();
                }

                if (elm.prop("tagName") !== "BUTTON"
                    || elm.attr("data-action") !== "remove") {
                    return;
                }

                elm.closest(".j-img-item").addClass("d-none").find("input[type=file]").val("");
                elm.prev().attr("name", elm.prev().attr("data-name"));
            });
        }

        function init() {
            $ = jQuery;
            jar = document.querySelector("#j-ar");

            removeHandler();
        }

        (window._jq = window._jq || []).push(init);
    })();
    </script>
