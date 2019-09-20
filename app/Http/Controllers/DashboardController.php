<?php

namespace App\Http\Controllers;

use App\Services\InsiderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    protected $insiderService;

    public function __construct(InsiderService $insiderService) {
        $this->insiderService = $insiderService;
    }

    public function index() {
        $user = Auth::user();

        if($user->hasRole('Admin')){

            $staff_count=$this->staffService->getStaffGroupByDateOfJoiningInstitute();

            $years = array_keys($staff_count);
            error_log(json_encode($years));
            $counts = array_values($staff_count);
            return view('dashboard.admin')->with([
                'years' => $years,
                'counts' => $counts,
            ]);

        }elseif ($user->hasRole('Staff')){
            return view('dashboard.staff')->with(
                [
                    'user'=>$user,
                ]
            );
        }elseif ($user->hasRole('Student')){
            return view('dashboard.student')->with(
                [
                    'user' => $user,
                ]
            );
        }else{
            abort(404);
        }
    }
}
