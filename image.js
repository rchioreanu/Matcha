$(document).ready(function () {
    'use strict';

    function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(id).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#input_profile").change(function () {
        readURL(this, "#image_profile");
    });
    $("#input_1").change(function () {
        readURL(this, "#image_1");
    });
    $("#input_2").change(function () {
        readURL(this, "#image_2");
    });
    $("#input_3").change(function () {
        readURL(this, "#image_3");
    });
    $("#input_4").change(function () {
        readURL(this, "#image_4");
    });
});
