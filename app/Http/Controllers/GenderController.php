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
        // get data from table gender where visible == true
        $dataGender = Gender::where('visible', true)->get();

        //pass data to view
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
            //check data if exist in db
            $cekAda = Gender::where('visible', true)->where('gender', $request['gender'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('gender.index'))->with(['failed_store' => 'Gender Gagal Ditambah karena sudah terdaftar']);
            }

            //else
            else {
                Gender::create([
                    'gender' => $request['gender'],
                    'visible' => true,
                ]);
                return redirect(route('gender.index'))->with(['success_store' => 'Gender Berhasil Ditambah']);
            }
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
        // get data from table gender where visible == true and id same with paramete
        $gender = Gender::where('visible', true)->findOrFail($id);

        //return in json format
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
            //check data if exist in db
            $cekAda = Gender::where('visible', true)->where('gender', $request['gender'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('gender.index'))->with(['failed_store' => 'Gender Gagal Diupdate karena sudah terdaftar']);
            }

            //else
            else {
                // update from table gender where visible == true and id same with parameter
                Gender::where('visible', true)->where('id', $id)->update([
                    'gender' => $request['gender']
                ]);

                //redirect to index gender
                return redirect(route('gender.index'))->with(['success_update' => 'Gender Berhasil Diupdate']);
            }
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
            //update data to visible false
            Gender::where('visible', true)->where('id', $id)->update([
                'visible' => false
            ]);

            //redirect to index
            return redirect(route('gender.index'))->with(['success_delete' => 'Gender Berhasil Dihapus']);
        } catch (Exception $e) {
            return redirect(route('gender.index'))->with(['failed_delete' => 'Gender Gagal Dihapus']);
        }
    }
}