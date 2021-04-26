<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('device/index');
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
    public function store(Request $request, $organization_id)
    {
        $validator =  Validator::make($request->all(), [
            'deviceToken' => 'required',
            'deviceName' => 'required',
            'deviceLocation' => 'required',
        ]);

        //check if validator fails
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }
        $organization = Organization::find($organization_id);
        if (!$organization) {
            return response()->json([
                'error' => 'Organization Not Exist,make sure you register organization'
            ]);
        }

        $device = new Device();
        $device->device_token = $request->input('deviceToken');
        $device->device_name = $request->input('deviceName');
        $device->device_location = $request->input('deviceLocation');
        if ($organization->devices()->save($device)) {
            $newDevice = Device::find($device->device_token);
            return response()->json([
                'success' => 'success',
                'newDevice' => $newDevice
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $deviceId)
    {
        $validator =  Validator::make($request->all(), [

            'deviceName' => 'required',
            'deviceLocation' => 'required',
        ]);
        //check if validator fails
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }
        $device = Device::find($deviceId);
        if (!$device) {
            return response()->json([
                'error' => 'device Not Exist,make sure you register organization'
            ]);
        }

        $device->update([
            'device_name' => $request->input('deviceName'),
            'device_location' => $request->input('deviceLocation'),
            'organization_id' => $device->organization_id,
            'device_mode' => $device->device_mode,

        ]);
        return response()->json([
            'device' => $device
        ], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        //
    }

    public function showOne($deviceId)
    {
        $device = Device::find($deviceId);
        if (!$device) {
            return response()->json([
                'error' => 'device do not exist'
            ], 404);
        }

        return response()->json([
            'device' => $device
        ], 200);
    }

    public function showAll()
    {
        $devices = Device::all();
        return response()->json([
            'devices' => $devices
        ], 200);
    }

    public function changeMode(Request $request, $deviceId)
    {
        $validator =  Validator::make($request->all(), [
            'device_mode' => 'required',

        ]);
        $device = Device::find($deviceId);
        $device->update([
            'device_mode' => $request->input('device_mode')
        ]);

        return response()->json([
            'success' => 'success',
            'device'=> $device
        ]);
    }
}
