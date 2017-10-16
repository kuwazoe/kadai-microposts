<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Micropost;

class MicropostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $microposts = \Auth::user()->myfavorites()->orderBy('created_at', 'desc')->paginate(10);
        
        return view('microposts.index', [
            'microposts' => $microposts,
        ]);
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
        $this->validate($request, [
            'content' => 'required|max:255',
        ]);
        
        $request->user()->microposts()->create([
            'content' => $request->content,    
        ]);
        
        return redirect('/');
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
        $micropost = Micropost::find($id);
        
        if (\Auth::user()->id === $micropost->user_id) {
            $micropost->delete();
        }
        
        return redirect()->back();
    }

    public function post_followings($id)
    {
        $micropost = Micropost::find($id);
        $post_followings = $micropost->followings()->paginate(10);
        
        $data = [
            'micropost' => $micropost,
            'microposts' => $post_followings,
        ];
        
        $data += $this->counts($micropost);
        
        return view('microposts.followings', $data);
    }
    
    public function post_followers($id)
    {
        $user = User::find($id);
        $post_followers = $user->followers()->paginate(10);
        
        $data = [
            'user' => $user,
            'users' => $followers,
        ];
        
        $data += $this->counts($user);
        
        return view('micropost.followers', $data);
    }
}