<?php
namespace App\Api\V1\Base\Traits;
use Illuminate\Database\Eloquent\Builder;

interface IFiltrable
{
    /**
     * Apply filters to the query.
     */
    public function getPipelineStages();
    /**
     * Get allowed includes.
     */
    public function allowedIncludes();

}