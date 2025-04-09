<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Models\Owner; 
use App\Models\Chat; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try{
            $chats = Chat::where('customer_id', Auth::user()->customer->id)
                        ->orderby('updated_at','desc')
                        ->get();
            if($chats->count() > 0){
                $firstChat = Chat::where('customer_id', Auth::user()->customer->id)
                            ->orderby('updated_at','desc')
                            ->first();
                if($firstChat){
                    $firstChat->customer_status = 1;
                    $firstChat->save();
                }

                Log::info("User ".Auth::user()->Customer->first_name." ".Auth::user()->Customer->last_name." Berhasil mengakses halaman index chat");

                return view('backend.customer.chat.index', compact('chats','firstChat'));
            }else{
                return redirect()->back()->with('warning', 'Belum pernah melakukan percakapan');
            }      
            
        } 
        catch(\Exception $e){
            return redirect()->back();
        }
    }

    public function index_owner()
    {
        //
        try{
            $chats = Chat::where('owner_id', Auth::user()->owner->id)
                        ->orderby('updated_at','desc')
                        ->get();
            $firstChat = Chat::where('owner_id', Auth::user()->owner->id)
                    ->orderby('updated_at','desc')
                    ->first();
            if($firstChat){
                $firstChat->owner_status = 1;
                $firstChat->save();
            }

            Log::info("User ".Auth::user()->Owner->first_name." ".Auth::user()->Owner->last_name." Berhasil mengakses halaman index chat");
            return view('backend.owner.chat.index', compact('chats','firstChat'));
        } 
        catch(\Exception $e){
            dd($e);
            return redirect()->back()->with('error', __('toast.index.failed.message'));
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
        try{
            if(Auth::user()->thisOwner()){
                $chats = Chat::where('owner_id', Auth::user()->owner->id)
                            ->orderby('updated_at','desc')
                            ->get();
                $firstChat = Chat::find($id);
                if($firstChat){
                    $firstChat->owner_status = 1;
                    $firstChat->save();
                }

                Log::info("User ".Auth::user()->Owner->first_name." ".Auth::user()->Owner->last_name." Berhasil mengakses halaman detail chat");

                return view('backend.owner.chat.index', compact('chats','firstChat'));
            }
            elseif(Auth::user()->thisCustomer()){
                $chats = Chat::where('customer_id', Auth::user()->customer->id)
                            ->orderby('updated_at','desc')
                            ->get();
                $firstChat = Chat::find($id);
                if($firstChat){
                    $firstChat->customer_status = 1;
                    $firstChat->save();
                }

                Log::info("User ".Auth::user()->Customer->first_name." ".Auth::user()->Customer->last_name." Berhasil mengakses halaman detail chat");

                return view('backend.customer.chat.index', compact('chats','firstChat'));
            }
        } 
        catch(\Exception $e){
            dd($e);
            return redirect()->back()->with('error', __('toast.index.failed.message'));
        }
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
