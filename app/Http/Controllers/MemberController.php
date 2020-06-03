<?php

namespace App\Http\Controllers;

use App\Member;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Gate;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show employees list
     *
     * @return Renderable
     */
    public function index()
    {
        $members = Member::with(['membership' => function($query){
            $query->select(['id', 'name']);
        }])->paginate(10);

        return view('member.index', [
            'members' => $members
        ]);
    }

    /**
     * Show employee create form
     * @return View
     */
    public function create()
    {
        //get memberships for create form
        $memberships = DB::table('memberships')->get();

        //show the view
        return view('employee.create', [
            'memberships' => $memberships
        ]);
    }

    /**
     * Store employee
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Request $request, User $user)
    {
        //user memberships
        $userMemberships = Auth::user()->memberships()->pluck('memberships.id');

        if(Auth::user()->hasRole('Manager') && !$userMemberships->contains($request->get('membership_id'))) {
            return redirect('members')
                ->with('error', trans('You do not have permission to create a member for this membership!'));
        }

        //basic validation
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'membership_id' => 'required',
            'email' => 'email'
        ], [
            'first_name.required' => trans('First name is required!'),
            'last_name.required' => trans('Last name is required!'),
            'membership_id.required' => trans('You should select a membership for this member'),
            'email.email' => trans('E-mail address is not a valid one!')
        ]);

        //get all data from the request
        $data = $request->all();

        //set update data
        $insertData = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'membership_id' => $data['membership_id']
        );

        //insert
        $create = DB::table('members')->insert($insertData);

        if($create) {
            //return with success
            return redirect('members')
                ->with('success', trans('The member has been successfully created!'));
        } else {
            //return with error
            return redirect('members')
                ->with('error', trans('The member could not be created!'));
        }
    }

    /**
     * Show the form for editing the employee
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        //get memberships to create form
        $memberships = DB::table('memberships')->get();

        //get the employee info
        $member = DB::table('members')->where('id', $id)->get()->first();

        return view('member.edit', [
            'member' => $member,
            'memberships' => $memberships
        ]);
    }

    /**
     * Update the specified employee
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, $id)
    {
        //check if authorized
        $this->authorize('update', Member::find($id));

        //basic validation
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email'
        ], [
            'first_name.required' => trans('First name is required!'),
            'last_name.required' => trans('Last name is required!'),
            'email.email' => trans('E-mail address is not a valid one!')
        ]);

        //get all data from the request
        $data = $request->all();

        //set update data
        $updateData = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'membership_id' => $data['membership_id']
        );

        //update
        $update = DB::table('members')->where('id', $id)->update($updateData);

        if($update) {
            //return with success
            return redirect('members')
                ->with('success', trans('The Member has been successfully updated!'));
        } else {
            //return with error
            return redirect('members')
                ->with('error', trans('The Member could not be updated!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy($id)
    {
        //check if authorized
        $this->authorize('delete', Member::find($id));

        //delete the employee from db
        $delete = DB::table('members')->where('id', $id)->delete();

        if($delete) {
            //return with success
            return redirect()->route('members')
                ->with('success', 'The Member deleted successfully!');
        }  else  {
            //return with error
            return redirect()->route('members')
                ->with('error', 'The Member could not be deleted!');
        }
    }
}
