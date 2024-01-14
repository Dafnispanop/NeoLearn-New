




//FOR THE showlessons.php file
$(document).on('submit', '#saveLesson', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("sub_lesson", true);

    $.ajax({
        type: "POST",
        url: "code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                $('#errorMessage').removeClass('d-none');
                $('#errorMessage').text(res.message);

            }else if(res.status == 200){

                $('#errorMessage').addClass('d-none');
                $('#lessonAddModal').modal('hide');
                $('#saveLesson')[0].reset();

                alertify.set('notifier','position', 'top-right');
                alertify.success(res.message);

                $('#myTable').load(location.href + " #myTable");

            }else if(res.status == 500) {
                alert(res.message);
            }
        }
    });

});




$(document).on('click', '.viewLessonBtn', function () {

    var lesson_id = $(this).val();
    //window.alert(lesson_id);
    $.ajax({
        type: "POST",
        url: "code.php",
        data: {lesson_id: lesson_id},
        success: function (response) {

            window.location = "lesson.php?lessonid="+ lesson_id;
        }
    });
});

$(document).on('click', '.deleteLessonBtn', function (e) {
    e.preventDefault();

    if(confirm('Are you sure you want to unsub from this lesson?'))
    {
        var lesson_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                'delete_lesson': true,
                'lesson_id': lesson_id
            },
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 500) {

                    alert(res.message);
                }else{
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    }
});

//for the lesson.php file
// I need anothe one for the viewPDF 

$(document).on('click', '.viewVideoBtn', function () {

    //gets the url and searches the passed value of the varialbe lessonid
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const lesson_id = urlParams.get('lessonid');
    //window.alert(lesson_id);
    //get the number of the selected week and then pass both variables using the url
    var week_number = $(this).val();
    //window.alert(week_number);
    $.ajax({
        type: "POST",
        url: "code.php",
        data: {week_number: week_number},
        success: function (response) {

            window.location = "showvids.php?lessonid="+ lesson_id +"&weekno="+ week_number;
            
        }
    });
});

$(document).on('click', '.viewPdfBtn', function () {

    //gets the url and searches the passed value of the varialbe lessonid
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const lesson_id = urlParams.get('lessonid');
    //window.alert(lesson_id);
    //get the number of the selected week and then pass both variables using the url
    var week_number = $(this).val();
    //window.alert(week_number);
    $.ajax({
        type: "POST",
        url: "code.php",
        data: {week_number: week_number},
        success: function (response) {

            window.location = "showpdf.php?lessonid="+ lesson_id +"&weekno="+ week_number;
            
        }
    });
});



//teacher.php


$(document).on('submit', '#saveStudent', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("save_student", true);

    $.ajax({
        type: "POST",
        url: "code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                $('#errorMessage').removeClass('d-none');
                $('#errorMessage').text(res.message);

            }else if(res.status == 200){

                $('#errorMessage').addClass('d-none');
                $('#studentAddModal').modal('hide');
                $('#saveStudent')[0].reset();

                alertify.set('notifier','position', 'top-right');
                alertify.success(res.message);

                $('#myTable').load(location.href + " #myTable");

            }else if(res.status == 500) {
                alert(res.message);
            }
        }
    });

});

$(document).on('click', '.editStudentBtn', function () {

    var student_id = $(this).val();
    
    $.ajax({
        type: "GET",
        url: "code.php?student_id=" + student_id,
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if(res.status == 404) {

                alert(res.message);
            }else if(res.status == 200){

                $('#student_id').val(res.data.id);
                $('#name').val(res.data.name);
                $('#email').val(res.data.email);
                $('#phone').val(res.data.phone);
                $('#course').val(res.data.course);

                $('#studentEditModal').modal('show');
            }

        }
    });

});

$(document).on('submit', '#updateStudent', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_student", true);

    $.ajax({
        type: "POST",
        url: "code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                $('#errorMessageUpdate').removeClass('d-none');
                $('#errorMessageUpdate').text(res.message);

            }else if(res.status == 200){

                $('#errorMessageUpdate').addClass('d-none');

                alertify.set('notifier','position', 'top-right');
                alertify.success(res.message);
                
                $('#studentEditModal').modal('hide');
                $('#updateStudent')[0].reset();

                $('#myTable').load(location.href + " #myTable");

            }else if(res.status == 500) {
                alert(res.message);
            }
        }
    });

});

$(document).on('click', '.viewStudentBtn', function () {

    var student_id = $(this).val();
    $.ajax({
        type: "GET",
        url: "code.php?student_id=" + student_id,
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if(res.status == 404) {

                alert(res.message);
            }else if(res.status == 200){

                $('#view_name').text(res.data.name);
                $('#view_email').text(res.data.email);
                $('#view_phone').text(res.data.phone);
                $('#view_course').text(res.data.course);

                $('#studentViewModal').modal('show');
            }
        }
    });
});

$(document).on('click', '.deleteStudentBtn', function (e) {
    e.preventDefault();

    if(confirm('Are you sure you want to delete this data?'))
    {
        var student_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                'delete_student': true,
                'student_id': student_id
            },
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 500) {

                    alert(res.message);
                }else{
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    }
});

//teacherpdf.php

$(document).on('click', '.deletePdfBtn', function (e) {
    e.preventDefault();

    if(confirm('Are you sure you want to delete this data?'))
    {
        var pdf_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                'delete_pdf': true,
                'pdf_id': pdf_id
            },
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 500) {

                    alert(res.message);
                }else{
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    }
});



//teachervideos.php


$(document).on('submit', '#saveVideo', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("save_video", true);

    $.ajax({
        type: "POST",
        url: "code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                $('#errorMessage').removeClass('d-none');
                $('#errorMessage').text(res.message);

            }else if(res.status == 200){

                $('#errorMessage').addClass('d-none');
                $('#studentAddModal').modal('hide');
                $('#saveVideo')[0].reset();

                alertify.set('notifier','position', 'top-right');
                alertify.success(res.message);

                $('#myTable').load(location.href + " #myTable");

            }else if(res.status == 500) {
                alert(res.message);
            }
        }
    });

});


$(document).on('click', '.deleteVideoBtn', function (e) {
    e.preventDefault();

    if(confirm('Are you sure you want to delete this data?'))
    {
        var video_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                'delete_video': true,
                'video_id': video_id
            },
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 500) {

                    alert(res.message);
                }else{
                    alertify.set('notifier','position', 'top-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    }
});
