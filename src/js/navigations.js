// import $ from "jquery";

/**
 * Объект панелей навигации
 */
export let navigations = {

    /**
     * Главная шапка сайта
     */
    mainHeader: $("#js-main-header"),

    /**
     * Главная навигационная панель сайта
     */
    navigation: $("#js-main-navigation"),

    /**
     * Информация о сайте в панели навигации
     */
    siteInfoInNav: $("#js-main-nav-site-info"),

    /**
     * Меню из нескольких элементов в панели навигации
     */
    menuInNav: $("#js-main-nav-menu"),

    /**
     * Кнопка открытия/закрытия меню
     */
    toggleMenuBtn: $("#js-toggle-menu"),

    /**
     * Инициализирует панели навигации, вешая обработчики на элементы
     */
    init: function () {
        let toggleMenuBtn = this.toggleMenuBtn;

        /**
         * Обработчик открытия/закрытия основоного меню сайта
         */
        toggleMenuBtn.on('click', function () {
            toggleMenuBtn.toggleClass("menu-opened");
            $("#js-overlay").toggleClass("open");
            $("#js-main-menu-container").slideToggle();
            return false;
        });

        /**
         * Убирает обработку нажатия ссылки на заголовках меню
         */
        $(".menu__title > a").each(function (index, element) {
            if ($(element).attr('href') === "#")
                $(element).replaceWith(function () {
                    return $("<div>", {
                        html: this.innerHTML,
                        class: "menu__title"
                    })
                });
        });

        this.changeBgForMainNav();
        this.checkSizes();
    },

    /**
     * Синхронизирует задний фон (градиент) панели навигации с шапкой сайта
     */
    changeBgForMainNav: function () {
        this.navigation.css("background-size", "100% " + this.mainHeader.outerHeight() + "px");

        // Если панель навигации находится в поле шапки, не доходя до её низа
        if (this.mainHeader.outerHeight() - $(window).scrollTop() > this.navigation.height()) {
            this.navigation.css("background-position-y", -$(window).scrollTop());
            this.siteInfoInNav.removeClass("visible");
        } else {
            this.siteInfoInNav.addClass("visible");
            this.navigation.css("background-position-y", -(this.mainHeader.outerHeight() - this.navigation.outerHeight(true)));
        }
    },

    /**
     * Проверяет размеры панели навигации и контента в нём.
     * Если размер контента равен или больше размеру панели,
     * скрывается меню в панели навигации
     */
    checkSizes: function () {
        let wrapperWidth = $(".wrapper", this.navigation).width(),
            contentWidth = this.calcContentWidthInNav();

        if (wrapperWidth - contentWidth <= 10)
            this.hideMenuInNav();
        else {
            this.viewMenuInNav();

            if (wrapperWidth - this.calcContentWidthInNav() <= 10) {
                this.hideMenuInNav();
            }
        }
    },

    /**
     * Подсчитывает ширину контента в панели навигации
     * @returns {*}
     */
    calcContentWidthInNav: function () {
        return this.siteInfoInNav.outerWidth(true) + this.toggleMenuBtn.outerWidth(true) + this.menuInNav.outerWidth(true);
    },

    /**
     * Скрывает меню в панели навигации
     */
    hideMenuInNav: function () {
        this.menuInNav.addClass("hidden");
    },

    /**
     * Показывает меню в панели навигации
     */
    viewMenuInNav: function () {
        this.menuInNav.removeClass("hidden");
    },

    /**
     * Набор выполняемых функций при скролле
     */
    onScroll: function () {
        this.changeBgForMainNav();
        this.checkSizes();
    }

};