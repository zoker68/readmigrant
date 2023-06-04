<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileAvatarUpdateRequest;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Models\Country;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, Country $country): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'country' => $country,
            'countryList' => Country::orderBy('order')->get(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, Country $country): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit',$country->id);
    }

    /**
     * Update the user's profile information.
     */
    public function updateAvatar(ProfileAvatarUpdateRequest $request, Country $country): RedirectResponse
    {
        $data = $request->validated();

        $oldAvatar = auth()->user()->avatar;
        if (strlen($oldAvatar)>0) {
            Storage::delete('public/avatar/' . $oldAvatar);
        }

        $filename = $data['avatar']->store('public/avatar');
        $thumbnail = Image::make( storage_path("app/".$filename) )->orientate();

        $thumbnail->fit(100, 100);
        $thumbnail->save();


        $filename = explode('/',$filename);
        $data['avatar'] = end($filename);


        $request->user()->fill($data);

        $request->user()->save();


        return Redirect::route('profile.edit',$country->id);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
