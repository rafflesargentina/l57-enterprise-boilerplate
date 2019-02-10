<?php

namespace Raffles\Modules\Dashboard\Filters;

use Carbon\Carbon;
use RafflesArgentina\FilterableSortable\QueryFilters;

class BaseFilters extends QueryFilters
{
    /**
     * The format of the dates.
     *
     * @var string
     */
    protected $dateFormat = "d-m-Y";

    /**
     * Created After
     *
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function created_after($query)
    {
        $date = Carbon::createFromFormat($this->dateFormat, $query);
        return $this->builder->where('created_at', '>=', $date->toDateString());
    }

    /**
     * Created At Preset
     *
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function created_at_preset($query)
    {
        switch ($query) {
        case "30days":
            return $this->builder->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
                ->where('created_at', '<=', Carbon::now()->endOfDay()->toDateTimeString());
            break;
        case "60days":
            return $this->builder->where('created_at', '>=', Carbon::now()->subDays(60)->toDateTimeString())
                ->where('created_at', '<=', Carbon::now()->endOfDay()->toDateTimeString());
            break;
        case "365days":
            return $this->builder->where('created_at', '>=', Carbon::now()->subDays(365)->toDateTimeString())
                ->where('created_at', '<=', Carbon::now()->endOfDay()->toDateTimeString());
        case "today":
            return $this->builder->where('created_at', '>=', Carbon::now()->startOfDay()->toDateTimeString())
                ->where('created_at', '<=', Carbon::now()->endOfDay()->toDateTimeString());
            break;
        case "thisWeek":
            return $this->builder->where('created_at', '>=', Carbon::now()->startOfWeek()->toDateTimeString())
                ->where('created_at', '<=', Carbon::now()->endOfWeek()->toDateTimeString());
            break;
        case "thisMonth":
            return $this->builder->where('created_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString())
                ->where('created_at', '<=', Carbon::now()->endOfMonth()->toDateTimeString());
            break;
        case "thisQuarter":
            return $this->builder->where('created_at', '>=', Carbon::now()->startOfQuarter()->toDateTimeString())
                ->where('created_at', '<=', Carbon::now()->endOfMonth()->toDateTimeString());
            break;
        case "thisYear":
            return $this->builder->where('created_at', '>=', Carbon::now()->startOfYear()->toDateTimeString())
                ->where('created_at', '<=', Carbon::now()->endOfMonth()->toDateTimeString());
            break;
        }
    }

    /**
     * Created Before
     *
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function created_before($query)
    {
        $date = Carbon::createFromFormat($this->dateFormat, $query);
        return $this->builder->where('created_at', '<=', $date->toDateString());
    }

    /**
     * Deleted After
     *
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function deleted_after($query)
    {
        $date = Carbon::createFromFormat($this->dateFormat, $query);
        return $this->builder->whereNotNull('deleted_at')->where('deleted_at', '>=', $date->toDateString());
    }

    /**
     * Deleted At Preset
     *
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function deleted_at_preset($query)
    {
        switch ($query) {
        case "30days":
            return $this->builder->whereNotNull('deleted_at')->where('deleted_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
                ->where('deleted_at', '<=', Carbon::now()->endOfDay()->toDateTimeString());
            break;
        case "60days":
            return $this->builder->whereNotNull('deleted_at')->where('deleted_at', '>=', Carbon::now()->subDays(60)->toDateTimeString())
                ->where('deleted_at', '<=', Carbon::now()->endOfDay()->toDateTimeString());
            break;
        case "365days":
            return $this->builder->whereNotNull('deleted_at')->where('deleted_at', '>=', Carbon::now()->subDays(365)->toDateTimeString())
                ->where('deleted_at', '<=', Carbon::now()->endOfDay()->toDateTimeString());
        case "today":
            return $this->builder->whereNotNull('deleted_at')->where('deleted_at', '>=', Carbon::now()->startOfDay()->toDateTimeString())
                ->where('deleted_at', '<=', Carbon::now()->endOfDay()->toDateTimeString());
            break;
        case "thisWeek":
            return $this->builder->whereNotNull('deleted_at')->where('deleted_at', '>=', Carbon::now()->startOfWeek()->toDateTimeString())
                ->where('deleted_at', '<=', Carbon::now()->endOfWeek()->toDateTimeString());
            break;
        case "thisMonth":
            return $this->builder->whereNotNull('deleted_at')->where('deleted_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString())
                ->where('deleted_at', '<=', Carbon::now()->endOfMonth()->toDateTimeString());
            break;
        case "thisQuarter":
            return $this->builder->whereNotNull('deleted_at')->where('deleted_at', '>=', Carbon::now()->startOfQuarter()->toDateTimeString())
                ->where('deleted_at', '<=', Carbon::now()->endOfMonth()->toDateTimeString());
            break;
        case "thisYear":
            return $this->builder->whereNotNull('deleted_at')->where('deleted_at', '>=', Carbon::now()->startOfYear()->toDateTimeString())
                ->where('deleted_at', '<=', Carbon::now()->endOfMonth()->toDateTimeString());
            break;
        }
    }

    /**
     * Deleted Before
     *
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function deleted_before($query)
    {
        $date = Carbon::createFromFormat($this->dateFormat, $query);
        return $this->builder->whereNotNull('deleted_at')->where('deleted_at', '<=', $date->toDateString());
    }

    /**
     * Updated After
     *
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function updated_after($query)
    {
        $date = Carbon::createFromFormat($this->dateFormat, $query);
        return $this->builder->where('updated_at', '>=', $date->toDateString());
    }

    /**
     * Updated At Preset
     *
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function updated_at_preset($query)
    {
        switch ($query) {
        case "30days":
            return $this->builder->where('updated_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
                ->where('updated_at', '<=', Carbon::now()->endOfDay()->toDateTimeString());
            break;
        case "60days":
            return $this->builder->where('updated_at', '>=', Carbon::now()->subDays(60)->toDateTimeString())
                ->where('updated_at', '<=', Carbon::now()->endOfDay()->toDateTimeString());
            break;
        case "365days":
            return $this->builder->where('updated_at', '>=', Carbon::now()->subDays(365)->toDateTimeString())
                ->where('updated_at', '<=', Carbon::now()->endOfDay()->toDateTimeString());
        case "today":
            return $this->builder->where('updated_at', '>=', Carbon::now()->startOfDay()->toDateTimeString())
                ->where('updated_at', '<=', Carbon::now()->endOfDay()->toDateTimeString());
            break;
        case "thisWeek":
            return $this->builder->where('updated_at', '>=', Carbon::now()->startOfWeek()->toDateTimeString())
                ->where('updated_at', '<=', Carbon::now()->endOfWeek()->toDateTimeString());
            break;
        case "thisMonth":
            return $this->builder->where('updated_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString())
                ->where('updated_at', '<=', Carbon::now()->endOfMonth()->toDateTimeString());
            break;
        case "thisQuarter":
            return $this->builder->where('updated_at', '>=', Carbon::now()->startOfQuarter()->toDateTimeString())
                ->where('updated_at', '<=', Carbon::now()->endOfMonth()->toDateTimeString());
            break;
        case "thisYear":
            return $this->builder->where('updated_at', '>=', Carbon::now()->startOfYear()->toDateTimeString())
                ->where('updated_at', '<=', Carbon::now()->endOfMonth()->toDateTimeString());
            break;
        }
    }

    /**
     * Updated Before
     *
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function updated_before($query)
    {
        $date = Carbon::createFromFormat($this->dateFormat, $query);
        return $this->builder->where('updated_at', '<=', $date->toDateString());
    }
}
