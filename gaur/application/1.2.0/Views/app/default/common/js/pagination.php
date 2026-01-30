    <script>
    (() => {
        "use strict";

        let $, gform;

        function getPagination(paginationElm) {
            gform.request("get", paginationElm.attr("data-url"))
                .on("progress", gform.progress)
                .send()
                .then((response) => {
                    const {data} = response;

                    if (data && data.content) {
                        paginationElm.html(data.content);
                    }
                });
        }

        function init() {
            $ = jQuery;
            gform = new GForm();

            const paginationElm = $(".j-pagination");

            if (paginationElm.length) {
                getPagination(paginationElm);
            }
        }

        (window._jq = window._jq || []).push(init);
    })();
    </script>

    <script type="text/x-async-js" data-src="js/form.js" data-type="module" class="j-ajs"></script>
