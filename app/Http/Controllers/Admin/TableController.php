<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Table;
use App\Http\Requests;
use Redirect, Input, Auth;
use App\Http\Controllers\Controller;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.table.index')->withTables(Table::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.table.edit');
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
            'title' => 'required|max:255',
            'uid' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
        ]);
        Table::create([
            'title' => Input::get('title'),
            'uid' => Input::get('uid'),
            'start_time' => strtotime(Input::get('start_time')),
            'end_time' => strtotime(Input::get('end_time')),
            'status' => Input::get('status'),
            'note' => Input::get('note'),
        ]);
        return Redirect('admin/table');
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

        $table = Table::find($id);
        if( Auth::user()->level == 1 ){
            $table->delete();
            return Redirect::to('admin/table');
        }else{
            if($table->user->id == Auth::user()->id){
                $table->delete();
                return Redirect::to('admin/table');
            }else{
                return Redirect('admin/table')
                    ->withErrors(['tips' => '权限不足！',]);;
            }
        }
    }
}
