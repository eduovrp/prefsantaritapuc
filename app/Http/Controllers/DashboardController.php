<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\File;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = DB::table('files')
        ->select(DB::raw('count(year) as count_year, year'))
        ->groupBy('year')
        ->orderBy('year', 'DESC')
        ->take(10)
        ->get();

         foreach($years as $y){
            $yArr[] = $y->year;
            $countY[] = $y->count_year;
        }

        $countY = array_reverse($countY);
        $yArr = array_reverse($yArr);



        $countArch = DB::table('files')->count();
        $countArchYear = File::where('year' , Carbon::today()->year)->count();

        $countUsers = DB::table('users')->count();
        $countUsersMounth = User::whereMonth('created_at' , Carbon::today()->month)->count();

        $countPosts = DB::table('posts')->count();
        $countPostsMonth = Post::whereMonth('created_at' , Carbon::today()->month)->count();

        $countContacts = DB::table('contacts')->count();
        $countContactsUnread = Contact::where('read' , 'no')->count();

        return view ('dashboard', compact('countY', 'yArr', 'countArch', 'countUsers', 'countUsersMounth', 'countArchYear', 'countPosts', 'countPostsMonth', 'countContacts', 'countContactsUnread'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
