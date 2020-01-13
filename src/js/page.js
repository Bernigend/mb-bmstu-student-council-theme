// import $ from "jquery";

/**
 * Объект страницы
 */
export let page = {

    /**
     * Обёртка страницы
     */
    page: $("#js-page"),

    /**
     * Главный футер (подвал) сайта
     */
    footer: $("#js-main-footer"),

    /**
     * Контейнер перед футером
     */
    preFooter: $("#js-pre-footer"),

    /**
     * Тёмный задний фон при открытии чего-либо
     */
    overlay: $("#js-overlay"),

    /**
     * Правая колонка
     */
    aside: $("#js-aside"),

    /**
     * Инициализирует элементы страницы, вешая на них обработчики событий и выполняя вычисления
     */
    init: function () {

        let overlay = this.overlay,
            aside = this.aside;

        $("#js-page-up").on("click", function () {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        });

        $("#js-aside-open").on("click", function () {
            aside.addClass("mobile-opened");

            overlay
                .addClass("aside-opened")
                .on("click", function () {
                    $("#js-aside").removeClass("mobile-opened");

                    overlay
                        .removeClass("aside-opened")
                        .off("click");
                });
        });

        $("#js-aside-close").on("click", function () {
            aside.removeClass("mobile-opened");
            overlay
                .removeClass("aside-opened")
                .off("click");
        });

        this.setHeights();
    },

    /**
     * Устанавливает высоту страницы и футера
     */
    setHeights: function (withNull = false) {
        if (withNull) {
            this.preFooter.css("height", "");
            this.footer.css("margin-top", "");
            this.page.css("min-height", "");
        }

        this.preFooter.css("height", this.footer.outerHeight());
        this.footer.css("margin-top", -(this.footer.outerHeight()));
        this.page.css("min-height", $(window).outerHeight(true));
    },

    /**
     * Набор функций при изменении размера страницы
     */
    onResize: function () {
        this.setHeights();
    }
};