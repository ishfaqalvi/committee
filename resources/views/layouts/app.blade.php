<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title')</title>

        <!-- Global stylesheets -->
        <link href="{{ asset('assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script src="{{ asset('assets/demo/demo_configurator.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/notifications/noty.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/notifications/sweet_alert.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/forms/selects/bootstrap_multiselect.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/uploaders/dropzone.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/visualization/d3/d3.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/visualization/d3/d3_tooltip.js') }}"></script>

        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/demo/pages/datatables_basic.js') }}"></script>
        <script src="{{ asset('assets/demo/pages/form_select2.js') }}"></script>
        <script src="{{ asset('assets/demo/pages/dashboard.js') }}"></script>
        <script src="{{ asset('assets/demo/charts/pages/dashboard/streamgraph.js') }}"></script>
        <script src="{{ asset('assets/demo/charts/pages/dashboard/sparklines.js') }}"></script>
        <script src="{{ asset('assets/demo/charts/pages/dashboard/lines.js') }}"></script>    
        <script src="{{ asset('assets/demo/charts/pages/dashboard/areas.js') }}"></script>
        <script src="{{ asset('assets/demo/charts/pages/dashboard/donuts.js') }}"></script>
        <script src="{{ asset('assets/demo/charts/pages/dashboard/bars.js') }}"></script>
        <script src="{{ asset('assets/demo/charts/pages/dashboard/progress.js') }}"></script>
        <script src="{{ asset('assets/demo/charts/pages/dashboard/heatmaps.js') }}"></script>
        <script src="{{ asset('assets/demo/charts/pages/dashboard/pies.js') }}"></script>
        <script src="{{ asset('assets/demo/charts/pages/dashboard/bullets.js') }}"></script>
        <script>
            var NotyDemo = function() {

                const _componentNoty = function() {
                    if (typeof Noty == 'undefined') {
                        console.warn('Warning - noty.min.js is not loaded.');
                        return;
                    }
                    Noty.overrideDefaults({
                        theme: 'limitless',
                        layout: 'topRight',
                        type: 'alert',
                        timeout: 2500
                    });
                    @if(Session::has('success'))
                        new Noty({
                            layout: 'bottomCenter',
                            text: "{{Session::get('success')}}",
                            type: 'success'
                        }).show();
                    @endif
                    @if(Session::has('warning'))
                        new Noty({
                            layout: 'bottomCenter',
                            text: "{{Session::get('warning')}}",
                            type: 'warning'
                        }).show();
                    @endif
                    @if(Session::has('info'))
                        new Noty({
                            layout: 'bottomCenter',
                            text: "{{Session::get('info')}}",
                            type: 'info'
                        }).show();
                    @endif
                    @if(Session::has('error'))
                        new Noty({
                            layout: 'bottomCenter',
                            text: "{{Session::get('error')}}",
                            type: 'error'
                        }).show();
                    @endif
                }
                return {
                    init: function() {
                        _componentNoty();
                    }
                }
            }();
            document.addEventListener('DOMContentLoaded', function() {
                NotyDemo.init();
            });
        </script>
        <script>
            $(function () {
                const swalInit = swal.mixin({
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-light',
                        denyButton: 'btn btn-light',
                        input: 'form-control'
                    }
                });
                $(".sa-confirm").click(function (event) {
                    event.preventDefault();
                    swalInit.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        }
                    }).then((result) => {
                        if (result.value === true)  $(this).closest("form").submit();
                    });
                });
            });
        </script>
        @yield('script')
    </head>
    <body>
        <div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
            @include('layouts.navigation')
        </div>
        <div class="page-content">
            <div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">
                @include('layouts.sidebar')
            </div>
            <div class="content-wrapper">
                <div class="content-inner">
                    <div class="page-header page-header-light shadow">
                        @yield('header')
                    </div>
                    <div class="content">
                        <div class="row">
                            @yield('content')
                        </div>
                    </div>
                    <div class="navbar navbar-sm navbar-footer border-top">
                        @include('layouts.footer')
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="notifications">
            @include('layouts.notification')
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="demo_config">
            @include('layouts.configuration')
        </div>
    </body>
</html>