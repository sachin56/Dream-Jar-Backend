<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helpers\StorageHelper;
use App\Helpers\APIResponseMessage;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class APILoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'nullable|email',
                'password' => 'required|string',
            ]);
        
            $user = Customer::where(function ($query) use ($request) {
                if ($request->has('email')) {
                    $email = $request->email;            
                    $query->where('email', $email);
                }
            })->orWhere(function ($query) use ($request) {
                if ($request->has('email')) {
                    $email = $request->email;            
                    $query->whereRaw('LOWER(email) = ?', [strtolower($email)]);
                }
            })->first();
            
            if (!$user) {
                return response()->json([
                    'status' => APIResponseMessage::ERROR_STATUS,
                    'message' => APIResponseMessage::DATAFETCHEDFAILED,
                    'error' => [
                        'message' => 'User not found. Please check your credentials.'
                    ],
                ], 401);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => APIResponseMessage::ERROR_STATUS,
                    'message' => APIResponseMessage::DATAFETCHEDFAILED,
                    'error' => [
                        'message' => 'Incorrect credentials. Please try again.'
                    ],
                ], 401);
            }
            
            $token = $user->createToken('authToken')->plainTextToken;


            if(isset($user->profile_image)){
                $user->profileImageUrl = (new StorageHelper('customer', $user->profile_image))->getUrl();  
            }else{
                $user->profileImageUrl = null;
            }

            $customer = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'profile_image' => $user->profileImageUrl,
            ];

            return response()->json([
                'status' => APIResponseMessage::SUCCESS_STATUS,
                'message' => APIResponseMessage::DATAFETCHED,
                'token' => $token,
                'customer' => $customer,
            ], 200);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::DATAFETCHEDFAILED,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Unexpected error', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::DATAFETCHEDFAILED,
                'error' => $e->getMessage(),
            ], 500);
        }
    }    

    public function logout(Request $request)
    {
        $user = $request->user();
    
        $user->tokens->each(function ($token) {
            $token->delete();
        });
    
        $user->save();
    
        return response()->json([
            'status' => APIResponseMessage::SUCCESS_STATUS,
            'message' => 'User logged out successfully.'
        ]);
    }
}
