<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\UserService;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\FilterUserRequest;
use App\Http\Requests\User\CreateUserFromFileRequest;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function __construct(protected UserService $userService) {}

    public function show(FilterUserRequest $request): View
    {
        return view('web.admin.students')
            ->with('data', $this->userService->userPaginationQuery($request->validated()));
    }

    public function create(CreateUserRequest $request): RedirectResponse
    {
        $fields = $request->validated();
        $this->authorize('create', $this->userService->makeUserModel($fields));

        $user = $this->userService->createUser($fields);
        return back()->with(
            "success",
            __(
                'messages.created',
                [
                    'attribute' => __('models.' . $user->role)
                ]
            )
        );
    }

    public function createFromFile(CreateUserFromFileRequest $request): RedirectResponse
    {
        $fields = $request->validated();
        $this->userService->createUsersFromExcel($fields['file']);

        return back()->with(
            "success",
            __(
                'messages.created',
                [
                    'attribute' => __('models.student')
                ]
            )
        );
    }

    public function activateToggle(User $user): RedirectResponse
    {
        $this->authorize('canActivateToggle', $user);
        $isActivated = $this->userService->activateToggle($user);

        return back()->with(
            'success',
            __(
                // If return true, user is reactivated because of the fresh/current data
                // else return false, user is deactivated
                $isActivated ? 'messages.reactivated' : 'messages.deactivated',
                ['attribute' => __('models.' . $user->role)]
            )
        );
    }
}
