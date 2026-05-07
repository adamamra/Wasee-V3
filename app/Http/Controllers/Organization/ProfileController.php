<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        return view('organization.profile.show', [
            'organization' => auth('organization')->user(),
        ]);
    }

    public function update(Request $request)
    {
        $organization = auth('organization')->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:organizations,email,' . $organization->id],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'current_password' => ['nullable', 'required_with:new_password', 'current_password:organization'],
            'new_password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $organization->fill($request->only('name', 'email', 'phone', 'address'));

        if ($request->filled('new_password')) {
            $organization->password = Hash::make($validated['new_password']);
        }

        $organization->save();

        return back()->with('success', 'تم تحديث بيانات المؤسسة بنجاح');
    }
}
