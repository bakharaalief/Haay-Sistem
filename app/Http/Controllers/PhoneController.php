<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPhone =  Auth::user()->getPhone->where('delete', false);

        return view('telpon-normal.index')
            ->with(compact('dataPhone'));
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
            $cekAda = Auth::user()->getPhone
                ->where('phone', $request['phone_number'])
                ->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('phone.index'))
                    ->with(['failed_store' => 'Nomor Telpon Gagal Ditambah karena sudah terdaftar']);
            }

            //else
            else {
                Phone::create([
                    'user' => Auth::user()->id,
                    'phone' => $request['phone_number'],
                ]);
                return redirect(route('phone.index'))->with(['success_store' => 'Nomor Telpon Berhasil Ditambah']);
            }
        } catch (Exception $e) {
            return redirect(route('phone.index'))->with(['failed_store' => 'Nomor Telpon Gagal Ditambah']);
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
        // get data from table Food Category where delete == false and id same with paramete
        $phone = Phone::where('delete', false)->findOrFail($id);

        //return in json format
        return response()->json([
            'phone' => $phone->phone,
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
            $cekAda = Auth::user()->getPhone
                ->where('phone', $request['phone_number'])
                ->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('phone.index'))
                    ->with(['failed_store' => 'Nomor Telpon Gagal Diupdate karena sudah terdaftar']);
            }

            //else
            else {
                // update from table phone where delete == false and id same with parameter
                Phone::where('delete', false)->where('id', $id)->update([
                    'phone' => $request['phone_number'],
                ]);

                //redirect to index phone
                return redirect(route('phone.index'))->with(['success_update' => 'Nomor Telpon Berhasil Diupdate']);
            }
        } catch (Exception $e) {
            return redirect(route('phone.index'))->with(['failed_update' => 'Nomor Telpon Gagal Diupdate']);
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
            Phone::where('delete', false)->where('id', $id)->update([
                'visible' => false,
                'delete' => true
            ]);

            //redirect to index
            return redirect(route('phone.index'))->with(['success_delete' => 'Nomor Telpon Berhasil Dihapus']);
        } catch (Exception $e) {
            return redirect(route('phone.index'))->with(['failed_delete' => 'Nomor Telpon Gagal Dihapus']);
        }
    }
}
