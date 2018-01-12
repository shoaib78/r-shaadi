<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@section('title') Administration @show</title>
    @section('meta_keywords')
        <meta name="keywords" content="your, awesome, keywords, here"/>
    @show @section('meta_author')
        <meta name="author" content="Jon Doe"/>
    @show @section('meta_description')
        <meta name="description"
              content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei."/>
    @show

    <!-- Bootstrap 3.3.6 -->
    <link href="{{ asset('public/assets/admin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('public/assets/admin/plugins/datatables/dataTables.bootstrap.css') }}">
    <link href="{{ asset('public/assets/admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('public/assets/admin/dist/css/skins/_all-skins.min.css') }}">
    <!-- iCheck -->
    <link href="{{ asset('public/assets/admin/plugins/iCheck/flat/blue.css') }}" rel="stylesheet">
    <!-- Morris chart -->
    <link href="{{ asset('public/assets/admin/plugins/morris/morris.css') }}" rel="stylesheet">
    <!-- jvectormap -->
    <link href="{{ asset('public/assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <!-- Date Picker -->
    <link href="{{ asset('public/assets/admin/plugins/datepicker/datepicker3.css') }}" rel="stylesheet">
    <!-- Daterange picker -->
    <link href="{{ asset('public/assets/admin/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="{{ asset('public/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .has-error{
            color:#dd4b39;
        }
        .form-group.required .control-label:after {
            content:"*";
            color:#d40000;
        }
    </style>
    @yield('styles')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        window = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'url' =>  url(''),
        ]); ?>
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <!-- header -->
        @include('admin.includes.header')
    <!-- /header -->

    <!-- Left side column. contains the logo and sidebar -->
        @include('admin.includes.sidebar')
    <!-- /Left side column. contains the logo and sidebar -->

    <!-- content-wrapper -->
        @yield('content')
    <!-- /.content-wrapper -->

    <!-- footer -->
        @include('admin.includes.footer')
    <!-- /footer -->
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('public/assets/admin/plugins/jQuery/jquery-2.2.3.min.js') }}" ></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('public/assets/admin/bootstrap/js/bootstrap.min.js') }}" ></script>
<script src="{{ asset('public/assets/js/jquery.validate.min.js') }}"></script>
<!-- Bootbox -->
<script src="{{ asset('public/assets/js/bootbox.min.js') }}"></script>
@if(Request::is('admin/manage_vendors') || Request::is('admin/manage_users') || Request::is('admin/category') || Request::is('admin/slider') || Request::is('admin/review') || Request::is('admin/subscribers') || Request::is('admin/pages') || Request::segment(2) == 'review' || Request::is('admin/featured_vendors') || Request::is('admin/user_comments') || Request::is('admin/local_vendors'))
    <!-- DataTables -->
    <script src="{{ asset('public/assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
@elseif (Request::is('admin/dashboard'))
    <!-- jvectormap -->
    <script src="{{ asset('public/assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" ></script>
    <script src="{{ asset('public/assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" ></script>
    <!-- FLOT CHARTS -->
    <script src="{{ asset('public/assets/admin/plugins/flot/jquery.flot.min.js') }}"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="{{ asset('public/assets/admin/plugins/flot/jquery.flot.resize.min.js') }}"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
    <script src="{{ asset('public/assets/admin/plugins/flot/jquery.flot.pie.min.js') }}"></script>
    <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
    <script src="{{ asset('public/assets/admin/plugins/flot/jquery.flot.categories.min.js') }}"></script>
@endif
<!-- Slimscroll -->
<script src="{{ asset('public/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js') }}" ></script>
<!-- FastClick -->
<script src="{{ asset('public/assets/admin/plugins/fastclick/fastclick.js') }}" ></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/assets/admin/dist/js/app.min.js') }}" ></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/assets/admin/dist/js/demo.js') }}" ></script>

@if(Request::is('admin/dashboard'))
<script>
    $(function () {

  "use strict";
  //jvectormap data
  var visitorsData = {
    "US": 398, //USA
    "SA": 400, //Saudi Arabia
    "CA": 1000, //Canada
    "DE": 500, //Germany
    "FR": 760, //France
    "CN": 300, //China
    "AU": 700, //Australia
    "BR": 600, //Brazil
    "IN": 800, //India
    "GB": 320, //Great Britain
    "RU": 3000 //Russia
  };
  //World map by jvectormap
  $('#world-map').vectorMap({
    map: 'world_mill_en',
    backgroundColor: "transparent",
    regionStyle: {
      initial: {
        fill: '#e4e4e4',
        "fill-opacity": 1,
        stroke: 'none',
        "stroke-width": 0,
        "stroke-opacity": 1
      }
    },
    series: {
      regions: [{
        values: visitorsData,
        scale: ["#92c1dc", "#ebf4f9"],
        normalizeFunction: 'polynomial'
      }]
    },
    onRegionLabelShow: function (e, el, code) {
      if (typeof visitorsData[code] != "undefined")
        el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
    }
  });

  /*
   * DONUT CHART
   * -----------
   */

    var donutData = [
        {label: "Users", data: {{ $users }}, color: "#3c8dbc"},
        {label: "Vendors", data: {{ $vendors }}, color: "#0073b7"},
        {label: "Reviews", data: {{ $reviews }}, color: "#00c0ef"}
    ];
    $.plot("#donut-chart", donutData, {
        series: {
            pie: {
                show: true,
                radius: 1,
                innerRadius: 0.5,
                label: {
                    show: true,
                    radius: 2 / 3,
                    formatter: labelFormatter,
                    threshold: 0.1
                }

            }
        },
        legend: {
            show: false
        }
    });
  /*
   * END DONUT CHART
   */

});

/*
 * Custom Label formatter
 * ----------------------
 */
function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
        + label
        + "<br>"
        + Math.round(series.percent) + "%</div>";
}
</script>
@elseif(Request::is('admin/category'))
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var show_pospup = function(elem)
    {
        $("#add_{{$type}}")[0].reset();
        $("#{{$type}}-modal").modal("show");
    }
    $(document).ready(function () {
        /* For login form validation */
        $("#add_category").validate({
            errorClass: 'has-error',
            validClass: 'has-success',
            errorElement: 'span',
            highlight: function (element, errorClass, validClass) {
                $(element).parents("div.form-group").addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents("div.form-group").removeClass(errorClass).addClass(validClass);
            },
            rules: {
                category_name: {
                    required: true,
                },
            },
            messages: {
                category_name: {
                    required: "Category field is required.",
                },
            },
            submitHandler: function (form) {
                var _form = $("#" + form.id);
                var category_name =  $('#category_name').val();
                $.post( form.action,{category_name:category_name}, function( data ) {

                    if(!data.error){
                        var msg = '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data.msg + '</div>';
                        _form.prepend(msg);
                        _form[0].reset();
                        oTable.ajax.reload();
                        setTimeout(function () {
                            _form.find(".alert-success").remove();
                            _form.closest(".modal").modal('hide');
                        }, 2500);
                    }else{
                        var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data.msg.category_name + '</div>';
                        _form.prepend(msg);
                        _form[0].reset();
                        setTimeout(function () {
                            _form.find(".alert-danger").remove();
                        }, 2500);
                    }
                }, "json");
            }
        });
        /* End login form validation */

        $(document).on("click",".edit_category",function(e){
            e.preventDefault();
            var elem = $(this);
            var url = elem.attr("href");

            $.ajax({
                url: url,
                type: "post",
                data: {},
                dataType: "json",
                success: function (response) {
                    if(response.error == 1){
                        $("#edit-category-modal").find("form").empty();
                        $("#edit-category-modal").find("form").append(response.output);
                        $("#edit-category-modal").modal("show");
                    }else{
                        alert("Some error are exist. please try again!!");
                    }
                },
            });
        });

        $(document).on("click",".delete_category",function(e){
                e.preventDefault();
                var elem = $(this);
                var url = elem.attr("href");
                bootbox.confirm("Do you sure want to delete this category?", function(result) {
                    if (result) {
                        $.post(url, {}, function (data) {
                            if (!data.error) {
                                $('table').DataTable().ajax.reload();
                            } else {
                                var msg = '<div class="alert alert-danger">' + data.message + '</div>';
                                bootbox.alert(msg);
                            }
                        }, "json");
                    }
                });
            });

    });
</script>
@elseif (Request::is('admin/manage_vendors') || Request::is('admin/manage_users'))
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $(document).on("click", ".status", function (e) {
                e.preventDefault();
                var elem = $(this);
                var url = elem.attr("href");
                var status = elem.attr("data-status");
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: "json",
                    data: {status:status, _token:token},
                    success: function (data) {
                        console.log(data);
                        if (!data.error) {
                            oTable.ajax.reload();
                        } else {
                            alert(data.message);
                        }
                    },
                });
            });
        });
    </script>
@elseif (Request::is('admin/slider') || Request::is('admin/slider/create') || isset($slider))
    <script src="{{ asset('public/assets/admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('public/assets/admin/plugins/dropzone/dropzone.css') }}">
    {{-- <link href="{{ asset('public/assets/css/lightbox.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('public/assets/js/lightbox-plus-jquery.min.js') }}"></script> --}}
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Dropzone.autoDiscover = false;
            if ($('#attachment-dropzone').length) {
                var myDropzone = new Dropzone("#attachment-dropzone", {
                    url: "{{url('upload')}}",
                    maxFiles: 1, //change limit as per your requirements
                    dictRemoveFile: 'Remove File',
                    acceptedFiles: '.png,.jpg,.jpeg,.gif,.bmp',
                    addRemoveLinks: true,
                    maxFilesize: 2, // MB
                    sending: function (file, xhr, formData) {
                        // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
                        formData.append("_token", $('meta[name="csrf-token"]').attr('content')); // Laravel expect the token post value to be named _token by default
                    },
                    init: function () {
                        @if (isset($slider))
                            var filename = "{{ $slider->image }}";
                            thisDropzone = this;
                            $.get("{{url('upload/getFiles')}}/"+filename, function(data) {
                                var data = jQuery.parseJSON(data);
                                    if(!data.error){
                                        value = data.output;
                                        console.log(data.output);
                                        var mockFile = { name: value.name, size: value.size, accepted: true };
                                        mockFile.serverId = value.file_id;
                                        thisDropzone.emit("addedfile", mockFile);
                                        thisDropzone.emit("thumbnail", mockFile, value.file);
                                        thisDropzone.emit("complete", mockFile);
                                        thisDropzone.files.push(mockFile);
                                        $(mockFile.previewElement).find(".dz-remove").addClass("btn btn-danger");
                                        $("#attachment").val(value.name);
                                    }
                                }
                            );
                        @endif
                        this.on("success", function (file, response) {
                            response = JSON.parse(response);
                            if (!response.error) {
                                file.serverId = response.file_id;
                                file.filename = response.file_name;
                                $(file.previewElement).find('[data-dz-name]').html(response.file_name);
                                $("#attachment").val(response.file_name);
                            } else {
                                var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p>Errors!</p>' + response.message + '</div>';
                                bootbox.alert(msg);
                            }
                        });
                        this.on("removedfile", function (file) {
                            if (!file.serverId) {
                                return;
                            } // The file hasn't been uploaded
                            $.ajax({
                                url: "{{url('upload/delete')}}",
                                type: "post",
                                data: {file_id: file.serverId},
                                success: function (response) {
                                    response = JSON.parse(response);
                                    $("#attachment").val('');
                                },
                            });
                        });
                    }
                });
            }

            /* For Reset form validation */
            $("#slider-form").validate({
                errorClass: 'has-error',
                validClass: 'has-success',
                errorElement: 'span',
                highlight: function(element, errorClass, validClass) {
                    $(element).parents("div.form-group").addClass(errorClass).removeClass(validClass);
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).parents("div.form-group").removeClass(errorClass).addClass(validClass);
                },
                rules:
                    {
                        title: {
                            required: true,
                        },
                        attachment: {
                            required: true,
                        },
                    },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "attachment") {
                        element.closest('.form-group').append(error);
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            $(document).on("click",".delete_slider",function(e){
                e.preventDefault();
                var elem = $(this);
                var url = elem.attr("href");
                bootbox.confirm("Do you sure want to delete this product?", function(result) {
                    if (result) {
                        $.post(url, {}, function (data) {
                            if (!data.error) {
                                $('table').DataTable().ajax.reload();
                            } else {
                                var msg = '<div class="alert alert-danger">' + data.msg + '</div>';
                                bootbox.alert(msg);
                            }
                        }, "json");
                    }
                });
            });

            /*$(document).on("click",".slider_img",function(event) {
                event.preventDefault();
                var element = $(this);
                var src = element.find('img').attr("src");
                $("#slider-img-model").find('img').attr("src", src);
                $("#slider-img-model").modal("show");
            });
*/
            $(document).on("click",".slider_img",function(event) {
                event.preventDefault();
                var element = $(this);
                var src = element.find('img').attr("src");
                $("#slider-img-model").find('.modal-body').empty();
                $("#slider-img-model").find('.modal-body').append('<img src="'+src+'" style="width:100%;"/>');
                $('#slider-img-model').modal({show:true});
            });

            $( "#sortable" ).sortable({
                helper: fixWidthHelper,
                axis: 'y',
                stop: function (event, ui) {
                    var orderval = $('#sortable').sortable('toArray');
                    $.ajax({
                        url: "{{ url('admin/'.$type.'/PostReorder') }}",
                        type: 'POST',
                        data: {orderval: orderval, _token: $('meta[name="csrf-token"]').attr('content')},
                        success: function (data) {
                            oTable.ajax.reload();
                        }
                    });
                }
            }).disableSelection();
        });

        function fixWidthHelper(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        }
    </script>
@elseif (Request::is('admin/review') || Request::segment(2) == 'review')
<script>
        $(document).ready(function () {
            $(document).on("click",".delete_review",function(e){
                e.preventDefault();
                var elem = $(this);
                var url = elem.attr("href");
                var token = $('meta[name="csrf-token"]').attr('content');
                bootbox.confirm("Do you sure want to delete this review?", function(result) {
                    if (result) {
                        $.post(url, {_token:token}, function (data) {
                            if (!data.error) {
                                $('table').DataTable().ajax.reload();
                            } else {
                                var msg = '<div class="alert alert-danger">' + data.message + '</div>';
                                bootbox.alert(msg);
                            }
                        }, "json");
                    }
                });
            });

            $(document).on("click", ".status", function (e) {
                e.preventDefault();
                var elem = $(this);
                var url = elem.attr("href");
                var status = elem.attr("data-status");
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: "json",
                    data: {status:status, _token:token},
                    success: function (data) {
                        if (!data.error) {
                            oTable.ajax.reload();
                        } else {
                            alert(data.message);
                        }
                    },
                });
            });
        });
</script>

@elseif (Request::is('admin/subscribers'))
<script>
        $(document).ready(function () {
            $(document).on("click",".delete_subscriber",function(e){
                e.preventDefault();
                var elem = $(this);
                var url = elem.attr("href");
                var token = $('meta[name="csrf-token"]').attr('content');
                bootbox.confirm("Do you sure want to delete this subscriber?", function(result) {
                    if (result) {
                        $.post(url, {_token:token}, function (data) {
                            if (!data.error) {
                                $('table').DataTable().ajax.reload();
                            } else {
                                var msg = '<div class="alert alert-danger">' + data.message + '</div>';
                                bootbox.alert(msg);
                            }
                        }, "json");
                    }
                });
            });
        });
</script>
@elseif (Request::segment(2) == 'gallary')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    var remove_image = function(elem){
        var element = $("#"+elem.id);
        var img = element.attr("data-img");
        var token = $('meta[name="csrf-token"]').attr('content');
        bootbox.confirm("Do you sure want to remove this image?", function(result) {
            if (result) {
                $.post("{{url('admin/remove_image')}}/"+img, {_token:token}, function (data) {
                    if (!data.error) {
                        element.closest('div.gallary').remove();
                    } else {
                        var msg = '<div class="alert alert-danger">' + data.message + '</div>';
                        bootbox.alert(msg);
                    }
                }, "json");
            }
        });
    }

    var remove_banner = function(elem){
        var element = $("#"+elem.id);
        var img = element.attr("data-img");
        var token = $('meta[name="csrf-token"]').attr('content');
        bootbox.confirm("Do you sure want to remove this image?", function(result) {
            if (result) {
                $.post("{{url('admin/remove_banner')}}/"+img, {_token:token}, function (data) {
                    if (!data.error) {
                        element.closest('div.banner').remove();
                    } else {
                        var msg = '<div class="alert alert-danger">' + data.message + '</div>';
                        bootbox.alert(msg);
                    }
                }, "json");
            }
        });
    }
    
</script>
@elseif (Request::is('admin/profile'))
<script>
$(document).ready(function () {
    $( ".camera" ).click(function() {
        $( "#image-input" ).click();
    });

    /*For validate profile pic */
    $("#image-input").on('change', function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            var error = "Only "+fileExtension.join(', ')+"formats are allowed.";
            $(this).val("").clone(true);
            var msg = '<div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+error+'</div>';
            bootbox.alert(msg);
        }else{
            $(this).closest("form").submit();
        }
    });

    /* For Services registration form validation */
    $("#reset-password-form").validate({
        rules:
            {
                old_password: {
                    required: true,
                },
                new_password: {
                    required: true,
                },
                confirm_new_password: {
                    required: true,
                    equalTo: '#new_password'
                },
            },
        messages:
            {
                old_password: "Old password field is required.",
                new_password: "New password field is required.",
                confirm_new_password:{
                    required: "Enter valid new confirm password.",
                    equalTo: "Passwords did not match! retype new confirm password."
                },
            },
        submitHandler: function(form) {
            form.submit();
        }
    });
    /* End Normal User registration form validation */
});
</script>
@elseif (Request::is('admin/pages') || Request::is('admin/pages/create') || (Request::segment(2) == 'pages' && Request::segment(4) == 'edit'))
    <script src="{{ asset('public/assets/admin/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on("click",".delete_pages",function(e){
                e.preventDefault();
                var elem = $(this);
                var url = elem.attr("href");
                bootbox.confirm("Do you sure want to delete this product?", function(result) {
                    if (result) {
                        $.post(url, {}, function (data) {
                            if (!data.error) {
                                $('table').DataTable().ajax.reload();
                            } else {
                                var msg = '<div class="alert alert-danger">' + data.message + '</div>';
                                bootbox.alert(msg);
                            }
                        }, "json");
                    }
                });
            });

            $(document).on('blur', '#title', function () {
                var _this = $(this);
                var text = _this.val();
                $('#slug').val(text.toLowerCase().replace(/ /g, '_').replace(/[^\w-]+/g, ''));
            });
        });
    </script>
@elseif (Request::is('admin/settings'))
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB1a2NAsRAQICTnCaOZa6wFPgNBRz4rOXM&sensor=false&amp;libraries=places"></script>
    <script src="{{ asset('public/assets/js/jquery.geocomplete.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#contact_address").geocomplete();
            $("#contact_location")
                .geocomplete()
                .bind("geocode:result", function (event, result) {
                    $("#contact_lat").val(result.geometry.location.lat());
                    $("#contact_long").val(result.geometry.location.lng());
            });

            $(document).on('blur', '#title', function () {
                var _this = $(this);
                var text = _this.val();
                $('#slug').val(text.toLowerCase().replace(/ /g, '_').replace(/[^\w-]+/g, ''));
            });
        });
    </script>
@endif
<!-- /Scripts -->
<script type="text/javascript">
    @if(isset($type) && (Request::is('admin/category') || Request::is('admin/manage_vendors') || Request::is('admin/manage_users') || Request::is('admin/slider') || Request::is('admin/review') || Request::is('admin/subscribers') || Request::is('admin/pages') || Request::segment(2) == 'review' || Request::is('admin/featured_vendors') || Request::is('admin/user_comments') || Request::is('admin/local_vendors')))
    var oTable;
    $(document).ready(function () {
        oTable = $('#{{$type}}').DataTable({
            @if(Request::is('admin/manage_vendors') || Request::is('admin/manage_users'))
            columns: [
                { data: 'name', name: 'name',sortable: true, searchable: true },
                { data: 'email', name: 'email',sortable: true, searchable: false },
                { data: 'created_at', name: 'created_at',sortable: true, searchable: false },
                { data: 'action', name: 'action', sortable: false, searchable: false }
            ],
            @elseif (Request::is('admin/category'))
            columns: [
                { data: 'category_name', name: 'category_name',sortable: true, searchable: true },
                { data: 'created_at', name: 'created_at',sortable: true, searchable: false },
                { data: 'action', name: 'action', sortable: false, searchable: false }
            ],
            @elseif (Request::is('admin/slider'))
            columns: [
                { data: 'title', name: 'title',sortable: true, searchable: true },
                { data: 'image', name: 'image',sortable: true, searchable: false},
                { className: 'text-center',data: 'order', name: 'order',sortable: true, searchable: false },
                { data: 'action', name: 'action', sortable: false, searchable: false }
            ],
            @elseif (Request::is('admin/review') || Request::segment(2) == 'review')
            columns: [
                { data: 'review_by', name: 'review_by',sortable: true, searchable: true },
                { data: 'vendor', name: 'vendor',sortable: true, searchable: true },
                { data: 'anonymous', name: 'anonymous',sortable: true, searchable: false },
                { data: 'review', name: 'review',sortable: true, searchable: false},
                { className: 'text-center',data: 'rating', name: 'rating',sortable: true, searchable: false },
                { data: 'action', name: 'action', sortable: false, searchable: false }
            ],
            @elseif (Request::is('admin/subscribers'))
            columns: [
                { data: 'subscriber', name: 'subscriber',sortable: true, searchable: true },
                { className: 'text-center',data: 'created_at', name: 'created_at',sortable: true, searchable: false },
                { data: 'action', name: 'action', sortable: false, searchable: false }
            ],
            @elseif (Request::is('admin/pages'))
            columns: [
                { data: 'title', name: 'title',sortable: true, searchable: true },
                { data: 'slug', name: 'slug',sortable: true, searchable: true },
                { data: 'publish', name: 'publish',sortable: false, searchable: false},
                { data: 'action', name: 'action', sortable: false, searchable: false }
            ],
            @elseif (Request::is('admin/featured_vendors'))
            columns: [
                { data: 'company_name', name: 'company_name',sortable: false, searchable: false },
                { data: 'category', name: 'category',sortable: false, searchable: false },
                { data: 'featured_image', name: 'featured_image',sortable: false, searchable: false },
                { data: 'vendor_profile_link', name: 'vendor_profile_link',sortable: false, searchable: false },
                { data: 'action', name: 'action', sortable: false, searchable: false }
            ],
            @elseif (Request::is('admin/local_vendors'))
            columns: [
                { data: 'title', name: 'title',sortable: true, searchable: true },
                { data: 'description', name: 'description',sortable: true, searchable: false },
                { data: 'image', name: 'image',sortable: false, searchable: false},
                { data: 'link', name: 'link',sortable: true, searchable: false },
                { data: 'action', name: 'action', sortable: false, searchable: false }
            ],
            @elseif ( Request::is('admin/user_comments'))
            columns: [
                { data: 'name', name: 'name',sortable: true, searchable: true },
                { data: 'description', name: 'description',sortable: true, searchable: false },
                { data: 'profile_pic', name: 'profile_pic',sortable: false, searchable: false},
                { data: 'action', name: 'action', sortable: false, searchable: false }
            ],
            @endif
            "processing": true,
            "serverSide": true,
            "order": [],
            @if (Request::is('admin/review') || Request::segment(2) == 'review')
                "ajax": "{{ url('admin/'.$type.'/data/').'/'.$reviewId }}",
            @else
                "ajax": "{{ url('admin/'.$type.'/data') }}",
            @endif
            "pagingType": "full_numbers",
        });
    });
    @endif
</script>
@yield('scripts')
</body>
</html>