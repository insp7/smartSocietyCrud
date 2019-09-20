<?php

namespace App\Http\Controllers;

use App\Constants\FileConstants;
use App\Criminal;
use App\Services\CriminalService;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CriminalController extends Controller {

    protected $criminalService;

    public function __construct(CriminalService $criminalService) {
        $this->criminalService = $criminalService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('criminals.manage-criminals');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('criminals.add-criminal');
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
            'age' => 'required|numeric',
            'gender' => 'required|in:M,F,O',
            'crime_type' => 'required',
            'criminal_images' => 'sometimes|required',
            'criminal_images.*' =>'sometimes|mimes:jpeg,png,bmp,tiff'
        ]);

        $image_relative_paths = [];
        $user_id = Auth::id();

        if($request->hasfile('criminal_images')) {
            $i = 0;

            foreach($request->file('criminal_images') as $criminal_image) {

                // The file name of the attachment
                $fileName = $user_id . '_' . $i++ . '_' . time() . '.' . $criminal_image->getClientOriginalExtension();

                // exact path on the current machine
                $destinationPath = public_path(FileConstants::DATASET_ATTACHMENTS_PATH);
                $destinationPath .= $user_id . '/';

                // Moving the image
                $criminal_image->move($destinationPath, $fileName);

                // The relative path to the image
                $image_relative_paths[] = FileConstants::DATASET_ATTACHMENTS_PATH . $user_id . '/' . $fileName;
            }
        }

        try {
            $this->criminalService->store($validatedData, $image_relative_paths, Auth::id());
            return redirect('/admin/criminals')->with([
                'type' => 'success',
                'title' => 'Criminal added successfully',
                'message' => 'The given Criminal has been added successfully'
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with([
                'type' => 'danger',
                'title' => 'Failed to add the Criminal',
                'message' => "There was some issue in adding the Criminal"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Criminal  $criminal
     * @return \Illuminate\Http\Response
     */
    public function show(Criminal $criminal) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Criminal  $criminal
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $criminal = $this->criminalService->getCriminalById($id);
        return view('criminals.edit-criminal')->with('criminal', $criminal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Criminal  $criminal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:100',
                'age' => 'required|numeric',
                'gender' => 'required|in:M,F,O',
                'crime_type' => 'required'
            ]);

            $updateSuccessful = $this->criminalService->update($validatedData, $id);

            if ($updateSuccessful) {
                return redirect('/admin/criminals')->with([
                    'type' => 'success',
                    'title' => 'Criminals updated successfully',
                    'message' => 'The given Insider has been updated successfully'
                ]);
            }
        } catch(\Exception $exception) {
            error_log('Exception Occured');

            return redirect()->back()->with([
                'type' => 'danger',
                'title' => 'Failed to update the Criminal',
                'message' => "There was some issue in updating the Criminal"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Criminal  $criminal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $this->criminalService->delete($id);

            return redirect()->back()->with([
                'type' => 'success',
                'title' => 'Criminal Deleted successfully',
                'message' => 'The given Criminal has been deleted successfully'
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with([
                'type' => 'danger',
                'title' => 'Failed To Delete Criminal',
                'message' => 'Error in deleting Criminal'
            ]);
        }
    }

    public function getImagesForCriminals(Request $request) {
        $criminal_id = $request->id;
        $criminal_images_path = $this->criminalService->getImagesPath($criminal_id);
        $hostName = $request->getHttpHost();

        return view('criminals.criminal-images')
            ->with('criminal_images_path', $criminal_images_path)
            ->with('hostName', $hostName);
    }

    public function getCriminals() {
        $criminals = $this->criminalService->getDatatable();

        return DataTables::of($criminals)
            ->addColumn('name', function(\stdClass $user) {
                return $user->name;
            })
            ->addColumn('email', function(\stdClass $criminal) {
                return $criminal->crime_type;
            })
            ->addColumn('block_no', function(\stdClass $user) {
                return $user->age;
            })
            ->addColumn('building_no', function (\stdClass $user) {
                return $user->gender;
            })
            ->addColumn('view_criminal_images', function(\stdClass $criminal) {
                return '<button id="' . $criminal->id . '" class="view-criminal-images fa fa-street-view btn-sm btn-info"></button>';
            })
            ->addColumn('edit', function(\stdClass $criminal) {
                return '<button id="' . $criminal->id . '" class="edit fa fa-pencil-alt btn-sm btn-warning"></button>';
            })
            ->addColumn('delete', function(\stdClass $criminal) {
                return '<button id="' . $criminal->id . '" class="delete fa fa-trash btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"></button>';
            })
            ->rawColumns(['view_criminal_images', 'edit', 'delete'])
            ->make(true);
    }
}
