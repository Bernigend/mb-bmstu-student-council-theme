// import $ from "jquery";

/**
 * Объект новостей
 */
export let news = {

    /**
     * Объект последних новостей
     */
    lastNews: {
        lastNewsContainer: $("#js-last-news-container"),
        newsPreview: $("#js-preview-news"),

        /**
         * Инициализирует блок последних новостей, вешая обработчики событий на его элементы
         */
        init: function () {
            let newsPreview = this.newsPreview;

            /**
             * Устанавливает задний фон превьюшки новости
             * @param previewUrl
             */
            let setNewsPreviewBg = function (previewUrl) {
                if (!previewUrl) {
                    newsPreview.addClass("no-thumbnail");
                    newsPreview.css('background-image', '');
                } else {
                    newsPreview.removeClass("no-thumbnail");
                    newsPreview.css('background-image', 'url(' + previewUrl + ')');
                }
            };

            /**
             * Вешает обработчики на наведение на элемент списка новостей
             */
            $(".news", this.lastNewsContainer).hover(function() {
                let previewUrl = $("img", $(this)).attr('src');
                setNewsPreviewBg(previewUrl);

                newsPreview.data('url', $("a", $(this)).attr('href'));
                $("#js-last-news-container li.active").removeClass('active');
                $(this).addClass('active');
            });

            newsPreview.on('click', function () {
                location.href = $(this).data('url') || '#';
            });

            setNewsPreviewBg($("ul li:first img", newsPreview.parent()).attr('src'));

            this.setPreviewSize();
        },

        /**
         * Устанавливает размеры превью-изображения новости
         */
        setPreviewSize: function () {
            let newsPreview = this.newsPreview;

            newsPreview.height(newsPreview.parent().outerHeight(true));
            newsPreview.width(newsPreview.parent().outerWidth() - $("ul", newsPreview.parent()).outerWidth());
            newsPreview.data('url', $("ul li:first a", newsPreview.parent()).attr('href'));
        },

    }

};