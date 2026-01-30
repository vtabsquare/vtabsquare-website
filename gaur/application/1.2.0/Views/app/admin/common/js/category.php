    <script>
    (() => {
        "use strict";

        let $, gform, jar;

        function sortCategories(items) {
            const categoriesMap = {},
            categories = {};

            for (const k of Object.keys(items)) {
                categoriesMap[items[k].join(" > ")] = k;
            }

            for (const k of Object.keys(categoriesMap).sort()) {
                categories[k] = categoriesMap[k];
            }

            return categories;
        }

        function getCategoryListFrg(items) {
            const frg = $(document.createDocumentFragment()),
            elm = $(document.createElement("option"));
            let celm;

            for (const [name, id] of Object.entries(sortCategories(items))) {
                celm = elm.clone();
                celm.val(id).text(name);
                frg.append(celm);
            }

            return frg;
        }

        function getCategories() {
            const categoryElm = $(".j-category", jar);

            gform.request("get", categoryElm.attr("data-url"))
                .on("progress", gform.progress)
                .send()
                .then((response) => {
                    const {errors, data} = response;

                    if (errors) {
                        gform.error(errors, jar);
                        return;
                    }

                    categoryElm.append(getCategoryListFrg(data))
                        .val(categoryElm.attr("data-value") || "");

                    initSelect(categoryElm);
                });
        }

        function initSelect(categoryElm) {
            if (categoryElm.attr("data-multiple") !== undefined) {
                const value = (categoryElm.attr("data-value") || "")
                    .split(",")
                    .filter(v => v !== "");

                categoryElm.prop("multiple", true).val(value).chosen({
                    max_selected_options: Number(categoryElm.attr("data-max")),
                    width: "100%"
                });
            } else {
                categoryElm.chosen({
                    width: "100%"
                });
            }
        }

        function init() {
            $ = jQuery;
            gform = new GForm();
            jar = document.querySelector("#j-ar");

            getCategories();
        }

        (window._jq = window._jq || []).push(init);
    })();
    </script>

    <!-- chosen -->
    <script type="text/x-async-css" data-src="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.min.css" data-integrity="sha384-O/61W5+JcqpaKJvGYKd2WFU6LmUZmj6tnkyaunOvHcQ+NzAgIR51q2t2xOoGg86z" class="j-acss"></script>
    <script type="text/x-async-js" data-src="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.jquery.min.js" data-integrity="sha384-f7i3wx95GUaq/1ED3jYQs30oXd4a1nL5q5TIA77QbZdDimOMAqtQte21IkV6Nt6k" class="j-ajs"></script>
