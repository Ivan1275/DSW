<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommunityLinkForm;
use App\Models\Channel;
use App\Models\CommunityLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel = null)
    {
        $channels = Channel::orderBy('title', 'asc')->get();
        if ($channel) {
            $links = $channel->LinksByChannel()->where('approved', true)->latest('community_links.updated_at')->paginate(25);
            $show = 1;
            return view('community/index', compact('links', 'channels', 'show'));
        } else {
            $links = CommunityLink::where('approved', true)->latest('updated_at')->paginate(25);
            $show = 0;
            return view('community/index', compact('links', 'channels', 'show'));
        }
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
    public function store(CommunityLinkForm $request) {
        
        $approved = true/*Auth::user()->trusted ? true : false*/;
        $request->merge(['user_id' => Auth::id(), 'approved'=>$approved]);

        // dump($request);
        // die();
        
        if($approved == true){
            
            $link = new CommunityLink();
            $link->user_id = Auth::id();
            $LinkYaSubido = $link->hasAlreadyBeenSubmitted($request->link);    
            
            if ($LinkYaSubido == true) {
                return back()->with('success', 'El link se actualizado correctamente');
            } else {
                // dd($request->all());
                CommunityLink::create($request->all());
                return back()->with('success', 'El link se creo correctamente');
            }
        } else if ($approved == false) {
            CommunityLink::create($request->all());
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
