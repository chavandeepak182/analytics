<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banners;
use App\Models\Partners;
use App\Models\PlanMaster;
use App\Models\AboutUs;
use App\Models\HowItsWorks;
use App\Models\Testimonials;
use App\Models\Blogs;
use App\Models\FAQ;
use DataTables;
use Storage;
use Crypt;
use Arr;
use Str;
use Session;
use App\Traits\MediaTrait;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banners::where('status', '=', 'active')
            ->orderBy('id', 'DESC')
            ->select('*')
            ->get();
        $partners = Partners::where('status', '=', 'active')->get();
        $aboutus = AboutUs::where('status', '=', 'active')->get();
        $HowItsWorks = HowItsWorks::where('status', '=', 'active')->get();
        $Testimonials = Testimonials::where('status', '=', 'active')->get();
        $Plan = PlanMaster::where('status', '=', 'active')->get();
        $Blog= Blogs::where('status', '=', 'active')->limit(3)->get();
        $Blogcount= Blogs::where('status', '=', 'active')->count();

        
        function time_elapsed_string($date, $full = false)
        {
            $now = new \DateTime('NOW');
            $ago = new \DateTime($date);
            $diff = $now->diff($ago);

            $diff->w = floor($diff->d / 7);
            $diff->d -= $diff->w * 7;

            $string = array(
                'y' => 'year',
                'm' => 'month',
                'w' => 'week',
                'd' => 'day',
                'h' => 'hour',
                'i' => 'minute',
                's' => 'second',
            );
            foreach ($string as $k => &$v) {
                if ($diff->$k) {
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                } else {
                    unset($string[$k]);
                }
            }

            if (!$full) $string = array_slice($string, 0, 1);
            return $string ? implode(', ', $string) . ' ago' : 'Just now';
        }

        foreach ($Blog as $key => $dates) {
            $date = $dates->created_at;
            $times = time_elapsed_string($date, $full = false);
            $Blog[$key]['time'] = $times;
        }
        
        

        $faq= FAQ::where('status', '=', 'active')->get();
            
        // dd($faq);
        

        return view('front.index', compact('banners', 'partners', 'aboutus', 'HowItsWorks', 'Testimonials','Plan','Blog','faq','Blogcount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function ViewBlog($id)
    {
        //
 
     
       $data = str_replace('-', ' ',$id);
       
       
   
           
           $blog =Blogs::where('blog_title','=',$data)->first();
              
           return view('front.blog-details', compact('blog'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function Bloglist()
    {
         $Blog= Blogs::where('status', '=', 'active')->get();
        
        function time_elapsed_string($date, $full = false)
        {
            $now = new \DateTime('NOW');
            $ago = new \DateTime($date);
            $diff = $now->diff($ago);

            $diff->w = floor($diff->d / 7);
            $diff->d -= $diff->w * 7;

            $string = array(
                'y' => 'year',
                'm' => 'month',
                'w' => 'week',
                'd' => 'day',
                'h' => 'hour',
                'i' => 'minute',
                's' => 'second',
            );
            foreach ($string as $k => &$v) {
                if ($diff->$k) {
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                } else {
                    unset($string[$k]);
                }
            }

            if (!$full) $string = array_slice($string, 0, 1);
            return $string ? implode(', ', $string) . ' ago' : 'Just now';
        }

        foreach ($Blog as $key => $dates) {
            $date = $dates->created_at;
            $times = time_elapsed_string($date, $full = false);
            $Blog[$key]['time'] = $times;
        }
        
        return view('front.blog-list', compact('Blog'));
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
