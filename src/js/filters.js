// import $ from "jquery";

/**
 * Объект фильтров на странице категорий
 * @type {{init: filters.init}}
 */
export let filters = {

    /**
     * Инициализирует работу фильтров, вешая обработчики на его элементы
     */
    init: function () {
        let filter = $("#js-filter") || false,
            yearNumber = $("#js-filter-year") || false;

        if (!filter) return;

        /**
         * Инициализируем обработку нажатий на следующий/предыдущий год
         */
        if (yearNumber) {
            $("#js-filter-next-year").on("click", function (event) {
                event.preventDefault();
                yearNumber.text(parseInt(yearNumber.text()) + 1);
            });

            $("#js-filter-last-year").on("click", function (event) {
                event.preventDefault();
                yearNumber.text(parseInt(yearNumber.text()) - 1);
            });
        }

        let filterMonths = $(".filter__months", filter) || false;

        /**
         * Инициализируем обработку нажатий на элементы списка месяцев
         */
        if (filterMonths) {
            if (filterMonths.data("chosen"))
                $("li", filterMonths)[parseInt(filterMonths.data("chosen")) - 1].className = "chosen";

            $("li", filterMonths).on("click", function (event) {
                if (!$("li.chosen", filterMonths).is($(event.target)))
                    $("li.chosen", filterMonths).removeClass('chosen');

                $(this).toggleClass("chosen");
            });
        }

        let filterChooseBtn = $("#js-filter-btn") || false;

        /**
         * Инициализирует работу фильтра
         */
        if (filterChooseBtn) {
            filterChooseBtn.on("click", function () {
                let chosenMonth = $("li.chosen", filterMonths);

                if (!chosenMonth.length) {
                    filters.printWarning("Выберите месяц");
                    return;
                }

                if (!chosenMonth.data("month")) {
                    filters.printWarning("Что-то пошло не так", "У элемента отсутствует data-month");
                    return;
                }

                location.href = "?filter&f_month=" + chosenMonth.data("month") + "&f_year=" + $("#js-filter-year").text();
            });
        }
    },

    /**
     * Выводит блок предупреждения фильтра
     * @param message - сообщение пользователю
     * @param toConsole - сообщение в консоль
     */
    printWarning: function (message, toConsole = "filter warning") {
        $("#js-filter-warning").addClass("opened").html(message);
        console.log(toConsole);
    },

    /**
     * Скрывает блок предупреждения фильтра
     */
    hideWarning: function () {
        $("#js-filter-warning").removeClass("opened");
    }
};