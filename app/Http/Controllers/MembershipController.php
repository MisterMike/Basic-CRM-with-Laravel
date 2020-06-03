<?php

namespace App\Http\Controllers;

use App\Membership;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class MembershipController extends Controller
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
     * Show memberships list
     *
     * @return Renderable
     */
    public function index()
    {
        $memberships = DB::table('memberships')->paginate(10);

        return view('membership.index', [
            'memberships' => $memberships
        ]);
    }

    /**
     * Show membershi create form
     * @return View
     */
    public function create()
    {
        return view('membership.create');
    }

    /**
     * Store membership
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        //basic validation
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ], [
            'name.required' => trans('A Name is required!'),
            'price.required' => trans('A price is mandatory but can be set to 0')
        ]);

        //get all data from the request
        $data = $request->all();

        //set update data
        $insertData = array(
            'name' => $data['name'],
            'price' => $data['price'],
            'playing_alowed' => $data['playing_alowed']
        );

        //handle logo
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $fileName = time() . '.' . $image->getClientOriginalExtension();

            //make it 200x200
            $img = Image::make($image->getRealPath());
            $img->resize(200, 200);
            $img->stream();

            //save the logo to the storage app/public folder
            $path = Storage::disk('local')->put('public/'.$fileName, $img, 'public');

            //set attribute
            if($path) {
                $insertData['logo'] = $fileName;
            }
        }

        //insert
        $create = DB::table('memberships')->insert($insertData);

        if($create) {
            //return with success
            return redirect('memberships')
                ->with('success', trans('The Membership Type has been successfully created!'));
        } else {
            //return with error
            return redirect('memberships')
                ->with('error', trans('The Membership Type could not be created!'));
        }
    }

    /**
     * Show the form for editing the membership
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $membership = DB::table('memberships')->where('id', $id)->get()->first();

        return view('membership.edit', [
            'membership' => $membership
        ]);
    }

    /**
     * Update the specified membership
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, $id)
    {
        //check if authorized
        $this->authorize('update', Membership::find($id));

        //basic validation
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ], [
            'name.required' => trans('Name is required'),
            'price.required' => trans('A price is mandatory but can be set to 0'),
        ]);

        //get all data from the request
        $data = $request->all();

        //set update data
        //we are not adding logo here as we will process it
        //and add later if it is changed
        $updateData = array(
            'name' => $data['name'],
            'price' => $data['price'],
            'playing_alowed' => $data['playing_alowed']
        );

        //handle logo
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $fileName = time() . '.' . $image->getClientOriginalExtension();

            //process logo
            $img = Image::make($image->getRealPath());
            $img->resize(200, 200);
            $img->stream();

            //save the logo image to the storage
            $path = Storage::disk('local')->put('public/'.$fileName, $img, 'public');

            //set attribute
            if($path) {
                $updateData['logo'] = $fileName;
            }
        }

        //update
        $update = DB::table('memberships')->where('id', $id)->update($updateData);

        if($update) {
            //return with success
            return redirect('memberships')
                ->with('success', trans('The Membership Type has been successfully updated!'));
        } else {
            //return with error
            return redirect('memberships')
                ->with('error', trans('The Membership Type could not be updated!'));
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
        $this->authorize('delete', Membership::find($id));

        //get logo file first
        $logo = DB::table('memberships')->where('id', $id)->get('logo')->first();

        //delete the membership from db
        $delete = DB::table('memberships')->where('id', $id)->delete();

        if($delete) {
            //if membership was deleted then remove the logo file
            Storage::disk('local')->delete('public/' . $logo->logo);

            //return with success
            return redirect()->route('memberships')
                ->with('success', 'The Membership was successfully deleted');

        }  else  {

            //return with error
            return redirect()->route('memberships')
                ->with('error', 'The Membership could not be deleted!');
        }
    }
}
