$(function(){

var Item = {
    init: function( config ) {
        this.config = config;

        this.bindEvents();
    },

    // Обработчик пользовательских событий
    bindEvents: function() {

        // Щелчок по уменьшенной картинке и переключение большой картинки на нее
        $('#thumbs-images-block img').on('click', function() {
            // console.log($(this).data('full_image'));
            $('#main-image-block img').attr('src', $(this).data('full_image'));
        });
        // Увеличение большой картинки при наведении

        // Выбор цвета (переключение картинок и размеров и добавление цвета в форму)
        $('#colors-list img').on('click', function() {
            var color_number = $(this).data('color_number');
            var old_size_value = $('.size-selected').data('size_value');

            $('.image-block').each(function(index){
                if ($(this).data('image_block_number') == color_number) {
                    $(this).removeClass('hidden-block');
                    $('#main-image-block img').attr('src', $(this).find('#thumbs-images-block img').first().data('full_image'));
                } else {
                    $(this).addClass('hidden-block');
                }
            });

            $('.sizes-block').each(function() {
                if ($(this).data('sizes_block_number') == color_number) {
                    $(this).removeClass('hidden-block');

                    $(this).find('span.size').removeClass('size-selected');
                    $(this).find('span.size').first().addClass('size-selected');

                    $(this).find('span.size').each(function(){
                        if ($(this).data('size_value') == old_size_value) {

                            $('.sizes-block span.size').removeClass('size-selected');
                            $(this).addClass('size-selected');
                        }
                    });
                } else {
                    $(this).addClass('hidden-block');
                }
            });

            Item.syncColorValue();
            Item.syncSizeValue();
        });
        $('#colors-list img').on('click', function() {
            $('#colors-list img').removeClass('color-selected');
            $(this).addClass('color-selected');

            Item.syncColorValue();
            Item.syncSizeValue();
        });

        // Выбор размера: занесение размера в форму
        $('.sizes-block span.size').on('click', function() {
            $('.sizes-block span.size').removeClass('size-selected');
            $(this).addClass('size-selected');

            Item.syncColorValue();
            Item.syncSizeValue();
        });

        $('#submit').on('click', function(e){
            var color_value = $('.color-selected').data('color_value');
            var size_value = $('.size-selected').data('size_value');

            $('.hidden-fields input[name="color"]').val(color_value);
            $('.hidden-fields input[name="size"]').val(size_value);

            // e.preventDefault();
        });
    },

    syncColorValue: function() {
        $('.color-span').text($('.color-selected').attr('title'));
    },

    syncSizeValue: function() {
        $('.size-span').text($('.size-selected').data('size_value'));
    }
};

Item.init({
    body: $('body')
});



setInterval(function(){
    var $active = $('.bgr-active');
    var $next = ($('.bgr-active').next().length > 0) ? $('.bgr-active').next() : $('.background:first');
    // console.log($next);
    $active.fadeOut(function(){
        $active.fadeOut(3000).removeClass('bgr-active');
        $next.fadeIn(3000).addClass('bgr-active');
    });
}, 8000);



});