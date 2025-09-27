<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>طباعة التقرير</title>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/print_style.css') }}">
</head>
<body onload="window.print()">
    <div class="invoice-container">
        <div class="invoice-header text-center">
            <h2>شركة الشحن</h2>
            <p>تقرير الشحنات - {{ now()->format('Y-m-d') }}</p>
        </div>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>رقم الشحنة</th>
                    <th>المستلم</th>
                    <th>العنوان</th>
                    <th>السعر</th>
                    <th>الإجمالي</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($get_order_detailes as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->product->tracking_number }}</td>
                        <td>{{ $item->product->resever_name }}</td>
                        <td>{{ $item->product->governorate->name ?? '-' }}</td>
                        <td>{{ $item->product->product_price }}</td>
                        <td>{{ $item->total_price }}</td>
                        <td>{{ $item->status->name ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="invoice-footer text-right mt-3">
            <h4>إجمالي: {{ number_format($totalPrice, 2) }} جنيه</h4>
        </div>

         <button wire:click="printReport" class="btn btn-success no-print">
                                        🖨️ طباعة التقرير
                                    </button>
    </div>
</body>
</html>
