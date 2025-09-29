<?php

namespace App\Exports;

use App\Models\Product;
use App\Services\Admin\RebortService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class SuppliersRebortExport implements FromCollection,WithHeadings, WithStyles, WithCustomStartCell, WithEvents
{
    protected $filters;
    protected $status_id;
    protected $rebortService;

    public function __construct(RebortService $rebortService, $status_id, $filters = [])
    {
        $this->rebortService = $rebortService;
        $this->status_id = $status_id;
        $this->filters = $filters;
    }


    public function collection()
    {
        if ($this->status_id == 1)
        {
            $data = $this->rebortService->getNewProducts(null, $this->filters);
            return $data['newProducts']->getCollection();
        } else
        {
            return $this->rebortService->getAllOrderDetailes($this->status_id, null, $this->filters);
        }
    }


    public function headings(): array
    {
        return [
            'ID',
            'اسم العميل',
            'رقم التتبع',
            'السعر',
            'التاريخ',
        ];
    }



      public function startCell(): string
    {
        return 'A5'; // البيانات تبدأ من الصف الخامس
    }

    public function styles(Worksheet $sheet)
    {
        return [
            5 => ['font' => ['bold' => true, 'size' => 12]], // تنسيق عناوين الأعمدة
        ];
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // دمج خلايا الهيدر
                $sheet->mergeCells('A1:E1');
                $sheet->mergeCells('A2:E2');
                $sheet->mergeCells('A3:E3');

                // كتابة الهيدر
                $sheet->setCellValue('A1', '📦 شركة الشحن');
                $sheet->setCellValue('A2', 'تقرير الشحنات');
                $sheet->setCellValue('A3', 'تاريخ التقرير: ' . now()->format('Y-m-d'));

                // تنسيق الهيدر
                $sheet->getStyle('A1:A3')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => ['horizontal' => 'center'],
                ]);

                // توسيع الأعمدة تلقائيًا
                foreach (range('A', 'E') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }

}
