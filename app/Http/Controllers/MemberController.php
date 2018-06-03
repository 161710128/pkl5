<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member  = Member::all();
        return view('member.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'foto' => 'required|',
            'alamat' => 'required|',
            'user_id' => 'required'
        ]);
        $member = new Member;
        $member->foto = $request->foto;
        $member->alamat = $request->alamat;
        $member->user_id = $request->user_id;
        $member->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$member->email</b>"
        ]);
        return redirect()->route('member.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        $member = Member::findOrFail($id);
        return view('member.show',compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $member = Member::findOrFail($id);
        $user = User::all();
        $selectedus = Member::findOrFail($id)->user_id;
        return view('member.edit',compact('user','member','selectedus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $this->validate($request,[
            'foto' => 'required|',
            'alamat' => 'required|',
            'user_id' => 'required'
        ]);
        $member = Member::findOrFail($id);
        $member->foto = $request->foto;
        $member->alamat = $request->alamat;
        $member->user_id = $request->user_id;
        $member->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil mengedit <b>$member->email</b>"
        ]);
        return redirect()->route('member.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('member.index');
    }
}
