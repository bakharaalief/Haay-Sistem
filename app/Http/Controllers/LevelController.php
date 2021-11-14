<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Exception;
use Facade\FlareClient\View;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data from table level where delete == false
        $dataLevel = Level::where('delete', false)->get();

        //pass data to view
        return View('level.index')->with(compact('dataLevel'));
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
            $cekAda = Level::where('delete', false)->where('level', $request['level'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('level.index'))->with(['failed_store' => 'Level Gagal Ditambah karena sudah terdaftar']);
            }

            //else
            else {
                Level::create([
                    'level' => $request['level'],
                ]);
                return redirect(route('level.index'))->with(['success_store' => 'Level Berhasil Ditambah']);
            }
        } catch (Exception $e) {
            return redirect(route('level.index'))->with(['failed_store' => 'Level Gagal Ditambah']);
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
        // get data from table level where delete == false and id same with paramete
        $level = Level::where('delete', false)->findOrFail($id);

        //return in json format
        return response()->json([
            'level' => $level->level,
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
        try {
            //check data if exist in db
            $cekAda = Level::where('delete', false)->where('level', $request['level'])->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('level.index'))->with(['failed_store' => 'Level Gagal Diupdate karena sudah terdaftar']);
            }

            //else
            else {
                // update from table level where delete == false and id same with parameter
                Level::where('delete', false)->where('id', $id)->update([
                    'level' => $request['level']
                ]);

                //redirect to index level
                return redirect(route('level.index'))->with(['success_update' => 'Level Berhasil Diupdate']);
            }
        } catch (Exception $e) {
            return redirect(route('level.index'))->with(['failed_update' => 'Level Gagal Diupdate']);
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
            //update data to delete false
            Level::where('delete', false)->where('id', $id)->update([
                'visible' => false,
                'delete' => true
            ]);

            //redirect to index
            return redirect(route('level.index'))->with(['success_delete' => 'Level Berhasil Dihapus']);
        } catch (Exception $e) {
            return redirect(route('level.index'))->with(['failed_delete' => 'Level Gagal Dihapus']);
        }
    }
}
