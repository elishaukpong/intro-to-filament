<?php

namespace App\Models;

use App\Enum\Region;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Conference extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'region',
        'venue_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'venue_id' => 'integer',
        'region' => Region::class
    ];

    public static function getForm()
    {
        return [
            Section::make('Conference Details')
                ->columns(2)
                ->schema([
                    TextInput::make('Conference Name')
                        ->required()
                        ->columnSpanFull()
                        ->default('My Conference')
                        ->maxLength(60),
                    MarkdownEditor::make('Conference description')
                        ->columnSpanFull()
                        ->required(),
                    DateTimePicker::make('start_date')
                        ->columns(1)
                        ->native(false)
                        ->required(),
                    DateTimePicker::make('end_date')
                        ->columns(1)
                        ->native(false)
                        ->required(),

                    Fieldset::make('Status')
                        ->columns(1)
                        ->schema([
                            Select::make('status')
                                ->options([
                                    'draft' => 'Draft',
                                    'published' => 'Published',
                                    'archived' => 'Archived'
                                ]),
                            Toggle::make('is_published')
                                ->default(false),
                        ])
                ]),
            Section::make('Conference Details')
                ->columns(2)
                ->schema([
                    Select::make('region')
                        ->live()
                        ->enum(Region::class)
                        ->options(Region::class),
                    Select::make('venue_id')
                        ->searchable()
                        ->editOptionForm(Venue::getForm())
                        ->createOptionForm(Venue::getForm())
                        ->preload()
                        ->relationship('venue', 'name', function(Builder $query, Get $get){
                            return $query->where('region',$get('region'));
                        }),
                ]),
        ];
    }

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Speaker::class);
    }

    public function talks(): BelongsToMany
    {
        return $this->belongsToMany(Talk::class);
    }
}
