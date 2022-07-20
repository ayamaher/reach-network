<?php

namespace App\Repositories;


use App\Models\Ad;

class AdRepo extends Repository
{
    public function __construct(Ad $model)
    {
        $this->model = $model;
    }

    public function getAdsByFilters(array $filters)
    {
        $query = $this->model;

        if (isset($filters['categories_ids']) && $filters['categories_ids'] != null) {
            $categories_ids = $filters['categories_ids'];
            $query = $query->whereIn('category_id', $categories_ids);
        }

        if (isset($filters['tags_ids']) && $filters['tags_ids'] != null) {
            $tags_ids = $filters['tags_ids'];
            $query->with('tags');

            $query = $query->with('tags')->whereHas('tags', function ($q) use ($tags_ids) {
                $q->whereIn('id', $tags_ids);
            });
        }

        return $query->get()->toArray();
    }

}
