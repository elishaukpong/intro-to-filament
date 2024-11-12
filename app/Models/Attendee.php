<?php

namespace App\Models;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class);
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            TextInput::make('ticket_cost')
                ->required()
                ->numeric(),
            Toggle::make('is_paid')
                ->required(),
            TextInput::make('conference_id')
                ->required()
                ->numeric(),
        ];
    }
}
