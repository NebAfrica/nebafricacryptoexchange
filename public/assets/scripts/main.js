//hide preloader
$(document).ready(function () {
    $('#preloader').fadeOut(100);
});

//check all input 
$("#all").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
});



$(".checkSingle").click(function () {
    if ($(this).is(":checked")) {
        var isAllChecked = 0;

        $(".checkSingle").each(function () {
            if (!this.checked)
                isAllChecked = 1;
        });

        if (isAllChecked == 0) {
            $("#all").prop("checked", true);
        }
    }
    else {
        $("#all").prop("checked", false);
    }
});


// Submit delete form start here
$(document).ready(function () {
    $("#datatable-skeleton-table").on("click", ".delete_btn", function () {
        var id = $(this).data("value");
        var title = $(this).data('title');
        jQuery("#id").val(id); //
        Swal.fire({
            title: 'Delete ' + title + '!',
            text: "Do you really want to delete this " + title + "? This action can't be reversed",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1b2e4b',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete',
            background: "#0e1726",
            color: "#d1d5db",
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            },
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("deleteForm").submit();
            }
        });
    });


    $(".datatable-skeleton-table").on("click", ".delete_btn", function () {
        var id = $(this).data("value");
        var title = $(this).data('title');
        jQuery("#id").val(id); //
        Swal.fire({
            title: 'Delete ' + title + '!',
            text: "Do you really want to delete this " + title + "? This action can't be reversed",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1b2e4b',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete',
            background: "#0e1726",
            color: "#d1d5db",
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            },
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("deleteForm").submit();
            }
        });
    });

});

//delete form submission ends here

// Notice starts here
$('.close_btn').click(function () {
    $('.notice').hide();
});
// notice ends here

// image preview 
$("input[type='file']").change(function (e) {
    var target = $(this).data('preview');
    if (typeof target !== 'undefined') {
        var target_id = '#' + target;
        var bg_url = 'url(' + URL.createObjectURL(e.target.files[0]) + ')';
        $(target_id).css({
            'background-image': bg_url,
        });
    }

});

//show preloader on link click
$('a').on('click', function (e) {
    var url = $(this).attr('href');
    var role = $(this).attr('role');
    if (url == 'undefined' || url == '#' || role == 'button') {
        //do nothing
    } else {
        $('#preloader').show();
    }
})



//toggle text input for enable/disable
$('.hidden-radio').on('click', function () {
    var target_id = '#' + $(this).attr('for');
    var current_value = $(target_id).val();
    var new_value = '';
    if (current_value === 'enabled') {
        new_value = 'disabled';
    } else {
        new_value = 'enabled';
    }


    $(target_id).val(new_value);
    $(this).toggleClass('toggle--on').toggleClass('toggle--off').addClass('toggle--moving');

    setTimeout(function () {
        $('.hidden-radio').removeClass('toggle--moving');
    }, 200);
});

//toggle popup
$('.popup-trigger-button').on('click', function () {
    var toggle = '#' + $(this).data('toggle');
    $(toggle).toggleClass('hidden');

});



//////// ===> Add click event for toggling sidebar <=== ///////////////////
$(".sidebar-toggle-btn").click(function () {

    if ($(window).width() > 739) {
        var status = $('.sidenav-content').eq(0).data('status');
        if (status == 'full') {
            var new_status = 'minized';
        } else {
            var new_status = 'full';
        }
        $(".sidenav-content").delay('slow').toggleClass('w-64').toggleClass('w-20').data('status', new_status);
        $("#general-content-section").delay('slow').toggleClass("md:ml-64").toggleClass("2xl:ml-1/5").toggleClass("md:ml-10").toggleClass("px-5").toggleClass("w-full").toggleClass("md:w-10/12").toggleClass("md:w-12/12");
        $("#general-content").delay('slow').toggleClass("md:w-4/5");
        $(".nav-text").toggleClass("hidden");
    } else {
        $(".sidebar-toggle-btn").click(function () {
            $(".sidenav-content").toggleClass("-translate-x-full");
        })
    }

});

$(".sidenav-content").hover(function () {
    var status = $(this).data('status');
    if (status == 'minized' && $(window).width() > 739) {
        $(".sidenav-content").toggleClass('w-64').toggleClass('w-20');
        $("#general-content-section").toggleClass("md:ml-64").toggleClass("2xl:ml-1/5").toggleClass("md:ml-10");
        $("#general-content").toggleClass("md:w-4/5");
        $(".nav-text").toggleClass("hidden");
    }

});
///////////////////////////////////////////////////////////////////////////


// ===> Add click event for toggling dropdown menus (without caret) <=== //
$(".dropdown").click(function () {
    $(this).siblings(".dropdown-menu").toggleClass("hidden");
});
///////////////////////////////////////////////////////////////////////////


//// ===> Add click event for toggling dropdown menus (with caret) <=== ///
$(".dropdown-with-caret").click(function () {
    // Get the menu id
    let menuId = $(this).data("menu-id")
    // Toggle the menu caret 
    $(`svg.the-caret[data-menu-id='${menuId}']`).toggleClass("rotate-90")
    // Toggle the menu
    $(`.the-menu[data-menu-id='${menuId}']`).toggleClass("hidden")
});
///////////////////////////////////////////////////////////////////////////


//// ===> Google translate function                   <=== ////////////////
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en'
    }, 'google_translate_element');
}
///////////////////////////////////////////////////////////////////////////

// disable resent otp button on page load
$(document).ready(function () {
    var clicked = $('.resend-otp');
    var timeleft = 60;
    var timer = setInterval(function () {
        if (timeleft <= 0) {
            clearInterval(timer);
            clicked.html('Resend Otp');
            clicked.css({
                'pointer-events': 'auto',
            });

        } else {
            clicked.html('<span class="text-red-500">Resend Otp in: ' +
                timeleft + '</span>');
            clicked.css({
                'pointer-events': 'none',
            });
        }
        timeleft -= 1;
    }, 1000);


});
