import "./scss/style.scss";
// import $ from "jquery";
// import * as Sentry from '@sentry/browser';
import { events } from "./js/events";
import { navigations } from "./js/navigations";
import { news } from "./js/news";
import { page } from "./js/page";
import { filters } from "./js/filters";

(function () {

    // Sentry.init({ dsn: 'https://cb21f6f16f934513a1a4689b03197a47@sentry.io/1878590' });

    page.init();

    events.init();

    navigations.init();

    filters.init();

    $(window).on("scroll", function() {
        navigations.onScroll();
    });

    $(window).on("resize", function () {
        page.onResize();
        news.lastNews.setPreviewSize();
        navigations.checkSizes();
    });

    news.lastNews.init();

})();