<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Exception;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGender = Gender::all();
        return view('gender.index')->with(compact('dataGender'));
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
        try {
            Gender::create([
                'gender' => $request['gender']
            ]);
            return redirect(route('gender.index'))->with(['success_store' => 'Gender Berhasil Ditambah']);
        } catch (Exception $e) {
            return redirect(route('gender.index'))->with(['failed_store' => 'Gender Gagal Ditambah']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gender = Gender::findOrFail($id);
        return response()->json([
            'gender' => $gender->gender,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        try {
            Gender::where('id', $id)->update([
                'gender' => $request['gender']
            ]);
            return redirect(route('gender.index'))->with(['success_update' => 'Gender Berhasil Diupdate']);
        } catch (Exception $e) {
            return redirect(route('gender.index'))->with(['failed_update' => 'Gender Gagal Diupdate']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Gender::destroy($id);
            return redirect(route('gender.index'))->with(['success_delete' => 'Gender Berhasil Dihapus']);
        } catch (Exception $e) {
            return redirect(route('gender.index'))->with(['failed_delete' => 'Gender Gagal Dihapus']);
        }
    }
}
