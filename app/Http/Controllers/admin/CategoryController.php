<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100', 'unique:categories,name'],
            'description' => ['nullable', 'string', 'max:500'],
            'icon' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,svg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('category_icons', 'public');
        }

        $maxOrder = Category::max('order') ?? 0;

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $iconPath,
            'is_enabled' => true,
            'order' => $maxOrder + 1,
        ]);

        return response()->json([
            'message' => 'Category added successfully',
            'module' => 'category',
            'data' => $category
        ], 201);
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Category::latest()->get();
            $data = Category::query()->latest();

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('status', function ($row) {
                    $checked = $row->is_enabled ? 'checked' : '';
                    $text    = $row->is_enabled ? 'Enabled' : 'Disabled';
                    $badge   = $row->is_enabled ? 'success' : 'danger';

                    return '
        <div class="d-flex align-items-center gap-2">
            <div class="form-check form-switch mb-0">
                <input class="form-check-input toggle-status"
                       type="checkbox"
                       data-id="' . $row->id . '"
                       ' . $checked . '>
            </div>

            <span class="badge bg-' . $badge . ' status-text">
                ' . $text . '
            </span>
        </div>
      ';
                })


                ->addColumn('icon', function ($row) {

                    return ' <img class="img-thumbnail rounded-circle avatar-sm" alt="image" src="' . $row->getIconUrl() . '">';
                })

                ->addColumn('action', function ($row) {
                    return '
                <div class="dropdown d-inline-block">
                    <button class="btn btn-soft-secondary btn-sm dropdown"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <i class="ri-more-fill align-middle"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>

                            <a href="" class="dropdown-item">
                                <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)"
                               class="dropdown-item edit-item-btn"
                               data-id="' . $row->id . '">
                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)"
                               class="dropdown-item remove-item-btn"
                               data-id="' . $row->id . '">
                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                            </a>
                        </li>
                    </ul>
                </div>
                ';
                })

                ->rawColumns(['status', 'icon', 'action'])
                ->make(true);
        }

        return view('admin.categories');
    }



    public function show(Category $category)
    {
        return response()->json($category);
    }




    public function toggleStatus(Category $category)
    {
        $category->update([
            'is_enabled' => !$category->is_enabled,
        ]);
        $status = $category->is_enabled ? 'enabled' : 'disabled';
        return response()->json([
            'status' => 'success',
            'message' => 'Category "' . $category->name . '" ' . $status . ' successfully.',
            'is_enabled' => $category->is_enabled,
            'text'  => $category->is_enabled ? 'Enabled' : 'Disabled',
            'badge' => $category->is_enabled ? 'success' : 'danger',
        ]);
    }


    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100', 'unique:categories,name,' . $category->id],
            'description' => ['nullable', 'string', 'max:500'],
            'icon' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif,svg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.category.show', $category)
                ->withErrors($validator)
                ->withInput();
        }

        $iconPath = $category->icon;

        if ($request->hasFile('icon')) {
            if ($category->icon && Storage::disk('public')->exists($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }
            $iconPath = $request->file('icon')->store('category_icons', 'public');
        }

        if ($request->has('remove_icon') && $request->remove_icon == '1') {
            if ($category->icon && Storage::disk('public')->exists($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }
            $iconPath = null;
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $iconPath,
            'is_enabled' => $request->has('is_enabled')
                ? $request->boolean('is_enabled')
                : $category->is_enabled,

        ]);
         return response()->json([
            'message' => 'Category updated successfully',
        ], 201);

        // return redirect()->route('admin.categories')
        //     ->with('success', 'Category updated successfully.');
    }


    public function destroy(Category $category)
    {
        // if ($category->hasActiveListings()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Cannot delete category "' . $category->name . '" because it has active listings.'
        //     ], 400);
        // }

        // if ($category->listings()->exists()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Cannot delete category "' . $category->name . '" because it still has listings. Remove all listings first.'
        //     ], 400);
        // }

        if ($category->icon && Storage::disk('public')->exists($category->icon)) {
            Storage::disk('public')->delete($category->icon);
        }

        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully',
        ], 200);
    }
}


// <a href="'.route('admin.category.show', $row->id).'" class="dropdown-item">
