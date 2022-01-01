<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataAddress =  Auth::user()->getAddress->where('delete', false);

        return view('address-normal.index')
            ->with(compact('dataAddress'));
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
            $cekAda = Auth::user()->getAddress
                ->where('address', $request['address'])
                ->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('address.index'))
                    ->with(['failed_store' => 'Alamat Gagal Ditambah karena sudah terdaftar']);
            }

            //else
            else {
                Address::create([
                    'user' => Auth::user()->id,
                    'address' => $request['address'],
                ]);
                return redirect(route('address.index'))->with(['success_store' => 'Alamat Berhasil Ditambah']);
            }
        } catch (Exception $e) {
            return redirect(route('address.index'))->with(['failed_store' => 'Alamat Gagal Ditambah']);
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
        $address = Address::where('delete', false)->findOrFail($id);

        //return in json format
        return response()->json([
            'address' => $address->address,
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
            $cekAda = Auth::user()->getAddress
                ->where('address', $request['address'])
                ->first();

            //if exist
            if (isset($cekAda)) {
                return redirect(route('address.index'))
                    ->with(['failed_store' => 'Alamat Gagal Diupdate karena sudah terdaftar']);
            }

            //else
            else {
                // update from table address where delete == false and id same with parameter
                Address::where('delete', false)->where('id', $id)->update([
                    'address' => $request['address'],
                ]);

                //redirect to index address
                return redirect(route('address.index'))->with(['success_update' => 'Alamat Berhasil Diupdate']);
            }
        } catch (Exception $e) {
            return redirect(route('address.index'))->with(['failed_update' => 'Alamat Gagal Diupdate']);
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
            Address::where('delete', false)->where('id', $id)->update([
                'visible' => false,
                'delete' => true
            ]);

            //redirect to index
            return redirect(route('address.index'))->with(['success_delete' => 'Alamat Berhasil Dihapus']);
        } catch (Exception $e) {
            return redirect(route('address.index'))->with(['failed_delete' => 'Alamat Gagal Dihapus']);
        }
    }
}
