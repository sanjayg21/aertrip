<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Address;
use Validator;
use App\Http\Resources\AddressResource;

class AddressController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::all();
    
        return $this->sendResponse(AddressResource::collection($addresses), 'Addresses retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'user_id' => 'required',
            'line_one' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country'  => 'required',
            'zip_code' => 'numeric'
        ]);
   
        if($validator->fails())
        {
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $addresses = Address::create($input);
   
        return $this->sendResponse(new AddressResource($addresses), 'Address created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = Address::find($id);
  
        if (is_null($department)) 
        {
            return $this->sendError('Address not found.');
        }
   
        return $this->sendResponse(new AddressResource($address), 'Address retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'user_id' => 'required',
            'line_one' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country'  => 'required',
            'zip_code' => 'numeric'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $address->user_id = $input['user_id'];
        $address->line_one = $input['line_one'];
        $address->line_two = $input['line_two'];
        $address->city = $input['city'];
        $address->state = $input['state'];
        $address->country = $input['country'];
        $address->zip_code = $input['zip_code'];
        $address->save();
   
        return $this->sendResponse(new AddressResource($address), 'Address updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();
   
        return $this->sendResponse([], 'Address deleted successfully.');
    }
}
