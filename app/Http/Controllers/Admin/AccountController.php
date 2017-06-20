<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Account;
use Illuminate\Http\Request;
use Session;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
     public function __construct()
     {
         $this->middleware('auth');
     }
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;


          if (!empty($keyword)) {
              $account = Account::where('name', 'LIKE', "%$keyword%")
              ->orWhere('email', 'LIKE', "%$keyword%")
              ->orWhere('password', 'LIKE', "%$keyword%")
              ->orWhere('usertype', 'LIKE', "%$keyword%")
              ->paginate($perPage);
          } else {
              $account = Account::paginate($perPage);
          }
          return view('admin.account.index', compact('account'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();
        Account::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'usertype' => $request['usertype'],
            ]);

        Session::flash('flash_message', 'Account added!');

        return redirect('admin/account');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $account = Account::findOrFail($id);

        return view('admin.account.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $account = Account::findOrFail($id);

        return view('admin.account.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $requestData = $request->all();
        $requestData['password']=bcrypt($requestData['password']);

        $account = Account::findOrFail($id);
        $account->update($requestData);

        Session::flash('flash_message', 'Account updated!');

        return redirect('admin/account');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Account::destroy($id);

        Session::flash('flash_message', 'Account deleted!');

        return redirect('admin/account');
    }
}
