<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class APIRegisterController extends Controller
{
      public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:190',
                    Rule::unique('customers', 'email')->whereNull('deleted_at'), // Exclude soft-deleted users
                ],
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'required|string|min:6',
            ]);
    
            // $verificationCode = random_int(1000, 9999);
    
            // // Send verification email
            // Mail::to($validated['email'])->send(new ApiEmailVerificationMail($verificationCode, $validated['name']));
    
            $imgName = $validated['profile_image']; // Keep the existing profile image
    
            if ($request->hasFile('profile_image')) {
                $imageExtension = $request->profile_image->extension();
                $replace = str_replace(' ', '-', strtolower($validated['name']));
                $replace = str_replace(['cam', "'"], '', $replace);
                $imgName = $replace . '-' . date('m-d-Y_H-i-s') . '-' . uniqid() . '.' . $imageExtension; 
    
                // Upload new image
                try {
                    $uploadUrl = (new StorageHelper('customer', $imgName, $request->profile_image))->uploadImage();
                } catch (\Exception $imageException) {
                    return response()->json([
                        'status' => APIResponseMessage::ERROR_STATUS,
                        'message' => 'Image upload failed',
                    ], 500);
                }
            }

            // Create new customer
            $customer = Customer::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'profile_image' => $imgName,
                'password' => Hash::make($validated['password']),
            ]);
    

            $token = $customer->createToken('authToken')->plainTextToken;
    
            return response()->json([
                'status' => APIResponseMessage::SUCCESS_STATUS,
                'message' => APIResponseMessage::DATAFETCHED,
                'data' => $customer->id,
                'token' => $token,
            ], 200);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::DATAFETCHEDFAILED,
                'errors' => $e->errors(),
            ], 422);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::DATAFETCHEDFAILED,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
