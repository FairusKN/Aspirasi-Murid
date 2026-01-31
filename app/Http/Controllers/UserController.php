<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\UserService;

use App\Http\Requests\User\CreateUserRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function __construct(protected UserService $userService) {}

    public function create(CreateUserRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());
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

    public function deactivate(User $user): RedirectResponse
    {
        $this->authorize('deactivate', $user);
        $this->userService->deactivateUser($user);

        return back()->with(
            'success',
            __(
                'messages.deactivated',
                [
                    'attribute' => __('models.' . $user->role)
                ]
            )
        );
    }
}
