/**
 * Main
 */

'use strict';

let menu, animate;
(function () {

    // Initialize menu
    //-----------------

    let layoutMenuEl = document.querySelectorAll('#layout-menu');
    layoutMenuEl.forEach(function (element) {
        menu = new Menu(element, {
            orientation: 'vertical',
            closeChildren: false
        });
        // Change parameter to true if you want scroll animation
        window.Helpers.scrollToActive((animate = false));
        window.Helpers.mainMenu = menu;
    });

    // Initialize menu togglers and bind click on each
    let menuToggler = document.querySelectorAll('.layout-menu-toggle');
    menuToggler.forEach(item => {
        item.addEventListener('click', event => {
            event.preventDefault();
            window.Helpers.toggleCollapsed();
        });
    });

    // Display menu toggle (layout-menu-toggle) on hover with delay
    let delay = function (elem, callback) {
        let timeout = null;
        elem.onmouseenter = function () {
            // Set timeout to be a timer which will invoke callback after 300ms (not for small screen)
            if (!Helpers.isSmallScreen()) {
                timeout = setTimeout(callback, 300);
            } else {
                timeout = setTimeout(callback, 0);
            }
        };

        elem.onmouseleave = function () {
            // Clear any timers set to timeout
            document.querySelector('.layout-menu-toggle').classList.remove('d-block');
            clearTimeout(timeout);
        };
    };
    if (document.getElementById('layout-menu')) {
        delay(document.getElementById('layout-menu'), function () {
            // not for small screen
            if (!Helpers.isSmallScreen()) {
                document.querySelector('.layout-menu-toggle').classList.add('d-block');
            }
        });
    }

    // Display in main menu when menu scrolls
    let menuInnerContainer = document.getElementsByClassName('menu-inner'),
        menuInnerShadow = document.getElementsByClassName('menu-inner-shadow')[0];
    if (menuInnerContainer.length > 0 && menuInnerShadow) {
        menuInnerContainer[0].addEventListener('ps-scroll-y', function () {
            if (this.querySelector('.ps__thumb-y').offsetTop) {
                menuInnerShadow.style.display = 'block';
            } else {
                menuInnerShadow.style.display = 'none';
            }
        });
    }

    // Init helpers & misc
    // --------------------

    // Init BS Tooltip
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Accordion active class
    const accordionActiveFunction = function (e) {
        if (e.type == 'show.bs.collapse' || e.type == 'show.bs.collapse') {
            e.target.closest('.accordion-item').classList.add('active');
        } else {
            e.target.closest('.accordion-item').classList.remove('active');
        }
    };

    const accordionTriggerList = [].slice.call(document.querySelectorAll('.accordion'));
    const accordionList = accordionTriggerList.map(function (accordionTriggerEl) {
        accordionTriggerEl.addEventListener('show.bs.collapse', accordionActiveFunction);
        accordionTriggerEl.addEventListener('hide.bs.collapse', accordionActiveFunction);
    });

    // Auto update layout based on screen size
    //window.Helpers.setAutoUpdate(true);

    // Toggle Password Visibility
    //window.Helpers.initPasswordToggle();

    // Speech To Text
   // window.Helpers.initSpeechToText();

    // Manage menu expanded/collapsed with templateCustomizer & local storage
    //------------------------------------------------------------------

    // If current layout is horizontal OR current window screen is small (overlay menu) than return from here
    // if (window.Helpers.isSmallScreen()) {
    //     return;
    // }

    // If current layout is vertical and current window screen is > small

    // Auto update menu collapsed/expanded based on the themeConfig
//    window.Helpers.setCollapsed(true, false);

})();


$(document).ready(function () {

    $('[data-export]').click(function (event) {
        event.preventDefault();
        let form = $(this);

        let load = $(".ajax_load");
        let data = form.data();


        $.ajax({
            url: data.url,
            type: "POST",
            data: data,
            dataType: "json",
            beforeSend: function () {
                $(".ajax_load")
                    .fadeIn(200)
                    .css("display", "flex")
                    .find(".ajax_load_box_title")
                    .text("Aguarde, enviando dados para o servido de processamento...");
            },
            success: function (response) {

                Swal.fire({
                    position: "top-end",
                    icon: response.type,
                    text: response.message,
                    timer: 1500,
                    customClass: {confirmButton: "btn btn-primary"}
                });

                window.location.href = response.download;
                //reload
                if (response.reload) {
                    window.location.href = response.download;
                    setTimeout(function () {
                        window.location.reload();
                    }, 1500)
                }

                load.fadeOut(200);
            },
            complete: function () {
                if (form.data("reset") === true) {
                    form.trigger("reset");
                }
            },
            error: function () {

                Swal.fire({
                    position: "top-end",
                    icon: 'error',
                    title: 'Desculpe mas não foi possível processar a requisição. Favor tente novamente!',
                    timer: 1500,
                    customClass: {confirmButton: "btn btn-primary"}
                });
                load.fadeOut(200);
            }
        });
    });

    $('[data-url-open]').click( function (e) {
        const data = $(this).data();
        console.log(data)
         location.href =data.urlOpen
    });

    $('[data-action]').click(function (event) {
        event.preventDefault();
        let form = $(this);

        let load = $(".ajax_load");
        let data = form.data();

        $.ajax({
            url: data.url,
            type: "POST",
            data: data,
            dataType: "json",
            beforeSend: function () {
                $(".ajax_load")
                    .fadeIn(200)
                    .css("display", "flex")
                    .find(".ajax_load_box_title")
                    .text("Aguarde, enviando dados para o servido de processamento...");
            },
            success: function (response) {

                Swal.fire({
                    position: "top-end",
                    icon: response.type,
                    text: response.message,
                    timer: 1500,
                    customClass: {confirmButton: "btn btn-primary"}
                });

                //reload
                if (response.reload) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 1500)
                }

                load.fadeOut(200);
            },
            complete: function () {
                if (form.data("reset") === true) {
                    form.trigger("reset");
                }
            },
            error: function () {

                Swal.fire({
                    position: "top-end",
                    icon: 'error',
                    title: 'Desculpe mas não foi possível processar a requisição. Favor tente novamente!',
                    timer: 1500,
                    customClass: {confirmButton: "btn btn-primary"}
                });
                load.fadeOut(200);
            }
        });
    });

    /*$("form:not('.ajax_off')").submit(function (e) {

        e.preventDefault();
        var form = $(this);
        var load = $(".ajax_load");

        var data = form.data();

        form.ajaxSubmit({
            url: form.attr("action"),
            type: "POST",
            dataType: "json",
            beforeSend: function () {
                $(".ajax_load")
                    .fadeIn(200)
                    .css("display", "flex")
                    .find(".ajax_load_box_title")
                    .text("Aguarde, enviando dados para o servido de processamento...");
            },
            success: function (response) {

                Swal.fire({
                    position: "top-end",
                    icon: response.type,
                    text: response.message,
                    timer: 1500,
                    customClass: {confirmButton: "btn btn-primary"}
                });

                //reload
                if (response.reload) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 1500)
                }

                $(".ajax_load").fadeOut(200);
            },
            complete: function () {
                if (form.data("reset") === true) {
                    form.trigger("reset");
                }
            },
            error: function () {

                Swal.fire({
                    position: "top-end",
                    icon: 'error',
                    title: 'Desculpe mas não foi possível processar a requisição. Favor tente novamente!',
                    timer: 1500,
                    customClass: {confirmButton: "btn btn-primary"}
                });
                load.fadeOut(200);
            }
        });
    });
*/
    const x = document.querySelector("#ajax-action");
    $("[data-type-action]").click(function (e) {
        e.preventDefault();

        const data = $(this).data();
        const typeAction = (data.typeAction == 'ativo' ? '<b>ativa</b>' : '<b>bloquear</b>');
        const url = data.urlAction;

        Swal.fire({
            title: "Tem certeza?",
            html: "Você deseja realmente " + typeAction + ' este lote!',
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Sim, " + typeAction + "!",
            customClass: {
                confirmButton: "btn btn-primary me-3",
                cancelButton: "btn btn-label-secondary"
            },
            buttonsStyling: !1,
        }).then(function (t) {
            console.log(t);
            $.ajax({
                url: url,
                type: "POST",
                data: data,
                dataType: "json",
                beforeSend: function () {
                    $(".ajax_load")
                        .fadeIn(200)
                        .css("display", "flex")
                        .find(".ajax_load_box_title")
                        .text('Aguarde, processando dados...');
                },
                success: function (response) {

                    Swal.fire({
                        position: "top-end",
                        icon: response.type,
                        text: response.message,
                        timer: 1500,
                        customClass: {confirmButton: "btn btn-primary"}
                    });

                    //reload
                    if (response.reload) {
                        setTimeout(function () {
                            window.location.reload();
                        }, 1500)
                    }

                    load.fadeOut(200);
                },
                error: function () {
                    toast('error', 'Ops, algo de errado aconteceu ao execulta dados.');
                    load.fadeOut();
                }
            });
            return false;

            // t.value ?
            //     Swal.fire({ icon: "success", title: "Deleted!", text: "Your file has been deleted.", customClass: { confirmButton: "btn btn-success" } }) :
            //     t.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Cancelled", text: "Your imaginary file is safe :)", icon: "error", customClass: { confirmButton: "btn btn-success" } });
        });
    });
});


/*
 * triggerNotify: cria norifição superior direita.
 * @param data color|icon|title|message|type|[,close url]
 * @returns html notify
 */
function triggerModal(data) {

    var triggerMessage = "<div class='trigger_modal_box'>";
        triggerMessage += "<div class='trigger_modal trigger_" + data.color + "'>";
        triggerMessage += "<span class='icon-cross trigger_modal_close bx bx-x icon-notext'></span>";
        triggerMessage += "<div class='trigger_modal_icon bx " + data.icon + " 2 icon-notext'></div>";
        triggerMessage += "<div class='trigger_modal_content'>";
        triggerMessage += "<div class='trigger_modal_content_title fs-18'>" + data.title + "</div>";
        triggerMessage += "<div class='trigger_modal_content_message fs-18'>" + data.message + "</div>";
    if (data.button) {
        triggerMessage += "<a class='btn btn-dark mt-3' href='" + data.next_page + "'>OK</a>"
    }
    ;
    triggerMessage += "</div></div></div>";

    if (!$(".trigger_modal_box").length) {
        $("body").prepend("<div class='trigger_notify_box'>" + triggerMessage + "</div>");
    } else {
        $(".trigger_modal").fadeOut(200, function () {
            $(this).remove();
            $(".trigger_modal_box").html(triggerMessage);
        });
    }

    $(".trigger_modal_box").fadeIn(200, function () {
        var modal_box = $(this);
        modal_box.find(".trigger_modal").animate({"top": "0", "opacity": "1"}, 200);

        modal_box.on("click", ".trigger_modal_close", function () {
            modal_box.find(".trigger_modal").animate({"top": "100", "opacity": "0"}, 200, function () {
                modal_box.fadeOut(200, function () {
                    $(this).remove();
                    if (data.location) {
                        if (data.location === true) {
                            window.location.reload();
                        } else {
                            window.location.href = data.location;
                            if (window.location.href === data.location) {
                                window.location.reload();
                            }
                        }
                    }
                });
            });
        });
    }).css("display", "flex");
}