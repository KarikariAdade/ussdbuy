<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NumbersController extends Controller
{

    #=============================== ENDPOINT TO GET NUMBER ============================#
    public function getNumber(Request $request)
    {
        $data = $request->only(['number']);

        $validate = Validator::make($data, ['number' => 'required']);

        if ($validate->fails())
            return $this->generateResponse($validate->errors()->first(), 'error');

        $number = Number::query()->where('number', $data['number'])->first();

        if (!empty($number))
           if($number->is_whitelist == 1){
               return response()->json(['status_code' => 1, 'number' => $number->number, 'message' => 'active']);
           }else{
               return response()->json(['status_code' => 1, 'number' => $number->number, 'message' => 'blocked']);
           }
        else
            return $this->generateResponse('No record with the given number was found', 'error');
    }


    public function getAllNumbers(Request $request)
    {
        $data = $request->only(['type']);

        $validate = Validator::make($data, ['type' => 'required']);

        if ($validate->fails())
            return $this->generateResponse($validate->errors()->first(), 'error');

        if ($data['type'] === 'whitelist'){
            $numbers = Number::query()->where('is_whitelist', true)->select(['number', 'created_at'])->paginate(20);
        }else{
            $numbers = Number::query()->where('is_whitelist', false)->select(['number', 'created_at'])->paginate(20);
        }

        if (!empty($numbers))
            if ($data['type'] === 'whitelist'){
                return response()->json(['status_code' => 1, 'message' => 'active', 'numbers' => $numbers]);
            }else{
                return response()->json(['status_code' => 1, 'message' => 'blocked', 'numbers' => $numbers]);
            }
        else
            return $this->generateResponse('No numbers found with the given parameter', 'error');

    }
}
