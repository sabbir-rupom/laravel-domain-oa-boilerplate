<?php

namespace App\Domains\SimplePage\Http\Controllers;

use App\Domains\Core\Http\Controllers\BaseController;
use App\Domains\SimplePage\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ApiController extends BaseController
{

    public function addform()
    {
        $viewHtml = view('simple_page_view::raw.add')->with([
            'title' => 'Unit Create Form',
            'heads' => Unit::unitHeads(),
        ])->render();

        return $this->response([
            'success' => true,
            'message' => '',
            'html' => true,
            'data' => $viewHtml,
        ]);
    }

    public function search(Request $request)
    {
        $units = Unit::select('name', 'head', 'status', 'code', 'id');

        if ($request->term && strlen($request->term) > 0) {
            $units->where('name', 'like', "%{$request->term}%")->orWhere('code', 'like', "%{$request->term}%");
        }

        $result = Unit::modifyValue(
            $units->orderBy('name', 'asc')->get()
        );

        $viewHtml = view('simple_page_view::raw.list')->with([
            'units' => $result,
            'term' => $request->term,
        ])->render();

        return $this->response([
            'success' => true,
            'message' => '',
            'html' => true,
            'data' => $viewHtml,
        ]);
    }

    public function edit(Unit $unit)
    {
        $viewHtml = view('simple_page_view::raw.edit')->with([
            'unit' => $unit,
            'title' => 'Unit Edit Form',
            'heads' => Unit::unitHeads(),
        ])->render();

        return $this->response([
            'success' => true,
            'message' => '',
            'html' => true,
            'data' => $viewHtml,
        ]);
    }

    public function save(Request $request)
    {
        $validate = $this->_requestValidate($request);
        if ($validate) {
            return $validate;
        }

        if ($request->id && intval($request->id) > 0) {
            $unit = Unit::where('id', intval($request->id))->first();
            if ($unit) {
                $unit->update([
                    'name' => $request->name,
                    'code' => $request->code,
                    'head' => $request->head,
                    'status' => boolval($request->status),
                ]);
            }
        } else {
            $unit = Unit::create([
                'name' => $request->name,
                'code' => $request->code,
                'head' => $request->head,
                'status' => boolval($request->status),
            ]);
        }

        $units = Unit::modifyValue(
            Unit::orderBy('name', 'asc')->get()
        );

        $viewHtml = view('simple_page_view::raw.list')->with(['units' => $units])->render();

        return $this->response([
            'success' => true,
            'message' => 'Unit saved successfully',
            'html' => true,
            'data' => $viewHtml,
        ]);

    }

    public function remove(Unit $unit)
    {
        if (isset($unit->id) && $unit->id > 0) {
            $unit->delete();

            return $this->response([
                'success' => true,
                'message' => 'Unit deleted successfully',
            ]);
        }

        return $this->response([
            'success' => false,
            'message' => 'Unit not found',
        ]);
    }

    /**
     * Form submit data validation
     *
     * @param Request $request
     * @return void
     */
    private function _requestValidate(Request $request)
    {
        $validationRules = [
            'code' => 'required|string|unique:units,code',
            'head' => 'required|integer',
            'name' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return $this->response([
                'message' => $validator->errors()->first(),
            ], Response::HTTP_BAD_REQUEST);

        }

        return false;
    }
}
