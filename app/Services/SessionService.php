<?php

namespace App\Services;

use App\Models\Session;

class SessionService
{
    public function getAll()
    {
        return Session::with(['trainer', 'category', 'members'])->get();
    }

    public function getById(Session $session)
    {
        return $session->load(['trainer', 'category', 'members']);
    }

    public function create(array $data)
    {
        return Session::create($data);
    }

    public function update(Session $session, array $data)
    {
        $session->update($data);
        return $session->load(['trainer', 'category', 'members']);
    }

    public function delete(Session $session)
    {
        $session->delete();
    }
}
