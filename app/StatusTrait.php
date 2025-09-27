<?php

namespace App;

trait StatusTrait
{
    public function getStatusTextAttribute(): string
    {
        return $this->status === 'un_active' ? 'غير مفعل' : 'مفعل';
    }


    public function getLastUpdateAttribute(): ?string
    {
        if ($this->updated_by && $this->updated_by > 0)
        {
            $date = $this->updated_at->format('Y-m-d');
            $time = $this->updated_at->format('H:i');
            $period = $this->updated_at->format('A') === 'AM' ? 'صباحًا' : 'مساءً';

            return "آخر تحديث بتاريخ: {$date} في {$time} {$period}";
        }

        return 'لم يتم التحديث بعد';
    }
}
