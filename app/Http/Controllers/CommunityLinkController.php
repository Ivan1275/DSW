<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\CommunityLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Act A32
        $links = CommunityLink::where('approved', 1)->paginate(25);
        // Act 35
        $channels = Channel::orderBy('title','asc')->get();
        return view('community/index', compact('links', 'channels'));
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
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'link' => 'required|active_url|unique:community_links',
            'channel_id' => 'required|exists:channels,id'
        ]);

        $approved = /*true*/Auth::user()->trusted ? true : false;
        request()->merge(['user_id' => Auth::id(), 'approved'=>$approved]);
        CommunityLink::create($request->all());

        if($approved == true){
            return back()->with('success','El link se creo correctamente'); //En el caso de que la cuenta este verificada
        } else if ($approved == false) {
            return back()->with('warning','El link se creo correctamente, aparecera un vez la cuenta sea verificada'); //En el caso de que la cuenta NO este verificada
        } else{
            return back()->with('error','Algo que no debia suceder ha ocurrido'); //En el caso algo no ocurra como es debido
        }
        
    }      

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommunityLink $communityLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityLink $communityLink)
    {
        //
    }
}
