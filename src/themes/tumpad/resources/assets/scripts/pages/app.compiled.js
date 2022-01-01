/* global jQuery */
import getBrowser from "../util/getBrowser";
import "../util/hideOutline";

jQuery(document).ready(function ($) {
    /**
     * Adds browser class to body
     */
    (function () {
        let who = getBrowser();
        if (who[0]) {
            if (!Array.isArray(who)) {
                who = who.split(" ");
            }
            jQuery("body").addClass("is-" + who[0].toLowerCase());
        }
    })();
});
