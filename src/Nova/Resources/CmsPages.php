<?php

namespace Indianic\CmsPages\Nova\Resources;

use App\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Trin4ik\NovaSwitcher\NovaSwitcher;

class CmsPages extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\Indianic\CmsPages\Models\CmsPages>
     */
    public static string $model = \Indianic\CmsPages\Models\CmsPages::class;

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
        'id','title','slug','sub_title', 'body','meta_keyword', 'meta_description', 'status'
    ];

    /**
     * Return the location to redirect the user after update.
     *
     * @param NovaRequest $request
     * @param  \Laravel\Nova\Resource  $resource
     * @return string
     */

    /**
     * Get the fields displayed by the resource.
     *
     * @param NovaRequest $request
     * @return array
     */

    public function fields(NovaRequest $request)
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
             
            Trix::make('Body'),

            Text::make('Meta Keyword','meta_keyword')
                    ->sortable(),
             
            Textarea::make('Meta Description','meta_description')
                    ->sortable(),  
            
            NovaSwitcher::make('Status'),
        ];
    }

       /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
