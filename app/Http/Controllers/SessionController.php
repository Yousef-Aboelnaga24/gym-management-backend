<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Http\Resources\SessionResource;
use App\Services\SessionService;

class SessionController extends Controller
{
    protected $service;

    public function __construct(SessionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return SessionResource::collection($this->service->getAll());
    }

    public function store(StoreSessionRequest $request)
    {
        $session = $this->service->create($request->validated());
        return new SessionResource($session);
    }

    public function show($id)
    {
        return new SessionResource($this->service->getById($id));
    }

    public function update(UpdateSessionRequest $request, $id)
    {
        $session = $this->service->update($id, $request->validated());
        return new SessionResource($session);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->noContent();
    }
}
?>