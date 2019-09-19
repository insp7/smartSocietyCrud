<?php

namespace App\Http\Controllers;

use App\Insider;
use http\Exception; // ext-http is missing in composer.json; include later if required.
use Illuminate\Http\Request;
use App\Services\InsiderService;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class InsiderController extends Controller {

    protected $insiderService;

    public function __construct(InsiderService $insiderService) {
        $this->insiderService = $insiderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('insiders.manage-insiders');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('insiders.add-insider');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email',
            'password' => 'required', // TODO: Later add custom validations for password as required.
            'building_no' => 'required|numeric',
            'block_no' => 'required|numeric',
            'age' => 'required|numeric',
            'gender' => 'required'
        ]);

        try {
            $this->insiderService->store($validatedData, Auth::id());
            return redirect('/admin/insiders')->with([
                'type' => 'success',
                'title' => 'Insider added successfully',
                'message' => 'The given Insider has been added successfully'
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with([
                'type' => 'danger',
                'title' => 'Failed to add the Insider',
                'message' => "There was some issue in adding the Insider"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $insider = $this->insiderService->getInsiderById($id);
        return view('insiders.edit-insider')->with('insider', $insider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|email',
                'building_no' => 'required|numeric',
                'block_no' => 'required|numeric',
                'age' => 'required|numeric',
                'gender' => 'required'
            ]);

            $updateSuccessful = $this->insiderService->update($validatedData, $id);

            if ($updateSuccessful) {
                return redirect('/admin/insiders')->with([
                    'type' => 'success',
                    'title' => 'Insider updated successfully',
                    'message' => 'The given Insider has been updated successfully'
                ]);
            }
        } catch(Exception $exception) {
            error_log('Exception Occured');

            return redirect()->back()->with([
                'type' => 'danger',
                'title' => 'Failed to update the Insider',
                'message' => "There was some issue in updating the Insider"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $this->insiderService->delete($id);
            return redirect()->back()->with([
                'type' => 'success',
                'title' => 'Insider Deleted successfully',
                'message' => 'The given Insider has been deleted successfully'
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with([
                'type' => 'danger',
                'title' => 'Failed To Delete Insider',
                'message' => 'Error in deleting Insider'
            ]);
        }
    }

    public function getInsiders() {
        $insiders = $this->insiderService->getDatatable();

        return DataTables::of($insiders)
            ->addColumn('name', function(\stdClass $user) {
                return $user->name;
            })
            ->addColumn('email', function(\stdClass $user) {
                return $user->email;
            })
            ->addColumn('age', function(\stdClass $user) {
                return $user->age;
            })
            ->addColumn('gender', function(\stdClass $user) {
                return $user->gender;
            })
            ->addColumn('block_no', function(\stdClass $insider) {
                return $insider->block_no;
            })
            ->addColumn('building_no', function (\stdClass $insider) {
                return $insider->building_no;
            })
            ->addColumn('edit', function(\stdClass $insider) {
                return '<button id="' . $insider->id . '" class="edit fa fa-pencil-alt btn-sm btn-warning"></button>';
            })
            ->addColumn('delete', function(\stdClass $insider) {
                return '<button id="' . $insider->id . '" class="delete fa fa-trash btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"></button>';
            })
            ->rawColumns(['edit', 'delete'])
            ->make(true);
    }
}
