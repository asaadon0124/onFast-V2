@extends('admins.layouts.app')

@section('title1', 'المناديب')
@section('page_header_main', ' المناديب')
@section('page_header1', 'الرئيسية')
@section('page_header1_link', route('admin.dashboard'))
@section('page_header2', 'المناديب')


@section('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jsgrid/jsgrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jsgrid/jsgrid-theme.min.css') }}">
@endsection
@section('content')

    <!-- Main content -->
    <section class="content">
        @livewire('admin.servant.data')
        @livewire('admin.servant.create')
        @livewire('admin.servant.update')
        @livewire('admin.servant.delete')


    </section>
    <!-- /.content -->

@endsection


@section('js')
    <!-- jsGrid -->
    <script src="{{ asset('assets/admin/plugins/jsgrid/demos/db.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jsgrid/jsgrid.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
        Livewire.on('servantsUpdateMS', function()
        {
            toastr.success('تم تحديث المندوب بنجاح', 'رسالة تحديث', { timeOut: 5000 });
        });


        Livewire.on('servantsCreateMS', function()
        {
            toastr.success('تم اضافة المندوب بنجاح', 'رسالة اضافة', { timeOut: 5000 });
        });


        Livewire.on('servantsErrorMS', function()
        {
            toastr.error('هناك خطا برجاء المحاولة في وقت اخر', 'رسالة خطا', { timeOut: 5000 });
        });

        // Livewire.on('servantsShow', function(data)
        // {
        //     // Redirect to the show page
        //     window.location.href = '/admin/treasuries/show/' + data.id; // Adjust the URL as needed
        // });

    });
</script>
@endsection
