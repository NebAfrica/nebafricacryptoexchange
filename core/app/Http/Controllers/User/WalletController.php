<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WithdrawalWallet;


class WalletController extends Controller
{
    //add new wallet
    public function new()
    {
        $page_title = 'Add New Withdrawal Wallet';

        return view('themes.' . websiteInfo('theme') . '.user.wallet.new', compact(
            'page_title'
        ));
    }

    //validate new wallete
    public function newValidate(Request $request)
    {
        if (session()->has('wallet_type')) {
            //validate wallet info based on the type
            if (session()->get('wallet_type') == 'crypto') {
                $request->validate([
                    'wallet_address' => 'required',
                    'network_type'  => 'required',

                ]);
                $info = [
                    'wallet_address' => $request->wallet_address,
                    'network_type' => $request->network_type
                ];
            } elseif (session()->get('wallet_type') == 'bank') {
                $request->validate([
                    'bank_name' => 'required',
                    'account_no' => 'required|numeric',
                    'account_name' => 'required',
                ]);

                $info = [
                    'bank_name' => $request->bank_name,
                    'account_no' => $request->account_no,
                    'account_name' => $request->account_name
                ];
            } elseif (session()->get('wallet_type') == 'others') {
                $request->validate([
                    'payment_info' => 'required'
                ]);

                $info = [
                    'payment_info' => $request->payment_info,
                ];
            } else {
                session()->pull('wallet_type');
                return back()->with('fail', 'Invalid Wallet type');
            }

            //save the withdrawal info to the account
            $wallet = new WithdrawalWallet();
            $wallet->name = $request->wallet_name;
            $wallet->type = session()->get('wallet_type');
            $wallet->user_id = user('id');
            $wallet->info = json_encode($info);
            $save_wallet = $wallet->save();

            if ($save_wallet) {
                session()->pull('wallet_type');
                return back()->with('success', 'Wallet Added Successfully');
            } else {
                return back()->with('fail', 'Something went wrong! Try again later');
            }
        } else {
            //vallet the pre-add step
            $request->validate([
                'wallet_type' => 'required',
            ]);

            //save wallet type to session
            session()->put('wallet_type', $request->wallet_type);
            return back();
        }
    }

    //view wallets
    public function index()
    {
        $page_title = 'My Wallets';
        $wallets = WithdrawalWallet::where('user_id', user('id'))->get();

        return view('themes.' . websiteInfo('theme') . '.user.wallet.index', compact(
            'page_title',
            'wallets'
        ));
    }

    //view a single wallet
    public function view(Request $request)
    {
        $wallet = WithdrawalWallet::where('id', $request->route('id'))->first();
        //check if the wallet belongs to the viewing user
        if (!$wallet) {
            return redirect(route('user.wallets.index'))->with('fail', 'not authorised');
        }

        if ($wallet->user_id != user('id')) {
            return redirect(route('user.wallets.index'))->with('fail', 'not authorised');
        }



        $page_title = $wallet->name;
        return view('themes.' . websiteInfo('theme') . '.user.wallet.view', compact(
            'page_title',
            'wallet'
        ));
    }

    //edit wallet
    public function edit(Request $request)
    {
        $wallet = WithdrawalWallet::where('id', $request->route('id'))->first();
        //check if the wallet belongs to the viewing user
        if (!$wallet) {
            return redirect(route('user.wallets.index'))->with('fail', 'not authorised');
        }
        if ($wallet->user_id != user('id')) {
            return redirect(route('user.wallets.index'))->with('fail', 'not authorised');
        }



        $page_title = 'Edit ' . $wallet->name;
        return view('themes.' . websiteInfo('theme') . '.user.wallet.edit', compact(
            'page_title',
            'wallet'
        ));
    }

    //validate wallet edit
    public function editValidate(Request $request)
    {

        $wallet = WithdrawalWallet::where('id', $request->id)->first();
        //check if the wallet belongs to the viewing user
        if ($wallet->user_id != user('id')) {
            return redirect(route('user.wallets.index'))->with('fail', 'not authorised');
        }

        //validate wallet info based on the type
        if ($wallet->type == 'crypto') {
            $request->validate([
                'wallet_address' => 'required',
                'network_type'  => 'required',

            ]);
            $info = [
                'wallet_address' => $request->wallet_address,
                'network_type' => $request->network_type
            ];
        } elseif ($wallet->type == 'bank') {
            $request->validate([
                'bank_name' => 'required',
                'account_no' => 'required|numeric',
                'account_name' => 'required',
            ]);

            $info = [
                'bank_name' => $request->bank_name,
                'account_no' => $request->account_no,
                'account_name' => $request->account_name
            ];
        } elseif ($wallet->type == 'others') {
            $request->validate([
                'payment_info' => 'required'
            ]);

            $info = [
                'payment_info' => $request->payment_info,
            ];
        } else {
            return back()->with('fail', 'Invalid Wallet type');
        }

        //save the withdrawal info to the account
        $update_wallet = WithdrawalWallet::find($wallet->id);
        $update_wallet->name = $request->wallet_name;
        $update_wallet->info = json_encode($info);
        $save_wallet = $update_wallet->save();

        if ($save_wallet) {
            return back()->with('success', 'Wallet Edited Successfully');
        } else {
            return back()->with('fail', 'Something went wrong! Try again later');
        }
    }

    //delete wallet 
    public function delete(Request $request)
    {
        $wallet = WithdrawalWallet::where('id', $request->id)->first();
        //check if the wallet belongs to the viewing user
        if (!$wallet) {
            return redirect(route('user.wallets.index'))->with('fail', 'not authorised');
        }
        if ($wallet->user_id != user('id')) {
            return redirect(route('user.wallets.index'))->with('fail', 'not authorised');
        }

        $delete = $wallet->delete();
        return redirect(route('user.wallets.index'))->with('success', 'Wallet Deleted successfully');
    }

    //cancel
    public function cancel()
    {
        session()->pull('wallet_type');
        return back()->with('success', 'Wallet adding cancelled successfully');
    }
}
