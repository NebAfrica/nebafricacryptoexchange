<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WithdrawalWallet;

class AdminWalletController extends Controller
{
    //index
    public function index()
    {
        $page_title = 'User Wallets';
        $wallets = WithdrawalWallet::orderBy('id', 'DESC')->get();

        return view('admin.wallets.index', compact(
            'page_title',
            'wallets'
        ));
    }

    //view wallet
    public function view(Request $request)
    {
        $page_title = 'Wallet Detail';
        $wallet = WithdrawalWallet::where('id', $request->id)->first();
        if (!$wallet) {
            return redirect(route('admin.wallets.index'))->with('fail', 'The Wallet You are trying to access does not exist');
        }

        return view('admin.wallets.view', compact(
            'page_title',
            'wallet'
        ));
    }

    //Delete Wallet
    public function delete(Request $request)
    {
        $wallet = WithdrawalWallet::where('id', $request->id)->first();
        if (!$wallet) {
            return redirect(route('admin.wallets.index'))->with('fail', 'The Wallet You are trying to delete does not exist');
        }

        $delete = $wallet->delete();
        if ($delete) {
            return redirect(route('admin.wallets.index'))->with('success', 'Wallet deleted successfully');
        } else {
            return redirect(route('admin.wallets.index'))->with('fail', 'Something Went wrong!');
        }
    }
}
