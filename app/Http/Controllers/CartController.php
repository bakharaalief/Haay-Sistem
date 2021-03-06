<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderDelivery;
use App\Models\OrderProcessTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //cart data
        $cartData = Cart::where('user', Auth::user()->id)
            ->where('delete', false)
            ->get();

        //orderProcessTime
        $orderProcessTimeData = OrderProcessTime::where('delete', false)->get();

        //nomor telpon user
        $phoneData = Auth::user()->getPhone;

        //alamat user
        $addressData = Auth::user()->getAddress;

        //jenis delivery
        $deliveryData = OrderDelivery::where('delete', false)->get();

        return view('cart.index')->with(
            compact('cartData', 'orderProcessTimeData', 'phoneData', 'addressData', 'deliveryData')
        );
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
            $id = Auth::user()->id;

            Cart::create([
                'user' => $id,
                'food_menu_type' => $request['menu_type'],
                'amount' => $request['menu_amount'],
                'photo_refrensi' => null,
                'notes' => $request['menu_notes']
            ]);

            return Redirect(route('normal.menu'))
                ->with(['success_store' => 'Menu Dimasukkan Ke Keranjang']);
        } catch (Exception $e) {
            return Redirect(route('normal.menu'))
                ->with(['failed_store' => 'Menu Gagal Dimasukkan Ke Keranjang']);
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
        try {
            //update data to delete false
            Cart::where('delete', false)->where('id', $id)->update([
                'delete' => true
            ]);

            return redirect(route('cart.index'))->with(['success_destroy' => 'Berhasil Menghapus Menu']);
        } catch (Exception $e) {
            return redirect(route('cart.index'))->with(['failed_destroy' => 'Gagal Menghapus Menu']);
        }
    }
}
