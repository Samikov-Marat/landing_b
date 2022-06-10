<?php

namespace App\Classes\Admin;

use Illuminate\Support\Collection;

class SupportCategoryTree
{
    private $categories;
    private $tree;

    public function __construct(Collection $categories)
    {
        $this->categories = $categories;
    }

    public static function getInstance($categories): self
    {
        return new static($categories);
    }

    public function getTree($parent_id = null)
    {
        $this->tree = $this->getBranch($parent_id);
        return $this->tree;
    }

    private function getBranch($parent_id = null, $level = 0): Collection
    {
        if ($level > 16) {
            abort(500);
        }
        $children = collect();
        foreach ($this->categories as $category) {
            if ($parent_id == $category->parent_id) {
                $category->subCategories = $this->getBranch($category->id, $level + 1);
                $children[] = $category;
            }
        }
        return $children;
    }

    public function getBranchIdsFlat($parent_id = null): Collection
    {
        $ids = collect();
        if (isset($parent_id)) {
            $ids[] = $parent_id;
        }

        $ids = $ids->merge($this->getBranchIdsFlatChildren($parent_id)->toArray());

        return $ids;
    }

    private function getBranchIdsFlatChildren($parent_id = null, $level = 0): Collection
    {
        if ($level > 16) {
            abort(500);
        }
        $ids = collect();
        foreach ($this->categories as $category) {
            if ($parent_id == $category->parent_id) {
                $ids[] = $category->id;
                $ids = $ids->merge($this->getBranchIdsFlatChildren($category->id, $level + 1));
            }
        }
        return $ids;
    }

    public function getPath($id, $level = 0): Collection
    {
        if ($level > 16) {
            abort(500);
        }

        if(is_null($id)){
            return collect();
        }

        foreach ($this->categories as $category) {
            if ($id == $category->id) {
                $path = $this->getPath($category->parent_id);
                $path[] = $category;
            }
        }
        return $path;
    }


}
