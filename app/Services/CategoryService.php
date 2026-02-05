<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getAll()
    {
        return Category::all();
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function findWithClasses(int $id): Category
    {
        return Category::with('gymClasses')->findOrFail($id);
    }

    public function update(int $id, array $data): Category
    {
        $category = Category::findOrFail($id);
        $category->update($data);

        return $category;
    }

    public function delete(int $id): void
    {
        $category = Category::findOrFail($id);

        if ($category->gymClasses()->exists()) {
            abort(422, 'Cannot delete category with sessions');
        }

        $category->delete();
    }
}