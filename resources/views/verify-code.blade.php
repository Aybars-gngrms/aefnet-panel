<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('backend')}}/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{asset('backend')}}/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Aefnet Panel Girişi
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link href="{{asset('backend')}}/assets/css/material-dashboard.minf700.css?v=1.0.1" rel="stylesheet" />
    <link href="{{asset('backend')}}/assets/demo/demo.css" rel="stylesheet" />

    <style>
        .async-hide {
            opacity: 0 !important
        }
    </style>


</head>

<body class="dark-edition off-canvas-sidebar">
    @php
    use App\Http\Controllers\HashController;

    $hash = new HashController();
    @endphp
    <div class="wrapper wrapper-full-page">
        <div class="page-header register-page header-filter" filter-color="black" style="background-image: url('{{asset('backend')}}/assets/img/loading.png')">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <div class="card card-signup" style="opacity: 0.9;">
                            <h2 class="card-title text-center">Aefnet Panel Girişi</h2>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9 ml-auto mr-auto">
                                        <form class="form" method="post" action="{{route('login.verify-code.post')}}">
                                            @csrf

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="authorized_question" value="{{$manager->security_question }}" autocomplete="off" disabled="">
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="security_answer" placeholder="Güvenlik sorusu cevabı..." class="form-control">
                                                </div>
                                            </div>

                                            <div class="text-right">
                                                <button class="btn btn-success  mt-4">Gönder</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('backend')}}/assets/js/core/jquery.min.js"></script>
    <script src="{{asset('backend')}}/assets/js/core/popper.min.js"></script>
    <script src="{{asset('backend')}}/assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="{{asset('backend')}}/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

    <script src="{{asset('backend')}}/assets/js/material-dashboard.min.js" type="text/javascript"></script>

    <script src="{{asset('backend')}}/assets/demo/demo.js"></script>
    <script>
        $(document).ready(function() {
            $().ready(function() {
                $sidebar = $('.sidebar');

                $sidebar_img_container = $sidebar.find('.sidebar-background');

                $full_page = $('.full-page');

                $sidebar_responsive = $('body > .navbar-collapse');

                window_width = $(window).width();

                fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                    if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                        $('.fixed-plugin .dropdown').addClass('open');
                    }

                }

                $('.fixed-plugin a').click(function(event) {
                    // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                    if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        }
                    }
                });

                $('.fixed-plugin .active-color span').click(function() {
                    $full_page_background = $('.full-page-background');

                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-color', new_color);
                    }

                    if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data-color', new_color);
                    }
                });

                $('.fixed-plugin .background-color .badge').click(function() {
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('background-color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data-background-color', new_color);
                    }
                });

                $('.fixed-plugin .img-holder').click(function() {
                    $full_page_background = $('.full-page-background');

                    $(this).parent('li').siblings().removeClass('active');
                    $(this).parent('li').addClass('active');


                    var new_image = $(this).find("img").attr('src');

                    if ($sidebar_img_container.length != 0 && $(
                            '.switch-sidebar-image input:checked').length != 0) {
                        $sidebar_img_container.fadeOut('fast', function() {
                            $sidebar_img_container.css('background-image', 'url("' +
                                new_image + '")');
                            $sidebar_img_container.fadeIn('fast');
                        });
                    }

                    if ($full_page_background.length != 0 && $(
                            '.switch-sidebar-image input:checked').length != 0) {
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find(
                            'img').data('src');

                        $full_page_background.fadeOut('fast', function() {
                            $full_page_background.css('background-image', 'url("' +
                                new_image_full_page + '")');
                            $full_page_background.fadeIn('fast');
                        });
                    }

                    if ($('.switch-sidebar-image input:checked').length == 0) {
                        var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr(
                            'src');
                        var new_image_full_page = $('.fixed-plugin li.active .img-holder').find(
                            'img').data('src');

                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $full_page_background.css('background-image', 'url("' +
                            new_image_full_page + '")');
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                    }
                });

                $('.switch-sidebar-image input').change(function() {
                    $full_page_background = $('.full-page-background');

                    $input = $(this);

                    if ($input.is(':checked')) {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar_img_container.fadeIn('fast');
                            $sidebar.attr('data-image', '#');
                        }

                        if ($full_page_background.length != 0) {
                            $full_page_background.fadeIn('fast');
                            $full_page.attr('data-image', '#');
                        }

                        background_image = true;
                    } else {
                        if ($sidebar_img_container.length != 0) {
                            $sidebar.removeAttr('data-image');
                            $sidebar_img_container.fadeOut('fast');
                        }

                        if ($full_page_background.length != 0) {
                            $full_page.removeAttr('data-image', '#');
                            $full_page_background.fadeOut('fast');
                        }

                        background_image = false;
                    }
                });

                $('.switch-sidebar-mini input').change(function() {
                    $body = $('body');

                    $input = $(this);

                    if (md.misc.sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        md.misc.sidebar_mini_active = false;

                        // if we are on windows OS we activate the perfectScrollbar function
                        if ($(".sidebar").length != 0) {
                            var ps = new PerfectScrollbar('.sidebar');
                        }
                        if ($(".sidebar-wrapper").length != 0) {
                            var ps1 = new PerfectScrollbar('.sidebar-wrapper');
                        }
                        if ($(".main-panel").length != 0) {
                            var ps2 = new PerfectScrollbar('.main-panel');
                        }
                        if ($(".main").length != 0) {
                            var ps3 = new PerfectScrollbar('main');
                        }
                        $('html').addClass('perfect-scrollbar-on');

                    } else {
                        $('html').addClass('perfect-scrollbar-off');

                        setTimeout(function() {
                            $('body').addClass('sidebar-mini');

                            md.misc.sidebar_mini_active = true;
                        }, 300);
                    }

                    // we simulate the window Resize so the charts will get updated in realtime.
                    var simulateWindowResize = setInterval(function() {
                        window.dispatchEvent(new Event('resize'));
                    }, 180);

                    // we stop the simulation of Window Resize after the animations are completed
                    setTimeout(function() {
                        clearInterval(simulateWindowResize);
                    }, 1000);

                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            md.checkFullPageBackgroundImage();
        });
    </script>
</body>
</html>
