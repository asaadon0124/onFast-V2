@extends('admins.layouts.app')

@section('title1', 'الشحنات')
@section('page_header_main', ' الشحنات')
@section('page_header1', 'الرئيسية')
@section('page_header1_link', route('admin.dashboard'))
@section('page_header2', 'الشحنات')


@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jsgrid/jsgrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jsgrid/jsgrid-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">

@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        @livewire('admin.product.data')
        @livewire('admin.product.create')
        @livewire('admin.product.update')
        @livewire('admin.product.delete')


    </section>
    <!-- /.content -->

@endsection


@section('js')
    <!-- jsGrid -->
    <script src="{{ asset('assets/admin/plugins/jsgrid/demos/db.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jsgrid/jsgrid.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{  asset('assets/admin/plugins/datatables-bs4/js/jquery.dataTables.js') }}"></script>
<script src="{{  asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

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
    document.addEventListener('DOMContentLoaded', function()
    {
        Livewire.on('productsUpdateMS', function()
        {
            toastr.success('تم تحديث الشحنة بنجاح', 'رسالة تحديث', { timeOut: 5000 });
        });


        Livewire.on('productsCreateMS', function()
        {
            toastr.success('تم اضافة الشحنة بنجاح', 'رسالة اضافة', { timeOut: 5000 });
        });


        Livewire.on('productsErrorMS', function()
        {
            toastr.error('هناك خطا برجاء المحاولة في وقت اخر', 'رسالة خطا', { timeOut: 5000 });
        });

        // Livewire.on('productsShow', function(data)
        // {
        //     // Redirect to the show page
        //     window.location.href = '/admin/treasuries/show/' + data.id; // Adjust the URL as needed
        // });

    });
</script>
@endsection
