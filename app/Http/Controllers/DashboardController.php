<?php

namespace App\Http\Controllers;

use App\Services\CriminalService;
use App\Services\InsiderService;
use App\Services\NewsFeedService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    protected $insiderService, $criminalService, $newsFeedService;

    public function __construct(InsiderService $insiderService, CriminalService $criminalService, NewsFeedService $newsFeedService) {
        $this->insiderService = $insiderService;
        $this->criminalService = $criminalService;
        $this->newsFeedService = $newsFeedService;
    }

    public function index() {
        $user = Auth::user();

        if($user->hasRole('Admin')){

            $insiders_count = $this->insiderService->getInsidersCount();
            $criminals_count = $this->criminalService->getCriminalsCount();
            $news_feed_count = $this->insiderService->getNewsFeedCount();

            return view('dashboard.admin')->with([
                'insiders_count' => $insiders_count,
                'criminals_count' => $criminals_count,
                'news_feed_count' => $news_feed_count,
            ]);
        }
//        elseif ($user->hasRole('Staff')) {
//            return view('dashboard.staff')->with(
//                [
//                    'user'=>$user,
//                ]
//            );
//        }elseif ($user->hasRole('Student')){
//            return view('dashboard.student')->with(
//                [
//                    'user' => $user,
//                ]
//            );
//        }
        else{
            abort(404);
        }
    }
}
