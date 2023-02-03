<?php

namespace Indianic\CMSPages\Nova\Resources;

use App\Nova\Resource;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class CMSPage extends Resource
{
    /**
     * The model the resource corresponds to.
     */
    public static string $model = \Indianic\CMSPages\Models\CMSPage::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'slug', 'sub_title', 'body', 'meta_keyword', 'meta_description', 'status'
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label(): string
    {
        return 'CMS Pages';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Title')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Slug')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Sub Title','sub_title')
                ->sortable(),

            Trix::make('Body')
                ->rules('required', 'max:255'),

            Text::make('Meta Keyword','meta_keyword')
                ->sortable()
                ->rules('required', 'max:255'),

            Textarea::make('Meta Description','meta_description')
                ->sortable(),

            Boolean::make('Status')
            ->default(1),
        ];
    }

       /**
     * Get the cards available for the request.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function cards(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function filters(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param NovaRequest $request
     * @return array
     */
    public function actions(NovaRequest $request): array
    {
        return [];
    }
}
