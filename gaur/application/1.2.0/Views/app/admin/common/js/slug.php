    <script>
    (() => {
        "use strict";

        let $;

        function initSlug() {
            $("[name=title]").on("keyup", (e) => {
                let slug = $(e.target).val()
                    .replace(/[^a-zA-Z0-9\-]+/g, "-")
                    .replace(/-+/g, "-")
                    .replace(/^-+|-+$/g, "")
                    .toLowerCase();

                $("[name=slug]").val(slug);
            });
        }

        function init() {
            $ = jQuery;
            initSlug();
        }

        (window._jq = window._jq || []).push(init);
    })();
    </script>