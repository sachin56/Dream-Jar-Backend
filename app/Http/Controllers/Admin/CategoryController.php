<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\APIResponseMessage;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
   /**
     * Display a listing of the city master data.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.category.list');
    }

    /**
     * Display the form for creating a new city.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created city in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $category = new Category();
            $category->name = $request->name;
            $category->save();

            DB::commit();



            return redirect()->route('category.index')->with('success', APIResponseMessage::CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('category.index')->with('failed', APIResponseMessage::FAIL);
        }
    }

    /**
     * Display the specified city.
     *
     * This method decrypts the provided city ID, retrieves the city
     * details from the database, and returns the view for editing the city.
     *
     * @param string $id The encrypted city ID.
     * @return \Illuminate\View\View The view for editing the city.
     */
    public function show(string $id)
    {
        $categoryId = decrypt($id);
        $category = Category::with([])->find($categoryId);

        return view('admin.category.edit',[
            'category' => $category,
        ]);
    }

    /**
     * Update the specified city in storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function update(Request $request, string $id)
    {
        try {

            DB::beginTransaction();

            $category = Category::find($id);
            $category->name = $request->name;
            $category->save();

            DB::commit();


            return redirect()->route('category.index')->with('success', APIResponseMessage::UPDATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('category.index')->with('error', APIResponseMessage::ERROR_EXCEPTION);
        }
    }

    /**
     * Destroy the specified city.
     *
     * @param string $id The ID of the city to be deleted.
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception If an error occurs during the deletion process.
     *
     * This method performs the following actions:
     * - Begins a database transaction.
     * - Finds the city by ID.
     * - Updates the 'deleted_by' field with the ID of the authenticated user.
     * - Deletes the city.
     * - Commits the transaction.
     * - Dispatches a LoggableEvent to log the deletion.
     * - Redirects to the city index route with a success message.
     *
     * If an exception occurs, the transaction is rolled back, an error is logged,
     * and the user is redirected to the city index route with an error message.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $category = Category::find($id);

            Category::with([])->find($id)->delete();

            DB::commit();


            return redirect()->route('category.index')->with('success', APIResponseMessage::DELETED);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical('Exception in delete Banner : ', [$e->getMessage()]);
            return redirect()->route('category.index')->with('error', APIResponseMessage::ERROR_EXCEPTION);

        }
    }

    /**
     * Retrieve city data for DataTables via AJAX.
     *
     * This method fetches city data from the database, orders it by 'id' in descending order,
     * and returns it in a format suitable for DataTables. It includes additional columns for
     * editing, activation status, and deletion.
     *
     * @return \Illuminate\Http\JsonResponse JSON response containing the city data for DataTables.
     */
    public function getAjaxCategoryData()
    {
        $model = Category::query()->orderBy('name', 'asc');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('name', function ($data) {
                return $data['name'];
            })
            ->addColumn('edit', content: function ($data) {
                $edit_url = route('category.show',encrypt($data->id));
                $btn = '<a href="' . $edit_url . '" class="btn shadow-none btn-primary btn-xs btn-icon rounded-circle waves-effect waves-themed"><i class="fal fa-pen"></i></a>';
                return $btn;
            })
             ->addColumn('delete', function ($data) {
                return view('admin.category.partials._delete', compact('data'));
            })
            ->rawColumns(['edit'])
            ->toJson();
    }
}
