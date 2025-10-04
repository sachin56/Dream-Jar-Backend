<?php

namespace App\Http\Controllers\API;

use App\Models\Icon;
use App\Models\Category;
use App\Models\UserGoal;
use Illuminate\Http\Request;
use Google\Service\Analytics\Goal;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class APIGoalController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'name')->get();
        $icons = Icon::select('id', 'icon')->get();

        $data = [
            'categories' => $categories,
            'icons' => $icons,
        ];

        if ($categories->isEmpty() && $icons->isEmpty()) {
            return response()->json([
                'status' => APIResponseMessage::ERROR_STATUS,
                'message' => APIResponseMessage::NODATA,
            ], 200);
        }

        return response()->json([
            'status' => APIResponseMessage::SUCCESS_STATUS,
            'message' => APIResponseMessage::DATAFETCHED,
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $authenticatedUser = auth('sanctum')->user();

        if (!$authenticatedUser) {
            return response()->json([
                'status' => 'false',
                'message' => 'Unauthorized: User not found or token is invalid.',
            ], 401); 
        }

        try {

            DB::beginTransaction(); 
            
            $userGoal = new UserGoal();
            $userGoal->name = $request->name;
            $userGoal->amount = $request->target_amount;
            $userGoal->category_id = $request->category;
            $userGoal->icon_id = $request->icon;
            $userGoal->user_id = $authenticatedUser->id;
            $userGoal->save();

            DB::commit();


            return response()->json([
                'status' => 'true', // Use strings for consistency
                'message' => 'Data saved successfully.',
            ], 201); // 201 Created is better for a successful store operation

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'false',
                'message' => 'Failed to save data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function home()
    {
        $user = auth('sanctum')->user();
        $userGoals = UserGoal::with(['category', 'icon'])
                            ->get();

            if ($userGoals->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'No goals found for this user.',
                    'data' => [
                        'total_savings' => 0,
                        'goal_count' => 0,
                        'goals' => [],
                    ]
                ], 200);
            }

        $formattedGoals = $userGoals->map(function ($goal) {
            if (!$goal->category || !$goal->icon) {
                return null;
            }

            return [
                'id' => $goal->id,
                'name' => $goal->name,
                'target_amount' => $goal->amount,
                'current_amount' => $goal->current_amount,
                'category_name' => $goal->category->name,
                'icon' => $goal->icon->icon,
            ];
        })->filter()->values(); 

        $data = [
            'total_savings' => $userGoals->sum('current_amount'),
            'goal_count' => $formattedGoals->count(), 
            'goals' => $formattedGoals,
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Home screen data fetched successfully.',
            'data' => $data,
        ], 200);
    }

    public function goalDetails(Request $request, $id) // 👈 Accept the ID from the route
    {
        // 1. Find the specific goal by its ID, or fail with a 404 error
        $goal = UserGoal::with(['category', 'icon'])->findOrFail($id);

        // Optional: Check if the authenticated user owns this goal
        // abort_if($goal->user_id !== auth()->id(), 403, 'Unauthorized action.');

        // 2. Format the data for the API response
        $formattedGoal = [
            'id' => $goal->id,
            'name' => $goal->name,
            'target_amount' => $goal->amount,
            'current_amount' => $goal->current_amount,
            'category_name' => $goal->category->name,
            'icon' => $goal->icon->icon,
            'contributions' => $goal->contributions()->latest()->get(), // Get recent contributions
        ];

        // 3. Return the successful response
        return response()->json([
            'status' => 'success',
            'message' => 'Goal details fetched successfully.',
            'data' => $formattedGoal,
        ], 200);
    }

    public function addContribution(Request $request, UserGoal $goal)
    {
        if ($request->user()->id !== $goal->user_id) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $goal->contributions()->create(['amount' => $request->amount]);

        $goal->current_amount += $request->amount;
        $goal->save();

        $goal->refresh();

        return response()->json(['status' => 'success', 'data' => $goal]);
    }


    public function goalDelete(Request $request, UserGoal $goal)
    {
        // 1. Authorize the action
        // Ensure the authenticated user is the one who owns this goal.
        if ($request->user()->id !== $goal->user_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized action.',
            ], 403);
        }

        // 2. Delete the goal
        $goal->delete();

        // 3. Return a clear success message
        return response()->json([
            'status' => 'success',
            'message' => 'Goal deleted successfully.',
        ], 200);
    }




}
