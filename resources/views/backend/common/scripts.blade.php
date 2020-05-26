<!-- latest jquery -->
<!-- <script src="{{ url('/') }}/assets/js/jquery-3.3.1.min.js"></script> -->

<!-- Bootstrap js-->
<script src="{{ url('/') }}/assets/js/popper.min.js"></script>
<script src="{{ url('/') }}/assets/js/bootstrap.js"></script>

<!-- feather icon js-->
<script src="{{ url('/') }}/assets/js/icons/feather-icon/feather.min.js"></script>
<script src="{{ url('/') }}/assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- Sidebar jquery-->
<script src="{{ url('/') }}/assets/js/sidebar-menu.js"></script>

<!-- touchspin js-->
<script src="{{ url('/') }}/assets/js/touchspin/vendors.min.js"></script>
<script src="{{ url('/') }}/assets/js/touchspin/touchspin.js"></script>
<script src="{{ url('/') }}/assets/js/touchspin/input-groups.min.js"></script>

<!-- form validation js-->
<script src="{{ url('/') }}/assets/js/dashboard/form-validation-custom.js"></script>

<!-- ckeditor js-->
<script src="{{ url('/') }}/assets/js/editor/ckeditor/ckeditor.js"></script>
<script src="{{ url('/') }}/assets/js/editor/ckeditor/styles.js"></script>
<script src="{{ url('/') }}/assets/js/editor/ckeditor/adapters/jquery.js"></script>
<script src="{{ url('/') }}/assets/js/editor/ckeditor/ckeditor.custom.js"></script>

<!-- Zoom js-->
<script src="{{ url('/') }}/assets/js/jquery.elevatezoom.js"></script>
<script src="{{ url('/') }}/assets/js/zoom-scripts.js"></script>

<!--chartist js-->
<script src="{{ url('/') }}/assets/js/chart/chartist/chartist.js"></script>

<!--chartjs js-->
<script src="{{ url('/') }}/assets/js/chart/chartjs/chart.min.js"></script>

<!-- lazyload js-->
<script src="{{ url('/') }}/assets/js/lazysizes.min.js"></script>

<!--copycode js-->
<script src="{{ url('/') }}/assets/js/prism/prism.min.js"></script>
<script src="{{ url('/') }}/assets/js/clipboard/clipboard.min.js"></script>
<script src="{{ url('/') }}/assets/js/custom-card/custom-card.js"></script>

<!--counter js-->
<script src="{{ url('/') }}/assets/js/counter/jquery.waypoints.min.js"></script>
<script src="{{ url('/') }}/assets/js/counter/jquery.counterup.min.js"></script>
<script src="{{ url('/') }}/assets/js/counter/counter-custom.js"></script>

<!--peity chart js-->
<script src="{{ url('/') }}/assets/js/chart/peity-chart/peity.jquery.js"></script>

<!--sparkline chart js-->
<script src="{{ url('/') }}/assets/js/chart/sparkline/sparkline.js"></script>

<!--Customizer admin-->
<script src="{{ url('/') }}/assets/js/admin-customizer.js"></script>

<!--dashboard custom js-->
<script src="{{ url('/') }}/assets/js/dashboard/default.js"></script>

<!--right sidebar js-->
<script src="{{ url('/') }}/assets/js/chat-menu.js"></script>

<!--height equal js-->
<script src="{{ url('/') }}/assets/js/height-equal.js"></script>

<!-- lazyload js-->
<script src="{{ url('/') }}/assets/js/lazysizes.min.js"></script>

<!--script admin-->
<script src="{{ url('/') }}/assets/js/admin-script.js"></script>

<script src="//cdn.jsdelivr.net/jquery.amaran/0.5.4/jquery.amaran.min.js"></script>

<script>
    var random = function(items) {
        return items[Math.floor(Math.random() * items.length)];
    }
    var inEffects = ['slideRight', 'slideLeft', 'slideBottom', 'slideTop'];
    var positions = ['top left', 'top right', 'bottom right', 'bottom left'];
</script>


@if(Session::has('success'))
<script>
    $(function() {
        $.amaran({
            content: {
                title: 'Success',
                message: "{{ Session::get('success') }}",
                info: 'This is passed !!',
                icon: 'fa fa-thumbs-o-up',
                position: random(positions), //position: "bottom right",
                inEffect: random(inEffects),
                delay: 10000,
                outEffect: "fadeOut",
                closeOnClick: true,
                closeButton: true,
            },
            theme: 'awesome ok'
        });
    });
</script>
@endif

@if(Session::has('error'))
<script>
    $(function() {
        $.amaran({
            content: {
                title: 'Error',
                message: "{{ Session::get('error') }}",
                info: 'Some issue occurs!!',
                icon: 'fa fa-thumbs-o-down',
                position: random(positions), //position: "bottom right",
                inEffect: random(inEffects),
                delay: 10000,
                outEffect: "fadeOut",
                closeOnClick: true,
                closeButton: true,
            },
            theme: 'awesome error'
        });
    });
</script>
@endif


@if(Session::has('warning'))
<script>
    $(function() {
        $.amaran({
            content: {
                title: 'Warning',
                message: "{{ Session::get('warning') }}",
                info: 'There is some warning!!',
                icon: 'fa fa-exclamation-triangle',
                position: random(positions), //position: "bottom right",
                inEffect: random(inEffects),
                delay: 10000,
                outEffect: "fadeOut",
                closeOnClick: true,
                closeButton: true,
            },
            theme: 'awesome warning'
        });
    });
</script>
@endif

@if(Session::has('info'))
<script>
    $(function() {
        $.amaran({
            content: {
                title: 'Okay',
                message: "{{ Session::get('info') }}",
                info: 'It\'s okay!!',
                icon: 'fa fa-hand-paper-o',
                position: random(positions), //position: "bottom right",
                inEffect: random(inEffects),
                delay: 10000,
                outEffect: "fadeOut",
                closeOnClick: true,
                closeButton: true,
            },
            theme: 'awesome blue'
        });
    });
</script>
@endif