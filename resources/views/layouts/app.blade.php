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
        <script src="{{ asset('assets/js/vendor/visualization/d3/d3.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/visualization/d3/d3_tooltip.js') }}"></script>

        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/demo/pages/datatables_basic.js') }}"></script>
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


    //
    // Setup module components
    //

    // Noty.js examples
    const _componentNoty = function() {
        if (typeof Noty == 'undefined') {
            console.warn('Warning - noty.min.js is not loaded.');
            return;
        }

        // Override Noty defaults
        Noty.overrideDefaults({
            theme: 'limitless',
            layout: 'topRight',
            type: 'alert',
            timeout: 2500
        });


        //
        // Notification types
        //

        // Error
        const notyErrorElement = document.querySelector('#noty_error');
        if(notyErrorElement) {
            notyErrorElement.addEventListener('click', function() {
                new Noty({
                    text: 'Change a few things up and try submitting again.',
                    type: 'error'
                }).show();
            });
        }

        // Success
        const notySuccessElement = document.querySelector('#noty_success');
        if(notySuccessElement) {
            notySuccessElement.addEventListener('click', function() {
                new Noty({
                    text: 'You successfully read this important alert message.',
                    type: 'success'
                }).show();
            });
        }

        // Warning
        const notyWarningElement = document.querySelector('#noty_warning');
        if(notyWarningElement) {
            notyWarningElement.addEventListener('click', function() {
                new Noty({
                    text: 'Warning! Best check yo self, you\'re not looking too good.',
                    type: 'warning'
                }).show();
            });
        }

        // Info
        const notyInfoElement = document.querySelector('#noty_info');
        if(notyInfoElement) {
            notyInfoElement.addEventListener('click', function() {
                new Noty({
                    text: 'This alert needs your attention, but it\'s not super important.',
                    type: 'info'
                }).show();
            });
        }

        // Alert
        const notyAlertElement = document.querySelector('#noty_alert');
        if(notyAlertElement) {
            notyAlertElement.addEventListener('click', function() {
                new Noty({
                    text: 'Best check yourself, you\'re not looking too good.',
                    type: 'alert'
                }).show();
            });
        }

        // Confirmation
        const notyConfirmElement = document.querySelector('#noty_confirm');
        if(notyConfirmElement) {
            notyConfirmElement.addEventListener('click', function() {
                var notyConfirm = new Noty({
                    text: '<h6 class="mb-3">Please confirm your action</h6><label class="form-label">Enter comment (optional)</label> <input type="text" class="form-control" placeholder="Enter comment">',
                    timeout: false,
                    modal: true,
                    layout: 'center',
                    closeWith: 'button',
                    type: 'confirm',
                    buttons: [
                        Noty.button('Cancel', 'btn btn-link', function () {
                            notyConfirm.close();
                        }),

                        Noty.button('Submit <i class="ph-paper-plane-tilt ms-2"></i>', 'btn btn-primary ms-1', function () {
                                alert('Submitted!');
                                notyConfirm.close();
                            },
                            {id: 'button1', 'data-status': 'ok'}
                        )
                    ]
                }).show();
            });
        }


        //
        // Top position
        //

        // Top
        const notyTopElement = document.querySelector('#noty_top');
        if(notyTopElement) {
            notyTopElement.addEventListener('click', function() {
                new Noty({
                    layout: 'top',
                    text: 'Best check yourself, you\'re not looking too good.',
                    type: 'alert'
                }).show();
            });
        }

        // Left
        const notyTopLeftElement = document.querySelector('#noty_top_left');
        if(notyTopLeftElement) {
            notyTopLeftElement.addEventListener('click', function() {
                new Noty({
                    layout: 'topLeft',
                    text: 'Best check yourself, you\'re not looking too good.',
                    type: 'alert'
                }).show();
            });
        }

        // Center
        const notyTopCenterElement = document.querySelector('#noty_top_center');
        if(notyTopCenterElement) {
            notyTopCenterElement.addEventListener('click', function() {
                new Noty({
                    layout: 'topCenter',
                    text: 'Best check yourself, you\'re not looking too good.',
                    type: 'alert'
                }).show();
            });
        }

        // Right (default)
        const notyTopRightElement = document.querySelector('#noty_top_right');
        if(notyTopRightElement) {
            notyTopRightElement.addEventListener('click', function() {
                new Noty({
                    text: 'Best check yourself, you\'re not looking too good.',
                    type: 'alert'
                }).show();
            });
        }


        //
        // Center position
        //

        // Left
        const notyCenterLeftElement = document.querySelector('#noty_center_left');
        if(notyCenterLeftElement) {
            notyCenterLeftElement.addEventListener('click', function() {
                new Noty({
                    layout: 'centerLeft',
                    text: 'You successfully read this important alert message.',
                    type: 'success'
                }).show();
            });
        }

        // Center
        const notyCenterElement = document.querySelector('#noty_center');
        if(notyCenterElement) {
            notyCenterElement.addEventListener('click', function() {
                new Noty({
                    layout: 'center',
                    text: 'You successfully read this important alert message.',
                    type: 'success'
                }).show();
            });
        }

        // Right
        const notyCenterRightElement = document.querySelector('#noty_center_right');
        if(notyCenterRightElement) {
            notyCenterRightElement.addEventListener('click', function() {
                new Noty({
                    layout: 'centerRight',
                    text: 'You successfully read this important alert message.',
                    type: 'success'
                }).show();
            });
        }


        //
        // Bottom position
        //

        // Bottom
        const notyBottomElement = document.querySelector('#noty_bottom');
        if(notyBottomElement) {
            notyBottomElement.addEventListener('click', function() {
                new Noty({
                    layout: 'bottom',
                    text: 'This alert needs your attention, but it\'s not super important.',
                    type: 'info'
                }).show();
            });
        }

        // Left
        const notyBottomLeftElement = document.querySelector('#noty_bottom_left');
        if(notyBottomLeftElement) {
            notyBottomLeftElement.addEventListener('click', function() {
                new Noty({
                    layout: 'bottomLeft',
                    text: 'This alert needs your attention, but it\'s not super important.',
                    type: 'info'
                }).show();
            });
        }

        // Center
        const notyBottomCenterElement = document.querySelector('#noty_bottom_center');
        if(notyBottomCenterElement) {
            notyBottomCenterElement.addEventListener('click', function() {
                new Noty({
                    layout: 'bottomCenter',
                    text: 'This alert needs your attention, but it\'s not super important.',
                    type: 'info'
                }).show();
            });
        }

        // Right (default)
        const notyBottomRightElement = document.querySelector('#noty_bottom_right');
        if(notyBottomRightElement) {
            notyBottomRightElement.addEventListener('click', function() {
                new Noty({
                    layout: 'bottomRight',
                    text: 'This alert needs your attention, but it\'s not super important.',
                    type: 'info'
                }).show();
            });
        }


        //
        // Other examples
        //

        // Overlay
        const notyOverlayElement = document.querySelector('#noty_overlay');
        if(notyOverlayElement) {
            notyOverlayElement.addEventListener('click', function() {
                new Noty({
                    text: 'This alert needs your attention, but it\'s not super important.',
                    type: 'info',
                    modal: true
                }).show();
            });
        }

        // Sticky
        const notyStickyElement = document.querySelector('#noty_sticky');
        if(notyStickyElement) {
            notyStickyElement.addEventListener('click', function() {
                new Noty({
                    text: 'This alert needs your attention, but it\'s not super important.',
                    type: 'info',
                    timeout: false
                }).show();
            });
        }

        // Close button
        const notyCloseElement = document.querySelector('#noty_close');
        if(notyCloseElement) {
            notyCloseElement.addEventListener('click', function() {
                new Noty({
                    text: 'This alert needs your attention, but it\'s not super important.',
                    type: 'info',
                    closeWith: ['button']
                }).show();
            });
        }

        // No progress
        const notyProgressElement = document.querySelector('#noty_progress');
        if(notyProgressElement) {
            notyProgressElement.addEventListener('click', function() {
                new Noty({
                    text: 'This alert needs your attention, but it\'s not super important.',
                    type: 'info',
                    progressBar: false
                }).show();
            });
        }

        // Custom color
        const notyCustomColorElement = document.querySelector('#noty_custom');
        if(notyCustomColorElement) {
            notyCustomColorElement.addEventListener('click', function() {
                new Noty({
                    theme: ' bg-teal',
                    text: 'This alert needs your attention, but it\'s not super important.',
                    type: 'info'
                }).show();
            });
        }
        new Noty({
                    theme: ' bg-teal',
                    text: 'This alert needs your attention, but it\'s not super important.',
                    type: 'info'
                }).show();
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentNoty();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    NotyDemo.init();
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