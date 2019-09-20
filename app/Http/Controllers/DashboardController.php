<?php

namespace App\Http\Controllers;

use App\Services\CriminalService;
use App\Services\InsiderService;
use App\Services\NewsFeedService;
use App\User;
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

            $insider_count = $this->insiderService->getInsidersCount();
            $criminal_count = $this->criminalService->getCriminalsCount();
            $news_feed_count = $this->newsFeedService->getNewsFeedCount();
            $criminal_images_count = $this->criminalService->getTotalCriminalImagesCount();
            $insider_images_count = $this->insiderService->getTotalInsiderImagesCount();
            $user_count = User::all()->count();



            return view('dashboard.admin')->with([
                'insider_count' => $insider_count,
                'criminal_count' => $criminal_count,
                'news_feed_count' => $news_feed_count,
                'user_count' => $user_count,
                'criminal_images_count' => $criminal_images_count,
                'insider_images_count' => $insider_images_count

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
