<?php

namespace App\Filament\Hr\Resources\PerformanceReviews\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
// Use the recommended type hints from Filament Forms/Fields
use Filament\Forms\Set;
use Filament\Forms\Get;

class PerformanceReviewForm
{
    /**
     * Reusable closure to calculate and set the overall rating.
     * Use in afterStateUpdated on individual rating fields.
     */
    // FIX: Change type hints from Closure to callable (or Set/Get from Filament Forms)
    // Using callable is safe and covers both Closure and Filament's utility classes.
    protected static function updateOverallRating(callable $set, callable $get): void
    {
        // Calculate the overall rating using the helper function
        $overall = self::calculateOverall($get);
        
        // Set the calculated overall rating
        $set('overall_rating', $overall);
    }

    public static function configure(Schema $schema): Schema
    {
        // Define the closure for updating the overall rating for cleaner code
        // We use the callable type hints here for consistency.
        $updateOverallRatingClosure = fn (callable $set, callable $get) => self::updateOverallRating($set, $get);

        // Define a base TextInput for ratings to avoid repetition
        $ratingTextInput = fn (string $name) => TextInput::make($name)
            ->numeric()
            ->minValue(1)
            ->maxValue(10)
            ->required()
            ->live()
            // THE CRUCIAL PART: The individual fields trigger the overall calculation
            ->afterStateUpdated($updateOverallRatingClosure); 
            

        return $schema
            ->components([

                Section::make('Reviewer Details')
                    ->columns(2)
                    ->schema([

                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Reviewee'),

                        Select::make('reviewer_id')
                            ->relationship('reviewer', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        TextInput::make('review_period')
                            ->default(null),
                    ]),

                Section::make('Performance Ratings (1-10)')
                    ->columns(2)
                    ->schema([
                        // Use the base definition with the update logic
                        $ratingTextInput('quality_of_work')
                                        ->live(onBlur:true),
                        $ratingTextInput('productivity')
                                        ->live(onBlur:true),
                        $ratingTextInput('communication')
                                        ->live(onBlur:true),
                        $ratingTextInput('teamwork')
                                        ->live(onBlur:true),
                        $ratingTextInput('leadership')
                                        ->live(onBlur:true),

                        // The Overall Rating field
                        TextInput::make('overall_rating')
                            ->numeric()
                            ->readOnly()
                            ->required()
                            ->dehydrated()
                            
                            // Calculate the overall rating when the form is initially loaded (hydrated)
                            ->afterStateHydrated(function (callable $set, callable $get) {
                                $set('overall_rating', self::calculateOverall($get));
                            })
                            ->live(onBlur:true),
                    ]),

                Section::make('Feedback and Goals')
                    ->columnSpanFull()
                    ->schema([

                        Textarea::make('strengths')
                            ->columnSpanFull(),

                        Textarea::make('areas_for_improvement')
                            ->columnSpanFull(),

                        Textarea::make('goals')
                            ->columnSpanFull(),

                        Textarea::make('comments')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    /**
     * Calculates the average of the five rating inputs.
     *
     * @param callable $get Filament's get callback function.
     * @return float The rounded average rating.
     */
    private static function calculateOverall(callable $get): float
    {
        $q = (float) ($get('quality_of_work') ?? 0);
        $p = (float) ($get('productivity') ?? 0);
        $c = (float) ($get('communication') ?? 0);
        $t = (float) ($get('teamwork') ?? 0);
        $l = (float) ($get('leadership') ?? 0);

        $ratingsCount = 5;
        $total = $q + $p + $c + $t + $l;
        
        if ($total === 0.0 && ($q === 0.0 && $p === 0.0 && $c === 0.0 && $t === 0.0 && $l === 0.0)) {
            return 0.0;
        }

        return round($total / $ratingsCount, 2);
    }
}