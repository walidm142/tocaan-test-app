<?php
namespace App\Api\V1\Base\Filters;
use Closure;
use Illuminate\Database\Eloquent\Builder;


class StatusFilter
{
    /**
     * Apply filters to the query.
     */
    public function handle($data, Closure $next)
    {
        if (request()->has('status')) {
            $data->where('status', request()->query('status'));
        }

        return $next($data);
    }
}