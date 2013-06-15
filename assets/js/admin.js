$(function(){

// Создаем в прототипе класса массивов два метода для нахождения минимального и максимального элементов массива.
Array.prototype.max = function () {
    return Math.max.apply(Math, this);
};
Array.prototype.min = function () {
    return Math.min.apply(Math, this);
};

var Item = {
    init: function( config ) {
        this.config = config;

        this.setupTemplates();
        this.bindEvents();
    },

    // Обработчик пользовательских событий
    bindEvents: function() {
        this.config.addNewGroupButton.on('click', this.addNewGroup);
        this.config.addNewCollectionButton.on('click', this.addNewCollection);
        this.config.body.on('click', this.config.addNewColorButton.selector, this.addNewColor);
        this.config.body.on('click', this.config.addNewImageInNewColorButton.selector, this.addNewImageOfNewColor);
        this.config.addNewImageInExistingColorButton.on('click', this.addNewImageOfExistingColor);
        this.config.body.on('click', this.config.removeNewBlockButton.selector, this.removeNewElement);

        // -------------- Говно-код-MODE-ON

        // Удаление блока существующего цвета
        // Занесение идентификатора цвета в скрытое поле для последующего удаления.
        $('.remove-exist-color').on('click', function() {
            var context = {field_name: 'color', field_value: $(this).closest('.element-item').data('exist_color')};
            var source   = $("#remove-hidden-filed-template").html();
            var template = Handlebars.compile(source);

            $('.remove-exist-colors').append(template(context));
            $(this).closest('.element-item').remove();
        });

        // Удаление блока существующего изображения
        // Занесение идентификатора изображения в скрытое поле для последующего удаления.
        $('.remove-exist-image').on('click', function() {
            var context = {field_name: 'image', field_value: $(this).closest('.element-item').data('image')};
            var source   = $("#remove-hidden-filed-template").html();
            var template = Handlebars.compile(source);

            $('.remove-exist-images').append(template(context));
            $(this).closest('.element-item').remove();
        });

        // Удаление блока существующей группы
        // Занесение идентификатора группы в скрытое поле для последующего удаления.
        $('.remove-exist-group').on('click', function() {
            var context = {field_name: 'group', field_value: $(this).closest('.element-item').data('group')};
            var source   = $("#remove-hidden-filed-template").html();
            var template = Handlebars.compile(source);

            $('.remove-exist-groups').append(template(context));
            $(this).closest('.element-item').remove();
        });

        // Удаление блока существующей коллекции
        // Занесение идентификатора коллекции в скрытое поле для последующего удаления.
        $('.remove-exist-collection').on('click', function() {
            var context = {field_name: 'collection', field_value: $(this).closest('.element-item').data('collection')};
            var source   = $("#remove-hidden-filed-template").html();
            var template = Handlebars.compile(source);

            $('.remove-exist-collections').append(template(context));
            $(this).closest('.element-item').remove();
        });

        // Выбор цветовой гаммы для товара, с уже существующим цветом
        $('body').on('click', '.catalog-color .color-select', function() {
            var color_value = $(this).data('color');
            var color_id = $(this).closest('.catalog-block').data('exist_color');

            $(this).closest('.catalog-block').find('.color-select').removeClass('color-preview-selected');
            $(this).addClass('color-preview-selected');
            $('.hidden-block input[name="exist_color[' + color_id + ']"]').val(color_value);
        });

        // Выбор цветовой гаммы для товара, с только что созданным цветом
        $('body').on('click', '.catalog-new-color .color-select', function() {
            var color_value = $(this).data('color');
            var color_id = $(this).closest('.catalog-block').data('new_color');

            $(this).closest('.catalog-block').find('.color-select').removeClass('color-preview-selected');
            $(this).addClass('color-preview-selected');
        });

        // Перед отправкой формы товара добавляем в скрытые поля информацию о добавленных цветах товара
        $('#submit-form').on('click', function() {
            $('.catalog-new-color').each(function( index ) {
                var color_value = $(this).find('.color-preview-selected').data('color');
                var new_color_id = $(this).data('new_color');

                var context = {color_value: color_value, new_color_id: new_color_id};
                var source   = $("#new-color-hidden-field-template").html();
                var template = Handlebars.compile(source);

                $('.new-colors-fields').append(template(context));
            });
        });

        // -------------- Говно-код-MODE-OFF

    },

    // Подготавливаем и компилируем шаблоны Handlebars
    setupTemplates: function() {
        if (typeof this.config.addGroupTemplate != 'undefined') {
            this.config.addGroupTemplate = Handlebars.compile(this.config.addGroupTemplate);
        }
        if (typeof this.config.addCollectionTemplate != 'undefined') {
            this.config.addCollectionTemplate = Handlebars.compile(this.config.addCollectionTemplate);
        }
        if (typeof this.config.addCollectionTemplate != 'undefined') {
            this.config.addImageInNewColorTemplate = Handlebars.compile(this.config.addImageInNewColorTemplate);
        }
        if (typeof this.config.addImageInExistingColorTemplate != 'undefined') {
            this.config.addImageInExistingColorTemplate = Handlebars.compile(this.config.addImageInExistingColorTemplate);
        }
        if (typeof this.config.addNewColorTemplate != 'undefined') {
            this.config.addNewColorTemplate = Handlebars.compile(this.config.addNewColorTemplate);
        }
    },

    // Добавляем еще один селект с выбором группы товаров
    addNewGroup: function() {
        Item.config.newGroupsBlock.append( Item.config.addGroupTemplate() );
    },

    // Добавляем еще один селект с выбором коллекции товаров
    addNewCollection: function() {
        Item.config.newCollectionsBlock.append( Item.config.addCollectionTemplate() );
    },

    // Создаем новый блок для добавления цвета товара
    addNewColor: function() {
        var array_of_data = [-1];

        $(Item.config.blocksOfNewColor.selector).each(function( index ) {
            array_of_data.push($(this).data('new_color'));
        });

        var new_color_counter = array_of_data.max() + 1;
        var context = {new_color_counter: new_color_counter};

        Item.config.newColorsBlock.append( Item.config.addNewColorTemplate(context) );
    },

    // Создаем блок для добавления изображения для нового цвета
    addNewImageOfNewColor: function() {
        var inputs = $(this).closest('.controls').find('.element-item input');
        var images_counter = 0;

        if (inputs.length != 0) {
            var array_of_data = [];

            inputs.each(function( index ) {
                array_of_data.push($(this).data('images_counter'));
            });
            images_counter = array_of_data.max() + 1;
        }

        var new_color_id = $(this).closest(Item.config.blocksOfNewColor.selector).data('new_color');
        var context = {new_color_id: new_color_id, images_counter: images_counter};

        $(this).prev(Item.config.newImagesBlock.selector).append( Item.config.addImageInNewColorTemplate(context) );
    },

    // Создаем блок для добавления изображения для уже существующего цвета
    addNewImageOfExistingColor: function() {
        var inputs = $(this).closest('.controls').find('.element-item input');
        var images_counter = 0;
        var color_id = $(this).closest(Item.config.blocksOfExistingColor.selector).data('exist_color');

        if (inputs.length != 0) {
            var array_of_data = [];

            inputs.each(function( index ) {
                array_of_data.push($(this).data('images_counter'));
            });
            images_counter = array_of_data.max() + 1;
        }

        var context = {color_id: color_id, images_counter: images_counter};
        $(this).prev(Item.config.newImagesBlock.selector).append( Item.config.addImageInExistingColorTemplate(context) );
    },

    // Удаляем только что созданный элемент
    removeNewElement: function() {
        $(this).closest(Item.config.elementBlock.selector).remove();
    }
};

Item.init({

    // Кнопки добавления
    addNewGroupButton:                  $('.add-catalog-group'),
    addNewCollectionButton:             $('.add-catalog-collection'),
    addNewColorButton:                  $('.add-catalog-color'),
    addNewImageInExistingColorButton:   $('.add-catalog-image-of-exist-color'),
    addNewImageInNewColorButton:        $('.add-catalog-image-of-new-color'),

    // Кнопки удаления
    removeNewBlockButton:       $('.remove-new-item'),
    removeExistingBlockButton:  $('.remove-item'),

    // Шаблоны
    addGroupTemplate:                   $("#catalog-group-template").html(),
    addCollectionTemplate:              $("#catalog-collection-template").html(),
    addImageInNewColorTemplate:         $("#catalog-image-of-new-color-template").html(),
    addImageInExistingColorTemplate:    $("#catalog-image-of-exist-color-template").html(),
    addNewColorTemplate:                $("#catalog-color-template").html(),

    // Блоки для вывода
    newGroupsBlock:         $('.catalog-groups'),
    newCollectionsBlock:    $('.catalog-collections'),
    newColorsBlock:         $('.catalog-colors'),
    newImagesBlock:         $('.catalog-images'),

    // Общие элементы
    blocksOfExistingColor: $('.catalog-color'),
    blocksOfNewColor: $('.catalog-new-color'),
    elementBlock: $('.element-item'),
    body: $('body')
});






//     $('.add-catalog-group').on('click', function() {
//         var source   = $("#catalog-group-template").html();
//         var template = Handlebars.compile(source);

//         $('.catalog-groups').append(template);
//     });

//     $('.add-catalog-collection').on('click', function() {
//         var source   = $("#catalog-collection-template").html();
//         var template = Handlebars.compile(source);

//         $('.catalog-collections').append(template);
//     });

//     $('.add-catalog-color').on('click', function() {
//         var new_color_counter = $('.catalog-new-color').length;
//         var context = {new_color_counter: new_color_counter};
//         var source   = $("#catalog-color-template").html();
//         var template = Handlebars.compile(source);

//         $('.catalog-colors').append(template(context));
//     });

//     $('body').on('click', '.add-catalog-image-of-new-color', function() {
//         var new_color_id = $(this).closest('.catalog-new-color').data('new_color');
//         var context = {new_color_id: new_color_id};
//         var source   = $("#catalog-image-of-new-color-template").html();
//         var template = Handlebars.compile(source);

//         $(this).prev('.catalog-images').append(template(context));
//     });

//     $('.add-catalog-image-of-exist-color').on('click', function() {
//         var color_id = $(this).closest('.catalog-color').data('color');
//         var context = {color_id: color_id};
//         var source   = $("#catalog-image-of-exist-color-template").html();
//         var template = Handlebars.compile(source);

//         $(this).prev('.catalog-images').append(template(context));
//     });

//     $('body').on('click', '.remove-new-item', function() {
//         $(this).closest('.element-item').remove();
//     });


});



