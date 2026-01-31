<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Service\UserService;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\FilterUserRequest;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function __construct(protected UserService $userService) {}

    /**
     *  Invoke a Student Page with admin-only permission
     *
     *  @param FilterUserRequest $request
     *  @return View
     */
    public function __invoke(FilterUserRequest $request): View
    {
        return view('pages.student')
            ->with('data', $this->userService->userPaginationQuery($request->validated()));
    }

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
