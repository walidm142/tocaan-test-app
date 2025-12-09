<?php
namespace App\Traits\V1;
use Illuminate\Database\Eloquent\Builder;

interface IFiltrable
{
    /**
     * Apply filters to the query.
     */
    public function getPipelineStages();

}