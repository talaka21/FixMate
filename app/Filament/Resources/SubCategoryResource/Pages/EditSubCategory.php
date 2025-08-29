<?php

namespace App\Filament\Resources\SubCategoryResource\Pages;

use App\Filament\Resources\SubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubCategory extends EditRecord
{
   protected static string $resource = SubCategoryResource::class;

    // هون منحدد التوجه بعد الحفظ
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
