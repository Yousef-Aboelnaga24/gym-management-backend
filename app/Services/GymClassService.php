<?php

namespace App\Services;

use App\Models\GymClass;

class GymClassService
{
    public function getAll()
    {
        return GymClass::with(['trainer.user', 'category', 'members'])->get();
    }

    public function getById(GymClass $gymClass)
    {
        return $gymClass->load(['trainer.user', 'category', 'members']);
    }

    public function create(array $data)
    {
        return GymClass::create($data);
    }

    public function update(GymClass $gymClass, array $data)
    {
        $gymClass->update($data);
        return $gymClass->load(['trainer.user', 'category', 'members']);
    }

    public function delete(GymClass $gymClass)
    {
        $gymClass->delete();
    }
}
