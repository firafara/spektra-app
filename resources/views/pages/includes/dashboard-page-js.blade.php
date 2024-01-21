@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="{{ asset('/') }}assets/plugins/moment/moment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
    <script src="{{ asset('/assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}">
    </script>
    <script>
        function hideAll(x, y) {
            $('.' + x).css('display', 'none');
            $('.' + y).css('display', 'inline');
        }

        function showAll(x, y) {
            $('.' + x).css('display', 'inline');
            $('.' + y).css('display', 'none');
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#datepicker-inline div').datepicker({
                todayHighlight: true
            });
        });
    </script>
@endpush
