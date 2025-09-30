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
    public function __construct(protected \App\Services\Admin\RebortService $rebortService, protected $status_id, protected $filters = [])
    {
    }


    public function collection()
    {
        if ($this->status_id == 1)
        {
            $data = $this->rebortService->getNewProducts(null, $this->filters);
            return $data['newProducts']->getCollection();
        }
        return $this->rebortService->getAllOrderDetailes($this->status_id, null, $this->filters);
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
            AfterSheet::class => function(AfterSheet $afterSheet): void {
                $worksheet = $afterSheet->sheet->getDelegate();

                // دمج خلايا الهيدر
                $worksheet->mergeCells('A1:E1');
                $worksheet->mergeCells('A2:E2');
                $worksheet->mergeCells('A3:E3');

                // كتابة الهيدر
                $worksheet->setCellValue('A1', '📦 شركة الشحن');
                $worksheet->setCellValue('A2', 'تقرير الشحنات');
                $worksheet->setCellValue('A3', 'تاريخ التقرير: ' . now()->format('Y-m-d'));

                // تنسيق الهيدر
                $worksheet->getStyle('A1:A3')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => ['horizontal' => 'center'],
                ]);

                // توسيع الأعمدة تلقائيًا
                foreach (range('A', 'E') as $col) {
                    $worksheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }

}
