require('./bootstrap');
require('./jquery.lazy');
require('./jquery.maskedinput');
import {Swiper, Navigation} from "swiper";
import { Fancybox } from "@fancyapps/ui";


Fancybox.bind("[data-fancybox]", {
    // Your options go here
});

//Переключение табов в услугах
$(document).on("click", '#user-profile-show-services', function () {
    $(this).addClass('active');
    $("#user-profile-show-prices").removeClass('active');
    $(".user-profile-service-section-tab").toggleClass('d-none');
    $(".user-profile-prices-section-tab").toggleClass('d-none');
});
$(document).on("click", '#user-profile-show-prices', function () {
    $(this).addClass('active');
    $("#user-profile-show-services").removeClass('active');
    $(".user-profile-service-section-tab").toggleClass('d-none');
    $(".user-profile-prices-section-tab").toggleClass('d-none');
});

//Редактирование данных пользователя
$(document).on("click", '.edit-profile-base-info', function () {
    $(".profile-edit-base-info").removeClass("d-none");
    $(".profile-base-info").addClass("d-none");
    return false;
});
$(document).on('submit', 'form[name="form-user-about"]', function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        cache: false,
        success: function (response) {
            $(".profile-base-info").html(response.view);
            $(".profile-edit-base-info").addClass("d-none");
            $(".profile-base-info").removeClass("d-none");

            $('body').append(response.alert);
            FadeAlert();
        },
        error: function (response) {
        }
    });
});
//Редактирование скидки пользователя
$(document).on("click", '.edit-profile-discount-info', function () {
    $(".profile-edit-discount-info").removeClass("d-none");
    $(".profile-discount-info").addClass("d-none");
    return false;
});
$(document).on('submit', 'form[name="form-user-about"]', function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        cache: false,
        success: function (response) {
            $(".profile-discount-info").html(response.view);
            $(".profile-edit-discount-info").addClass("d-none");
            $(".profile-discount-info").removeClass("d-none");

            $('body').append(response.alert);
            FadeAlert();
        },
        error: function (response) {
        }
    });
});

$(document).on("click", 'span[data-link]', function () {
    //window.location = $(this).attr('data-link');
    window.open($(this).attr('data-link'), '_blank');
});

//Отправка формы загрузки изображения пользователя
$(document).on('change', '#user-upload-photo input', function (event) {
            let fd = new FormData();
            let files = event.target.files[0];
            fd.append('file', files);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/profile/uploadphoto/',
                type: 'POST',
                dataType: 'json',
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success == 1) {
                        $(".user-profile__image").find('img').attr('src',"/storage"+response.image);
                    } else {
                    }
                    $('body').append(response.alert);
                    FadeAlert();
                },
            });
});
//Отправка формы контактов
$(document).on('submit', 'form[name="contacts-form"]', function (e) {
    e.preventDefault();

    let Errors = 0;
    let thisForm = $('form[name="contacts-form"]');
    thisForm.find('button').addClass('loaded');

    thisForm.find('input').removeClass('error-validation');
    thisForm.find('.form-validation-errors').removeClass('alert alert-danger');
    thisForm.find('.form-validation-errors').html('');

    $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: $(this).attr('action'),
        data: $(this).serialize().replaceAll('contacts','field'),
        cache: false,
        success: function (response) {
            thisForm.find('button').removeClass('loaded');
            thisForm.find('.form-validation-errors').html(response.text);
            thisForm.find('.form-validation-errors').addClass('alert alert-success');
            thisForm.trigger("reset");
        },
        error: function (response) {
            thisForm.find('button').removeClass('loaded');
            thisForm.find('.form-validation-errors').addClass('alert alert-danger');
            thisForm.find('.form-validation-errors').html('');
            Object.keys(response.responseJSON.errors).forEach(function (key) {
                thisForm.find('input[name="' + key + '"]').addClass('error-validation');
                thisForm.find('.form-validation-errors').append("<div class=''>" + response.responseJSON.errors[key] + "</div>");
            });
        }
    });

});
//Регистрация пользователя
$(document).on('click', '.form-registration-change-number', function (e) {
    e.preventDefault();
    $(".registration-form.step-1").removeClass('d-none');
    $(".registration-form.step-2").addClass('d-none');
});

$(document).on('click', '.pre-registration-send', function (e) {
    e.preventDefault();

    let Errors = 0;
    let thisForm = $('form[name="form-registration"]');
    thisForm.find('button').addClass('loaded');
    thisForm.find('input').removeClass('error-validation');
    thisForm.find('.form-validation-errors').removeClass('alert alert-danger');
    thisForm.find('.form-validation-errors').html('');
    $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: "/profile/registration-check/",
        data: thisForm.serialize(),
        cache: false,
        success: function (response) {
            thisForm.find('button').removeClass('loaded');
            $(".registration-form.step-1").addClass('d-none');
            $(".registration-form.step-2").removeClass('d-none');
         //   alert(response.call)
        },
        error: function (response) {
            thisForm.find('button').removeClass('loaded');
            thisForm.find('.form-validation-errors').addClass('alert alert-danger');
            thisForm.find('.form-validation-errors').html('');
            Object.keys(response.responseJSON.errors).forEach(function (key) {
                thisForm.find('input[name="' + key + '"]').addClass('error-validation');
                thisForm.find('.form-validation-errors').append("<div class=''>" + response.responseJSON.errors[key] + "</div>");
            });
        }
    });
});

$(document).on('submit', 'form[name="form-registration"]', function (e) {
    e.preventDefault();

    let Errors = 0;
    let thisForm = $('form[name="form-registration"]');
    thisForm.find('button').addClass('loaded');

    thisForm.find('input').removeClass('error-validation');
    thisForm.find('.form-validation-errors').removeClass('alert alert-danger');
    thisForm.find('.form-validation-errors').html('');
    $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        cache: false,
        success: function (response) {
            thisForm.find('button').removeClass('loaded');
            if (response.success) {
                window.location = response.redirect;
            }
        },
        error: function (response) {
            thisForm.find('button').removeClass('loaded');
            thisForm.find('.form-validation-errors').addClass('alert alert-danger');
            thisForm.find('.form-validation-errors').html('');
            Object.keys(response.responseJSON.errors).forEach(function (key) {
                thisForm.find('input[name="' + key + '"]').addClass('error-validation');
                thisForm.find('.form-validation-errors').append("<div class=''>" + response.responseJSON.errors[key] + "</div>");
            });
        }
    });
});
//Авторизация пользователя
$(document).on('submit', 'form[name="form-login"]', function (e) {
    e.preventDefault();
    let Errors = 0;
    let thisForm = $('form[name="form-login"]');
    thisForm.find('button').addClass('loaded');
    thisForm.find('input').removeClass('error-validation');
    thisForm.find('.form-validation-errors').removeClass('alert alert-danger');
    thisForm.find('.form-validation-errors').html('');
    $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        cache: false,
        success: function (response) {
            thisForm.find('button').removeClass('loaded')
            if (response.success) {
                window.location = response.redirect;
            }
        },
        error: function (response) {
            thisForm.find('button').removeClass('loaded')
            thisForm.find('.form-validation-errors').addClass('alert alert-danger');
            thisForm.find('.form-validation-errors').html('');
            Object.keys(response.responseJSON.errors).forEach(function (key) {
                thisForm.find('input[name="' + key + '"]').addClass('error-validation');
                thisForm.find('.form-validation-errors').append("<div class=''>" + response.responseJSON.errors[key] + "</div>");
            });
        }
    });
});

$(document).on('submit', 'form[name="form-reset"]', function (e) {
    e.preventDefault();
    let Errors = 0;
    let thisForm = $('form[name="form-reset"]');
    thisForm.find('button').addClass('loaded');

    thisForm.find('input').removeClass('error-validation');
    thisForm.find('.form-validation-errors').removeClass('alert alert-danger');
    thisForm.find('.form-validation-errors').html('');
    $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        cache: false,
        success: function (response) {
            thisForm.find('button').removeClass('loaded')
            if (response.success) {
                thisForm.find('.form-validation-errors').html("<div class='alert alert-success'>" + response.success + "</div>");
            }
        },
        error: function (response) {
            thisForm.find('button').removeClass('loaded');
            thisForm.find('.form-validation-errors').addClass('alert alert-danger');
            thisForm.find('.form-validation-errors').html('');
            Object.keys(response.responseJSON.errors).forEach(function (key) {

                thisForm.find('input[name="' + key + '"]').addClass('error-validation');
                thisForm.find('.form-validation-errors').append("<div class=''>" + response.responseJSON.errors[key] + "</div>");
            });
        }
    });
});

//Выбор услуги в профиле пользователя
$(document).on('change', '.user-profile-service-input', function (e) {
    let priceInput = $(this).closest('.regions-list-item-city-service').find('.service-price-input input');
    if(priceInput.attr('disabled')){
        priceInput.attr('disabled',false);
    }else{
        priceInput.attr('disabled',true);
        priceInput.attr('value','');
    }

});
//Форма сохранения цена на услуги в кабинете пользователя
$(document).on('submit', 'form[name="form-user-services-price"]', function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        cache: false,
        success: function (response) {
            if(ShowPriceSaveAlert==1){
                $('body').append(response.alert);
                FadeAlert();
            }
            $(".save-from-sectin-slide").hide();
        },
        error: function (response) {

        }
    });
});
var ShowPriceSaveAlert = 1;
//Форма сохранения категорий в кабинете пользователя
$(document).on('submit', 'form[name="form-user-services"]', function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        cache: false,
        success: function (response) {
            $('body').append(response.alert);
            FadeAlert();

            $(".save-from-sectin-slide").hide();
            $('.user-profile-prices-section-tab').html(response.prices);
            $(".user-profile-prices-section-tab .checkbox-style").each(function (){
                $(this).find('input:checked').closest('.regions-list-item-name').addClass("show");
                $(this).find('input:checked').closest('.regions-list-city').addClass("show");
            });
            ShowPriceSaveAlert = 0;
            if(response.ServicesCount>0){
                $("#user-profile-show-prices").removeClass('d-none');
            }else{
                $("#user-profile-show-prices").addClass('d-none');
            }
            $('form[name="form-user-services-price"]').submit();
            ShowPriceSaveAlert = 1;
        },
        error: function (response) {

        }
    });
});
//Кнопка сохранения при выборе города
$(document).on('change', '.regions-list-item-city input', function (e) {
    $(this).closest('.regions-list-city').find('.save-from-sectin-slide').show();
});


//Форма сохранения регионов в кабинете пользователя
$(document).on('submit', 'form[name="form-user-regions"]', function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        cache: false,
        success: function (response) {
            $('body').append(response.alert);
            FadeAlert();
            $(".save-from-sectin-slide").hide();
        },
        error: function (response) {

        }
    });
});
//Кнопка сохранения при выборе города
$(document).on('change', '.regions-list-item-city input', function (e) {
    $(this).closest('.regions-list-city').find('.save-from-sectin-slide').show();
});


//Переопубликация объявлений
$(document).on('click', 'button[data-advert-update]', function (e) {
    let ID = $(this).attr('data-advert-update');
    let Button = $(this);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        async: false,
        dataType: 'json',
        url: "/api/update-advert/",
        data: {id: ID},
        cache: false,
        success: function (response) {
            Button.removeClass('advert-up');
            Button.text('Поднять бесплатно через 24 ч.');

        },
    });
});
//Удаление объявлений
$(document).on('click', 'button[data-user-items-delete-item]', function (e) {
    let ID = $(this).attr('data-user-items-delete-item');
    let Button = $(this);
    let Confirm = confirm("Вы точно хотите удалить?");
    if(Confirm){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        async: false,
        dataType: 'json',
        url: "/api/delete-advert/",
        data: {id: ID},
        cache: false,
        success: function (response) {
            Button.closest('.section__items-item').remove();

        },
    });
    }
});
//Закртыие объявления
$(document).on('click', 'button[data-user-items-close-item]', function (e) {
    let ID = $(this).attr('data-user-items-close-item');
    let Button = $(this);
    let Confirm = confirm("Вы точно хотите закрыть?");
    if(Confirm){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        async: false,
        dataType: 'json',
        url: "/api/close-advert/",
        data: {id: ID},
        cache: false,
        success: function (response) {
           // Button.closest('.section__items-item').remove();
            Button.text('Открыть');
            Button.removeAttr('data-user-items-close-item');
            Button.attr('data-user-items-open-item',ID);

        },
    });
    }
});
//Открытие объявления
$(document).on('click', 'button[data-user-items-open-item]', function (e) {
    let ID = $(this).attr('data-user-items-open-item');
    let Button = $(this);
    let Confirm = confirm("Вы точно хотите открыть?");
    if(Confirm){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        async: false,
        dataType: 'json',
        url: "/api/open-advert/",
        data: {id: ID},
        cache: false,
        success: function (response) {
           // Button.closest('.section__items-item').remove();
            Button.text('Закрыть');
            Button.removeAttr('data-user-items-open-item');
            Button.attr('data-user-items-close-item',ID);

        },
    });
    }
});
$(document).on('click', 'button[data-wish-item-id]', function (e) {
    let ID = $(this).attr('data-wish-item-id');
    let Wishpage = parseInt($(this).attr('data-wishpage'));
    let Button = $(this);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        async: false,
        dataType: 'json',
        url: "/api/update-wish/",
        data: {id: ID},
        cache: false,
        success: function (response) {
            Button.toggleClass('active');
            if (Wishpage == 1) {
                Button.closest('.section__items-item').remove();
            }

        },
    });

});
$(document).on('submit', 'form[name="form-reset-save"]', function (e) {
    e.preventDefault();
    let Errors = 0;
    let thisForm = $('form[name="form-reset-save"]');
    thisForm.find('button').addClass('loaded');
    thisForm.find('input').removeClass('error-validation');
    thisForm.find('.form-validation-errors').removeClass('alert alert-danger');
    thisForm.find('.form-validation-errors').html('');
    $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        cache: false,
        success: function (response) {
            thisForm.find('button').removeClass('loaded')
            if (response.success) {
                window.location = '/';
            }
        },
        error: function (response) {
            thisForm.find('button').removeClass('loaded');

            thisForm.find('.form-validation-errors').addClass('alert alert-danger');
            thisForm.find('.form-validation-errors').html('');
            Object.keys(response.responseJSON.errors).forEach(function (key) {
                thisForm.find('input[name="' + key + '"]').addClass('error-validation');
                thisForm.find('input[name="' + key + '_confirmation"]').addClass('error-validation');
                thisForm.find('.form-validation-errors').append("<div class=''>" + response.responseJSON.errors[key] + "</div>");
            });
        }
    });
});


//Загрузка изображений
let MaxFilesCountAdvert = 20;
let CurrentCountAdvert = 0;
$(document).on('change', '.file-upload-preview', function (event) {
    let InputUpload = $(this);
    InputUpload.closest('.uploader').find('.images-preview-inner').html('');
    InputUpload.closest('.uploader').find('.progress-state').toggleClass('d-none');
    InputUpload.closest('.uploader').find('.default-state').toggleClass('d-none');
    let InnerImagePreview =InputUpload.closest('.form-ui-style-default').find('.images-preview-inner');

    let UploadFiles = event.target.files.length;
    CurrentCountAdvert = 0;
    for (var i = 0; i < event.target.files.length; i++) {
        CurrentCountAdvert++;
        if (CurrentCountAdvert <= MaxFilesCountAdvert) {

            let fd = new FormData();
            let files = event.target.files[i];

            fd.append('file', files);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/profile/portfolio/upload/',
                type: 'POST',
                dataType: 'json',
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success == 1) {
                        if(UploadFiles==CurrentCountAdvert){
                            InputUpload.closest('.uploader').find('.progress-state').addClass('d-none');
                            InputUpload.closest('.uploader').find('.default-state').removeClass('d-none');
                        }
                        InnerImagePreview.append("<div class='inner-image-upload' data-image-id='"+response.image_id+"'><i></i><img src='/storage/" + response.image_url + "'/></div>");
                        $('body').append(response.alert);
                        FadeAlert();
                    } else {
                        if(UploadFiles==CurrentCountAdvert){
                            InputUpload.closest('.uploader').find('.progress-state').addClass('d-none');
                            InputUpload.closest('.uploader').find('.default-state').removeClass('d-none');
                        }
                        $('body').append(response.alert);
                        FadeAlert();
                    }
                },
            });


        }
    }
});

//Удаление изображения из списка
$(document).on('click', '.inner-image-upload i', function (event) {
    event.preventDefault();
    let ImageID = $(this).closest('div').attr('data-image-id');
    $(this).closest('.inner-image-upload').remove();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "DELETE",
        async: false,
        dataType: 'json',
        url: "/api/portfolio/",
        data: {image_id: ImageID},
        cache: false,
        success: function (response) {
        },
    });

    return false;
});

//Добавление строки в прайс-лист
$(document).on('click', '.advert-price-form button', function (e) {

    let CloneRow = $(".advert-price-form-row.d-none").clone();
    CloneRow.removeClass('d-none');
    $('.advert-price-form-rows').append(CloneRow);
    console.log(CloneRow);

});
//Добавление объявления
$(document).on('submit', 'form[name="form-advert-add"]', function (e) {
    e.preventDefault();
    let Errors = 0;
    let thisForm = $('form[name="form-advert-add"]');
    thisForm.find('button[type="submit"]').addClass('loaded');
    thisForm.find('input').removeClass('error-validation');
    thisForm.find('.form-validation-errors').html('');
    thisForm.find('.form-validation-errors').removeClass('alert alert-danger');


    let fd = new FormData(thisForm[0]);
    let files = thisForm.find('input[name="advert[images][]"]').val();
    fd.append('file', files);

    $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: $(this).attr('action'),
        data: fd,
        processData: false,
        contentType: false,
        cache: false,
        success: function (response) {
            thisForm.find('button').removeClass('loaded');
            thisForm.find('.form-validation-errors').html('');
            window.location = '/cabinet/items';
        },
        error: function (response) {
            thisForm.find('button').removeClass('loaded');
            thisForm.find('.form-validation-errors').addClass('alert alert-danger');

            Object.keys(response.responseJSON.errors).forEach(function (key) {
                thisForm.find('input[name="advert[' + key + ']"]').addClass('error-validation');
                thisForm.find('select[name="advert[' + key + ']"]').addClass('error-validation');
                thisForm.find('textarea[name="advert[' + key + ']"]').addClass('error-validation');
                thisForm.find('.form-validation-errors').append("<div class=''>" + response.responseJSON.errors[key] + "</div>");
            });
        }
    });
});
//Редактирование объявления
$(document).on('submit', 'form[name="form-advert-edit"]', function (e) {
    e.preventDefault();
    let Errors = 0;
    let thisForm = $('form[name="form-advert-edit"]');
    thisForm.find('button[type="submit"]').addClass('loaded');
    thisForm.find('input').removeClass('error-validation');
    thisForm.find('.form-validation-errors').html('');
    thisForm.find('.form-validation-errors').removeClass('alert alert-danger');


    let fd = new FormData(thisForm[0]);
    let files = thisForm.find('input[name="advert[images][]"]').val();
    fd.append('file', files);

    $.ajax({
        type: "POST",
        async: false,
        dataType: 'json',
        url: $(this).attr('action'),
        data: fd,
        processData: false,
        contentType: false,
        cache: false,
        success: function (response) {
            thisForm.find('button').removeClass('loaded');
            thisForm.find('.form-validation-errors').html('');
            window.location = '/cabinet/items';
        },
        error: function (response) {
            thisForm.find('button').removeClass('loaded');
            thisForm.find('.form-validation-errors').addClass('alert alert-danger');

            Object.keys(response.responseJSON.errors).forEach(function (key) {
                thisForm.find('input[name="advert[' + key + ']"]').addClass('error-validation');
                thisForm.find('select[name="advert[' + key + ']"]').addClass('error-validation');
                thisForm.find('textarea[name="advert[' + key + ']"]').addClass('error-validation');
                thisForm.find('.form-validation-errors').append("<div class=''>" + response.responseJSON.errors[key] + "</div>");
            });
        }
    });
});

function FadeAlert(){
    setTimeout(function () {
        $(".alert-top-right").remove();
    }, 3000);
}
$(document).ready(function () {
    $(".phone-mask").mask("+7 (999) 999-99-99");
    /* $(".header__user_text").click(function(){
         if($(window).width()<=1100){
             $(".user-cabinet-menu-inner").toggle();
             return false;
         }
     });*/

    if ($(".alert-top-right").length) {
        FadeAlert();
    }

    //Подгрузка городов в форме редактирования объявления
    $("#adv-form-location").change(function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            async: false,
            dataType: 'json',
            url: "/api/get-citys-by-region/",
            data: {regionID: $(this).val()},
            cache: false,
            success: function (response) {
                $("select[name='advert[city]']").html('<option>Выбрать город</option>');
                $("select[name='advert[city]']").removeAttr('disabled');
                $.each(response.success, function (index, value) {
                    $("select[name='advert[city]']").append("<option value='" + value.id + "'>" + value.name + "</option>");
                });

            },
        });
    });

    //Подгрузка категорий в форме редактирования объявления
    $("#adv-form-category").change(function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            async: false,
            dataType: 'json',
            url: "/api/get-categories-by-parent/",
            data: {parentID: $(this).val()},
            cache: false,
            success: function (response) {

                if (response.success.length > 0) {
                    $("select[name='advert[subcategory]']").show();
                    $("select[name='advert[subcategory]']").html('<option value="0">Выбрать подкатегорию</option>');
                    $("select[name='advert[subcategory]']").removeAttr('disabled');
                    $.each(response.success, function (index, value) {
                        $("select[name='advert[subcategory]']").append("<option value='" + value.id + "'>" + value.name + "</option>");
                    });
                } else {
                    $("select[name='advert[subcategory]']").hide();
                }

            },
        });
    });


    //Подгрузка объявлений
    $("#load-more-items").click(function () {
        let CurrentPageLimit = parseInt($(this).attr('data-page-load'));
        let ButtonThis = $(this);
        ButtonThis.addClass('loaded');

        $(this).attr('data-page-load', CurrentPageLimit + 1);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            async: false,
            dataType: 'HTML',
            url: "",
            data: {page: CurrentPageLimit},
            cache: false,
            success: function (response) {
                ButtonThis.removeClass('loaded');

                if (response == '') {
                    $("#load-more-items").remove();
                } else {
                    $(".section__items.section__items-category-page").append(response);
                }

                if(parseInt($("#load-more-items").attr('data-page-load'))==parseInt( $("#load-more-items").attr('data-page-count-load'))){
                    $("#load-more-items").remove();
                }
            },
        });
    });

    $("#show-item-number, a[date-get-phone]").click(function () {
       // let CurrentItem = parseInt($(this).attr('data-item-id'));
        let CurrentItem = parseInt($(this).attr('date-get-phone'));
        let Obj = $(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            async: false,
            dataType: 'json',
            url: "/api/getphone/",
            data: {item: CurrentItem},
            cache: false,
            success: function (response) {
                if (response) {
                    Obj.html("+"+response.success + '');
                }
            },
        });
        return false;
    });

    //
    $(".current-item-page-description-show").click(function () {
        $(".current-item-page-description").toggleClass('show-all');
        if ($(this).text() == 'Развернуть') {
            $(this).text('Свернуть');
        } else {
            $(this).text('Развернуть');
        }
        return false;
    });
    $(".current-item-page .price-row.last a").click(function () {
        $('.price-row.last').remove();
        $(".price-row").removeClass('d-none');


    });

});
$(function () {
    $(document).on('click',".regions-list-item-name",function (){
        let thisTitle = $(this);
        thisTitle.next('.regions-list-city').toggleClass('show');
        thisTitle.toggleClass('show');
    });

    const swiper = new Swiper('.item-gallery', {
        loop: false,
        slidesPerView: 6,
    });

    const swiperProfile = new Swiper('.swiper-profile-gallery', {
        loop: false,
        slidesPerView: 6,
        modules: [Navigation],
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });



    $('.lazy').Lazy();
    $("#go-contacts-from").click(function(){
          $("html, body").animate({ scrollTop: $('.advert-current-contacts-form').offset().top+"px" }, "slow");
    });
});
