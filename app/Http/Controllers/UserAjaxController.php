<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\User;

use Validator;
use Response;
class UserAjaxController extends Controller
{

	public function manageUserAjax()
    {
        return view('manage-user-ajax');
    }


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {


        $users = User::latest()->paginate(5);

        return response()->json($users);

    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)
    {


    // 	$rules = array (
    //         'name' => 'required'
    // );
    // $validator = Validator::make ( Input::all (), $rules );
    // if ($validator->fails ())
    // return Response::json ( array (
                
    //         'errors' => $validator->getMessageBag ()->toArray ()
    // ) );
    // else {
    //     $data = new Data ();
    //     $data->name = $request->name;
    //     $data->save ();
    //     return response ()->json ( $data );
    // }

    	$validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'birth_date' => 'required',
            'email' => ['required','email'],
            'password' => 'required',
            'role' => 'required'
        ]);

    	

    	if ($validator->fails())
        {
            return Response::json ( array (
                
            	'errors' => $validator->getMessageBag ()->toArray ()
    		) );

           
        }
        else {

	    	$request['password'] = bcrypt($request['password']);

	        $create = User::create($request->all());

	        return response()->json($create);
	    }
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

        $edit = User::find($id)->update($request->all());

        return response()->json($edit);

    }


    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        User::find($id)->delete();

        return response()->json(['done']);

    }
    
}
