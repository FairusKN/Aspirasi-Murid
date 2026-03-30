<?php

namespace App\Http\Controllers;

use App\Service\CategoryRecipientService;
use App\Models\CategoryRecipient;
use App\Http\Requests\Category\RecipientFilterRequest;
use App\Http\Requests\Category\CreateRecipientRequest;

use Illuminate\Support\Facades\Auth;
use App\Enum\UserRole;

class CategoryRecipientController extends Controller
{
    public function __construct(protected CategoryRecipientService $categoryRecipientService) {}
    public function show(RecipientFilterRequest $request)
    {
        return view('web.admin.recipients')
            ->with('data', $this->categoryRecipientService->recipientPaginationQuery($request->validated()));
    }

    public function create(CreateRecipientRequest $request)
    {
        $fields = $request->validated();

        CategoryRecipient::create($fields);
        return back()->with(
            "success",
            __(
                'messages.created',
                [
                    'attribute' => 'recipients'
                ]
            )
        );
    }

    public function activateToggle(CategoryRecipient $recipient)
    {
        // Quick Check
        if (Auth::user()->role !== UserRole::Admin->value) abort(403);

        $isActivated = $this->categoryRecipientService->activateToggle($recipient);

        return back()->with(
            'success',
            __(
                // If return true, user is reactivated because of the fresh/current data
                // else return false, user is deactivated
                $isActivated ? 'messages.reactivated' : 'messages.deactivated',
                ['attribute' => 'recipient']
            )
        );
    }
}
