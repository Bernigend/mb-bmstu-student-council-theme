// import $ from "jquery";

/**
 * Объект событий
 */
export let events = {

    init: function () {
        this.setShadowColorOfAllPosters();
    },

    /**
     * Устанавливает цвет тени постеров к мероприятиям
     */
    setShadowColorOfAllPosters: function () {
        $(".event-poster").each(function (index, element) {
            let shadowColor = $(element).data('shadow-color');
            if (!shadowColor)
                return;
            $(element).css("color", shadowColor);
        });
    }

};