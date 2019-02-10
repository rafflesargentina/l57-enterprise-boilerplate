<?php

namespace Raffles\Modules\Dashboard\Repositories;

use Caffeinated\Repository\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use DB;

class BaseRepository extends EloquentRepository
{
    /**
     * Find all entities.
     *
     * @param array $columns
     * @param array $with
     */
    public function findAll($columns = ['*'], $with = [])
    {
        $cacheKey = $this->generateKey([$columns, $with]);

        return $this->cacheResults(get_called_class(), __FUNCTION__, $cacheKey, function () use ($columns, $with) {
            return $this->model->with($with)
                ->filter()
                ->sort()
                ->get($columns);
        });
    }

    /**
     * Get records count.
     *
     * @return Collection
     */
    public function getCount()
    {
        $dateFormats = $this->dateFormats();
        $cacheKey = $this->generateKey(['count', $dateFormats]);

        return $this->cacheResults(
            get_called_class(), __FUNCTION__, $cacheKey, function () use ($dateFormats) {
                return $this->model
                    ->select(DB::raw('*, count(*) as count, '.$dateFormats))
                    ->get();
            }
        );
    }

    /**
     * Get grouped records count.
     *
     * @return Collection
     */
    public function getGroupedCount($groupBy, $columns = [])
    {
        $dateFormats = $this->dateFormats();
        $cacheKey = $this->generateKey(['groupedCount', $dateFormats, $groupBy, $columns]);

        return $this->cacheResults(
            get_called_class(), __FUNCTION__, $cacheKey, function () use ($dateFormats, $groupBy, $columns) {
                return $this->model
                    ->select(DB::raw('*, count(*) as count, '.$dateFormats))
                    ->groupBy($groupBy)
                    ->filter()
                    ->sort()
                    ->get($columns);
            }
        );
    }

    /**
     * Get only trashed records count.
     *
     * @return Collection
     */
    public function getOnlyTrashedCount()
    {
        $dateFormats = $this->dateFormats();
        $cacheKey = $this->generateKey(['onlyTrashedCount', $dateFormats]);

        return $this->cacheResults(
            get_called_class(), __FUNCTION__, $cacheKey, function () use ($dateFormats) {
                return $this->model
                    ->onlyTrashed()
                    ->select(DB::raw('*, count(*) as count, '.$dateFormats))
                    ->get();
            }
        );
    }

    /**
     * Get grouped records count with trashed.
     *
     * @return Collection
     */
    public function getGroupedCountWithTrashed($groupBy, $columns = [])
    {
        $dateFormats = $this->dateFormats();

        $cacheKey = $this->generateKey(['groupedCountWithTrashed', $dateFormats, $groupBy, $columns]);

        return $this->cacheResults(
            get_called_class(), __FUNCTION__, $cacheKey, function () use ($dateFormats, $groupBy, $columns) {
                return $this->model->withTrashed()
                    ->select(DB::raw('*, count(*) as count, '.$dateFormats))
                    ->groupBy($groupBy)
                    ->filter()
                    ->sort()
                    ->get($columns);
            }
        );
    }

    /**
     * DATE_FORMAT queries.
     *
     * @return string
     */
    protected function dateFormats()
    {
        $createdAtPreset = request()->created_at_preset;
        $deletedAtPreset = request()->deleted_at_preset;
        $updatedAtPreset = request()->updated_at_preset;

        $dateFormats = $createdAtPreset === 'today' ? 'DATE_FORMAT(created_at, "%y-%m-%d %H") as creation_date,' : 'DATE_FORMAT(created_at, "%y-%m-%d") as creation_date,';
        $dateFormats .= $deletedAtPreset === 'today' ? 'DATE_FORMAT(deleted_at, "%y-%m-%d %H") as deletion_date,' : 'DATE_FORMAT(deleted_at, "%y-%m-%d") as deletion_date,';
        $dateFormats .= $updatedAtPreset === 'today' ? 'DATE_FORMAT(updated_at, "%y-%m-%d %H") as updating_date,' : 'DATE_FORMAT(updated_at, "%Y-%m-%d") as updating_date';

        return $dateFormats;
    }
}
