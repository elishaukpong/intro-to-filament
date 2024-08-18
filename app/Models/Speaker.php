<?php

namespace App\Models;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Speaker extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'bio',
        'twitter_handle',
        'qualifications'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'qualifications' => 'array'
    ];

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
           Textarea::make('bio')
                ->required()
                ->columnSpanFull(),
           TextInput::make('twitter_handle')
                ->required()
                ->maxLength(255),
            CheckboxList::make('qualifications')
                ->columnSpanFull()
                ->searchable()
                ->bulkToggleable()
                ->options([
                    'business-leader' => 'Business Leader',
                    'charisma' => 'Charisma',
                    'first-time' => 'First Time Speaker',
                    'hometown-hero' => 'Hometown Hero',
                    'humanitarian' => 'Works in Humanitarian Field',
                    'unique-perspective' => 'Unique Perspective',
                ])
                ->descriptions([

                ])
                ->columns(3)
        ];
    }

    public function conferences(): BelongsToMany
    {
        return $this->belongsToMany(Conference::class);
    }
}
