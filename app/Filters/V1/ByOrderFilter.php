<?php
namespace App\Filters\V1;
use Closure;
use Illuminate\Database\Eloquent\Builder;


class ByOrderFilter
{
    /**
     * Apply filters to the query.
     */
    public function handle($data, Closure $next)
    {
        if (request()->has('order_id')) {
            $data->where('order_id', request()->query('order_id'));
        }

        return $next($data);
    }
}