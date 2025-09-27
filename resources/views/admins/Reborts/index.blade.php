@extends('admins.layouts.app')

@section('title1', 'التقارير')
@section('page_header_main', ' التقارير')
@section('page_header1', 'الرئيسية')
@section('page_header1_link', route('admin.dashboard'))
@section('page_header2', 'التقارير')


@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jsgrid/jsgrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jsgrid/jsgrid-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/ekko-lightbox/ekko-lightbox.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        @livewire('admin.reborts.data')
        {{-- @livewire('admin.reborts.print-rebort') --}}



    </section>
    <!-- /.content -->

@endsection


@section('js')
    <!-- jsGrid -->
    <script src="{{ asset('assets/admin/plugins/jsgrid/demos/db.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jsgrid/jsgrid.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Include Select2 JS -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({
                gutterPixels: 3
            });
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });




        })
    </script>



    <script>
        $(function() {
            $("#jsGrid1").jsGrid({
                height: "100%",
                width: "100%",

                sorting: true,
                paging: true,

                data: db.clients,

                fields: [{
                        name: "Name",
                        type: "text",
                        width: 150
                    },
                    {
                        name: "Age",
                        type: "number",
                        width: 50
                    },
                    {
                        name: "Address",
                        type: "text",
                        width: 200
                    },
                    {
                        name: "Country",
                        type: "select",
                        items: db.countries,
                        valueField: "Id",
                        textField: "Name"
                    },
                    {
                        name: "Married",
                        type: "checkbox",
                        title: "Is Married"
                    }
                ]
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('rebortsUpdateMS', function() {
                toastr.success('تم تحديث التقرير بنجاح', 'رسالة تحديث', {
                    timeOut: 5000
                });
            });


            Livewire.on('rebortsCreateMS', function() {
                toastr.success('تم اضافة التقرير بنجاح', 'رسالة اضافة', {
                    timeOut: 5000
                });
            });


            Livewire.on('rebortsErrorMS', function() {
                toastr.error('هناك خطا برجاء المحاولة في وقت اخر', 'رسالة خطا', {
                    timeOut: 5000
                });
            });

            // Livewire.on('servantsShow', function(data)
            // {
            //     // Redirect to the show page
            //     window.location.href = '/admin/treasuries/show/' + data.id; // Adjust the URL as needed
            // });

        });
    </script>



    {{-- <script>
    $(document).ready(function()
    {
        // Initialize Select2 Elements
        $('.select2').select2(
        {
            theme: 'bootstrap4'
        });

        // a bit of a delay to make sure filterizr is initialized
        setTimeout(function() {
            $('.btn[data-filter="1"]').click();
        }, 100);
    });
</script> --}}



    {{-- SELECT 2  --}}
    <script>
        document.addEventListener("livewire:initialized", function()
        {
            $(".select2_supplier").select2().on("change", function()
            {
                // $wire.set("supplier_id", $(this).val());
                // alert($(this).val());

                Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id')).set('supplier_id', $(this).val());
            });


            Livewire.hock("morphed", function(data)
            {
                $(".select2_supplier").select2();

            })
        })
    </script>




    <script>
    @endsection
