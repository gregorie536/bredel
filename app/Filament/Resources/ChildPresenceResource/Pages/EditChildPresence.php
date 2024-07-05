<?php

namespace App\Filament\Resources\ChildPresenceResource\Pages;

use App\Filament\Resources\ChildPresenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChildPresence extends EditRecord
{
    protected static string $resource = ChildPresenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
