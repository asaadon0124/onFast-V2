<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    // المسارات اللي Rector هيبص عليها
    $rectorConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/routes',
        __DIR__ . '/database',
        __DIR__ . '/resources/views', // عشان الفيوز Blade
    ]);

    // استبعاد ملفات/مجلدات مش لازمة
    $rectorConfig->skip([
        __DIR__ . '/vendor',
        __DIR__ . '/storage',
        __DIR__ . '/bootstrap/cache',
        __DIR__ . '/node_modules',
    ]);

    // قواعد التحسين
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_82, // Laravel 11 محتاج PHP 8.2 أو أعلى
        SetList::CODE_QUALITY,      // تحسين جودة الكود
        SetList::TYPE_DECLARATION,  // إضافة/تحسين type hints
        SetList::PRIVATIZATION,     // خصخصة المتغيرات والميثودز اللي ينفع تبقى private
        SetList::EARLY_RETURN,      // استبدال if المتداخلة بـ early return
        SetList::NAMING,            // تحسين أسماء الكلاسات والمتغيرات
        SetList::DEAD_CODE,         // إزالة الكود الميت/الغير مستخدم
    ]);
};
