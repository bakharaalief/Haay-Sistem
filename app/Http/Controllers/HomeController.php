<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    //return index for normal user
    public function index()
    {
        return view('home');
    }

    //return index for admin
    public function adminIndex()
    {
        //order data
        $dataOrderAll = Order::where('delete', false)->get();

        //order data berhasil
        $dataOrderSuccess = Order::where('delete', false)
            ->where('order_status', '5')
            ->get();

        //order data gagal
        $dataOrderCanceled = Order::where('delete', false)
            ->where('order_status', '6')
            ->get();

        //data costumer
        $dataCustomer = User::where('delete', false)
            ->where('level', 2)
            ->get();

        //data Order tahun ini
        $dataOrderThisYear = Order::whereBetween('created_at', [
            Carbon::now()->startOfYear(),
            Carbon::now()->endOfYear(),
        ])
            ->get();

        $dataOrderThisYearPerBulan = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($dataOrderThisYear as $dataOrder) {

            //jika ada bulan Jan
            if ($dataOrder->created_at->format('M') == 'Jan') {
                $dataOrderThisYearPerBulan[0] = $dataOrderThisYearPerBulan[0] + 1;
            }

            //jika ada bulan Feb
            else if ($dataOrder->created_at->format('M') == 'Feb') {
                $dataOrderThisYearPerBulan[1] = $dataOrderThisYearPerBulan[1] + 1;
            }

            //jika ada bulan Mar
            else if ($dataOrder->created_at->format('M') == 'Mar') {
                $dataOrderThisYearPerBulan[2] = $dataOrderThisYearPerBulan[2] + 1;
            }

            //jika ada bulan April
            else if ($dataOrder->created_at->format('M') == 'Apr') {
                $dataOrderThisYearPerBulan[3] = $dataOrderThisYearPerBulan[3] + 1;
            }

            //jika ada bulan Mei
            else if ($dataOrder->created_at->format('M') == 'May') {
                $dataOrderThisYearPerBulan[4] = $dataOrderThisYearPerBulan[4] + 1;
            }

            //jika ada bulan Juni
            else if ($dataOrder->created_at->format('M') == 'Jun') {
                $dataOrderThisYearPerBulan[5] = $dataOrderThisYearPerBulan[5] + 1;
            }

            //jika ada bulan Juli
            else if ($dataOrder->created_at->format('M') == 'Jul') {
                $dataOrderThisYearPerBulan[6] = $dataOrderThisYearPerBulan[6] + 1;
            }

            //jika ada bulan agustus
            else if ($dataOrder->created_at->format('M') == 'Aug') {
                $dataOrderThisYearPerBulan[7] = $dataOrderThisYearPerBulan[7] + 1;
            }

            //jika ada bulan sept
            else if ($dataOrder->created_at->format('M') == 'Sep') {
                $dataOrderThisYearPerBulan[8] = $dataOrderThisYearPerBulan[8] + 1;
            }

            //jika ada bulan oktober
            else if ($dataOrder->created_at->format('M') == 'Oct') {
                $dataOrderThisYearPerBulan[9] = $dataOrderThisYearPerBulan[9] + 1;
            }

            //jika ada bulan November
            else if ($dataOrder->created_at->format('M') == 'Nov') {
                $dataOrderThisYearPerBulan[10] = $dataOrderThisYearPerBulan[10] + 1;
            }

            //jika ada bulan Des
            else {
                $dataOrderThisYearPerBulan[11] = $dataOrderThisYearPerBulan[11] + 1;
            }
        }

        //data Order Success tahun ini
        $dataOrderSuccessThisYear = Order::whereBetween('created_at', [
            Carbon::now()->startOfYear(),
            Carbon::now()->endOfYear(),
        ])
            ->where('order_status', '5')
            ->get();

        $dataOrderSuccessThisYearPerBulan = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($dataOrderSuccessThisYear as $dataOrder) {

            //jika ada bulan Jan
            if ($dataOrder->created_at->format('M') == 'Jan') {
                $dataOrderSuccessThisYearPerBulan[0] = $dataOrderSuccessThisYearPerBulan[0] + 1;
            }

            //jika ada bulan Feb
            else if ($dataOrder->created_at->format('M') == 'Feb') {
                $dataOrderSuccessThisYearPerBulan[1] = $dataOrderSuccessThisYearPerBulan[1] + 1;
            }

            //jika ada bulan Mar
            else if ($dataOrder->created_at->format('M') == 'Mar') {
                $dataOrderSuccessThisYearPerBulan[2] = $dataOrderSuccessThisYearPerBulan[2] + 1;
            }

            //jika ada bulan April
            else if ($dataOrder->created_at->format('M') == 'Apr') {
                $dataOrderSuccessThisYearPerBulan[3] = $dataOrderSuccessThisYearPerBulan[3] + 1;
            }

            //jika ada bulan Mei
            else if ($dataOrder->created_at->format('M') == 'May') {
                $dataOrderSuccessThisYearPerBulan[4] = $dataOrderSuccessThisYearPerBulan[4] + 1;
            }

            //jika ada bulan Juni
            else if ($dataOrder->created_at->format('M') == 'Jun') {
                $dataOrderSuccessThisYearPerBulan[5] = $dataOrderSuccessThisYearPerBulan[5] + 1;
            }

            //jika ada bulan Juli
            else if ($dataOrder->created_at->format('M') == 'Jul') {
                $dataOrderSuccessThisYearPerBulan[6] = $dataOrderSuccessThisYearPerBulan[6] + 1;
            }

            //jika ada bulan agustus
            else if ($dataOrder->created_at->format('M') == 'Aug') {
                $dataOrderSuccessThisYearPerBulan[7] = $dataOrderSuccessThisYearPerBulan[7] + 1;
            }

            //jika ada bulan sept
            else if ($dataOrder->created_at->format('M') == 'Sep') {
                $dataOrderSuccessThisYearPerBulan[8] = $dataOrderSuccessThisYearPerBulan[8] + 1;
            }

            //jika ada bulan oktober
            else if ($dataOrder->created_at->format('M') == 'Oct') {
                $dataOrderSuccessThisYearPerBulan[9] = $dataOrderSuccessThisYearPerBulan[9] + 1;
            }

            //jika ada bulan November
            else if ($dataOrder->created_at->format('M') == 'Nov') {
                $dataOrderSuccessThisYearPerBulan[10] = $dataOrderSuccessThisYearPerBulan[10] + 1;
            }

            //jika ada bulan Des
            else {
                $dataOrderSuccessThisYearPerBulan[11] = $dataOrderSuccessThisYearPerBulan[11] + 1;
            }
        }

        //data Order Failed tahun ini
        $dataOrderFailedThisYear = Order::whereBetween('created_at', [
            Carbon::now()->startOfYear(),
            Carbon::now()->endOfYear(),
        ])
            ->where('order_status', '6')
            ->get();

        $dataOrderFailedThisYearPerBulan = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($dataOrderFailedThisYear as $dataOrder) {

            //jika ada bulan Jan
            if ($dataOrder->created_at->format('M') == 'Jan') {
                $dataOrderFailedThisYearPerBulan[0] = $dataOrderFailedThisYearPerBulan[0] + 1;
            }

            //jika ada bulan Feb
            else if ($dataOrder->created_at->format('M') == 'Feb') {
                $dataOrderFailedThisYearPerBulan[1] = $dataOrderFailedThisYearPerBulan[1] + 1;
            }

            //jika ada bulan Mar
            else if ($dataOrder->created_at->format('M') == 'Mar') {
                $dataOrderFailedThisYearPerBulan[2] = $dataOrderFailedThisYearPerBulan[2] + 1;
            }

            //jika ada bulan April
            else if ($dataOrder->created_at->format('M') == 'Apr') {
                $dataOrderFailedThisYearPerBulan[3] = $dataOrderFailedThisYearPerBulan[3] + 1;
            }

            //jika ada bulan Mei
            else if ($dataOrder->created_at->format('M') == 'May') {
                $dataOrderFailedThisYearPerBulann[4] = $dataOrderFailedThisYearPerBulan[4] + 1;
            }

            //jika ada bulan Juni
            else if ($dataOrder->created_at->format('M') == 'Jun') {
                $dataOrderFailedThisYearPerBulan[5] = $dataOrderFailedThisYearPerBulan[5] + 1;
            }

            //jika ada bulan Juli
            else if ($dataOrder->created_at->format('M') == 'Jul') {
                $dataOrderFailedThisYearPerBulan[6] = $dataOrderFailedThisYearPerBulan[6] + 1;
            }

            //jika ada bulan agustus
            else if ($dataOrder->created_at->format('M') == 'Aug') {
                $dataOrderFailedThisYearPerBulan[7] = $dataOrderFailedThisYearPerBulan[7] + 1;
            }

            //jika ada bulan sept
            else if ($dataOrder->created_at->format('M') == 'Sep') {
                $dataOrderFailedThisYearPerBulan[8] = $dataOrderFailedThisYearPerBulan[8] + 1;
            }

            //jika ada bulan oktober
            else if ($dataOrder->created_at->format('M') == 'Oct') {
                $dataOrderFailedThisYearPerBulan[9] = $dataOrderFailedThisYearPerBulan[9] + 1;
            }

            //jika ada bulan November
            else if ($dataOrder->created_at->format('M') == 'Nov') {
                $dataOrderFailedThisYearPerBulan[10] = $dataOrderFailedThisYearPerBulan[10] + 1;
            }

            //jika ada bulan Des
            else {
                $dataOrderFailedThisYearPerBulan[11] = $dataOrderFailedThisYearPerBulan[11] + 1;
            }
        }

        //data pelanggan gender
        $customerLaki = User::where('delete', false)
            ->where('level', 2)
            ->where('gender', 'L')
            ->get();

        $customerPerempuan = User::where('delete', false)
            ->where('level', 2)
            ->where('gender', 'P')
            ->get();

        $customerGender = array(count($customerLaki), count($customerPerempuan));


        return view('admin-home')
            ->with(compact(
                'dataOrderAll',
                'dataOrderSuccess',
                'dataOrderCanceled',
                'dataCustomer',
                'dataOrderThisYearPerBulan',
                'dataOrderSuccessThisYearPerBulan',
                'dataOrderFailedThisYearPerBulan',
                'customerGender',
            ));
    }
}
