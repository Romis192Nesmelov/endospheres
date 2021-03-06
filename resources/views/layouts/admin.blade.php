<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Endospheres therapy. Admin page</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap-switch.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/colors.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/libraries/bootstrap.min.js') }}"></script>
    <!-- /core JS files -->

    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/bootstrap-switch.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/bootstrap-toggle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/inputs/typeahead/handlebars.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/plugins/ui/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/pickers/daterangepicker.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/plugins/pickers/anytime.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/pickers/pickadate/picker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/pickers/pickadate/picker.date.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/pickers/pickadate/picker.time.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/pickers/pickadate/legacy.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pages/picker_date.js') }}"></script>


    <script type="text/javascript" src="{{ asset('js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/media/fancybox.min.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('js/pages/components_thumbnails.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/pages/datatables_basic.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pages/gallery.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/plugins/pickers/color/spectrum.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/main.controls.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/pages/picker_color.js') }}"></script>

    <!-- /theme JS files -->
    <script type="text/javascript" src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
</head>

<body>
@include('layouts._message_modal_block')

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <span>{{ Auth::user()->email }} </span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="divider"></li>
                    <li><a href="{{ url('/logout') }}"><i class="icon-switch2"></i> {{ trans('auth.logout') }}</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container">

<!-- Page content -->
<div class="page-content">

<!-- Main sidebar -->
<div class="sidebar sidebar-main">
<div class="sidebar-content">

<!-- User menu -->
<div class="sidebar-user">
    <div class="category-content">
        <div class="media">
            <div class="media-body">
                <div class="text-size-mini text-muted">
                    <i class="glyphicon glyphicon-user text-size-small"></i> {!! trans('admin_content.welcome').'<br>'.Auth::user()->email !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /user menu -->

<!-- Main navigation -->
<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">
            <!-- Main -->
            @foreach ($menus as $menu)
                <li {{ preg_match('/^(admin\/'.str_replace('/','\/',$menu['href']).')/', Request::path()) ? 'class=active' : '' }}>
                    <a href="{{ url('/admin/'.$menu['href']) }}"><i class="{{ $menu['icon'] }}"></i> <span>@include('admin._substr_block', ['string' => $menu['name'], 'length' => 20])</span></a>
                    @if (isset($menu['submenu']) && count($menu['submenu']))
                        <ul>
                            @foreach ($menu['submenu'] as $submenu)
                                <?php
                                $addAttrStr = '';
                                if (isset($submenu['addAttr']) && count($submenu['addAttr']) ) {
                                    foreach ($submenu['addAttr'] as $attr => $val) {
                                        $addAttrStr .= $attr.'="'.$val.'"';
                                    }
                                }
                                ?>
                                <li {{
                                    'admin/'.$menu['href'].'/'.$submenu['href'] == Request::path().(Request::has('id') ? '?id='.Request::input('id') : '') ||
                                    ($menu['href'] == 'chapters' && isset($data['chapter']) && $submenu['href'] == $data['chapter']->slug) ||
                                    ($menu['href'] == 'chapters' && $submenu['id'] == 4 && preg_match('/^(admin\/question)/', Request::path())) ||
                                    ($menu['href'] == 'chapters' && $submenu['id'] == 5 && preg_match('/^(admin\/review)/', Request::path())) ||
                                    ($menu['href'] == 'chapters' && $submenu['id'] == 5 && preg_match('/^(admin\/photo\-result)/', Request::path())) ||
                                    ($menu['href'] == 'chapters' && $submenu['id'] == 6 && preg_match('/^(admin\/news)/', Request::path())) ||
                                    ($menu['href'] == 'chapters' && $submenu['id'] == 8 && preg_match('/^(admin\/mass-media)/', Request::path())) ||
                                    ($menu['href'] == 'chapters' && $submenu['id'] == 8 && preg_match('/^(admin\/resource)/', Request::path())) ||
                                    ($menu['href'] == 'chapters' && $submenu['id'] == 10 && preg_match('/^(admin\/recommendation)/', Request::path())) ||
                                    ($menu['href'] == 'chapters' && isset($data['sub_chapter']) && $submenu['href'] == $data['sub_chapter']->chapter->slug)

                                        ? 'class=active' : '' }}><a href="{{ url('/admin/'.$menu['href'].'/'.$submenu['href']) }}" {!! $addAttrStr !!}>@include('admin._substr_block', ['string' => $submenu['name'], 'length' => 20])</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
<!-- /main navigation -->

</div>
</div>
<!-- /main sidebar -->


<!-- Main content -->
<div class="content-wrapper">

    <!-- Page header -->
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4>
                    <i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">{{ trans('admin_menu.home') }}</span>
                    @foreach ($breadcrumbs as $href => $crumb)
                        {{ '- '.$crumb }}
                    @endforeach
                 </h4>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{ url('/admin') }}"><i class="icon-home2 position-left"></i>{{ trans('admin_menu.home') }}</a></li>
                @foreach ($breadcrumbs as $href => $crumb)
                    <li><a href="{{ url('/admin/'.$href) }}">{{ $crumb }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">@yield('content')</div>
    <!-- /content area -->

</div>
<!-- /main content -->

</div>
<!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>