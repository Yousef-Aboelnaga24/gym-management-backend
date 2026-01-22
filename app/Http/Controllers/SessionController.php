<?php
namespace App\Http\Controllers;

use App\Http\Requests\Session\StoreSessionRequest;
use App\Http\Requests\Session\UpdateSessionRequest;
use App\Http\Resources\SessionResource;
use App\Models\Session;
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

    public function show(Session $session)
    {
        return new SessionResource($this->service->getById($session));
    }

    public function update(UpdateSessionRequest $request, Session $session)
    {
        $session = $this->service->update($session, $request->validated());
        return new SessionResource($session);
    }

    public function destroy(Session $session)
    {
        $this->service->delete($session);
        return response()->noContent();
    }
}
?>