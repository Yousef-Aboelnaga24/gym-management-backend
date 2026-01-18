<?php
namespace App\Services;

use App\Models\Session;

class SessionService
{
    public function getAll()
    {
        return Session::with(['trainer', 'category', 'members'])->get();
    }

    public function getById($id)
    {
        return Session::with(['trainer', 'category', 'members'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Session::create($data);
    }

    public function update($id, array $data)
    {
        $session = Session::findOrFail($id);
        $session->update($data);
        return $session;
    }

    public function delete($id)
    {
        $session = Session::findOrFail($id);
        $session->delete();
    }
}

?>