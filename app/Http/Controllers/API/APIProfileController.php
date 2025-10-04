<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class APIProfileController extends Controller
{
    public function show(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => $request->user(),
        ], 200);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // Ensure the email is unique, but ignore the current user's own email
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('customers')->ignore($user->id)],
            // Password is optional, but if present, must be confirmed and at least 8 characters
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        // Update the user's name and email
        $user->name = $request->name;
        $user->email = $request->email;

        // If a new password was provided, hash and update it
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the changes to the database
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully.',
            'data' => $user,
        ], 200);
    }
}
