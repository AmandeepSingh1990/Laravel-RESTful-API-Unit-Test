<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Setting;
use \Illuminate\Support\Facades\Request;

class MyHelper
{

    public static function response($message, $data = [], $status = 200, $token = null) {
        $response = [
            'message' => $message,
            'data' => $data,
            'token' => $token
        ];
        return response()->json($response, $status);
    }

    /*
     * Returns the value according to key
     * @param String $key whose value needs to be found
     * */

    public static function settingValue($key){
        $data = Setting::whereName($key)->first();
        return ($data) ? $data->val : false;
    }

    /*
        Compare Dates
    */
    public static function checkStartEndDate($start_date, $end_date) {
        $start_date = Carbon::parse($start_date);
        $end_date = Carbon::parse($end_date);

        if ($start_date->gt($end_date)) {
            return false;
        }
        return true;
    }

    /**
     * Get Day Id From Date
     */
    public static function getDayIdFromDate ($date) {
        return Carbon::parse($date)->dayOfWeek;
    }

}