<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NumbersController extends Controller
{
    public function getNumber(Request $request)
    {
        $data = $request->only(['number']);

        $validate = Validator::make($data, ['number' => 'required']);

        if ($validate->fails())
            return $this->generateResponse($validate->errors()->first(), 'error');

        $number = Number::query()->where('number', $data['number'])->first();

        if (!empty($number))
            return $this->generateResponse($number);
        else
            return $this->generateResponse('No record with the given number was found', 'error');
    }


    public function getNumbers(Request $request)
    {
        $data = $request->only(['type']);

        $validate = Validator::make($data, ['type' => 'required']);

        if ($validate->fails())
            return $this->generateResponse($validate->errors()->first(), 'error');

        if ($data['type'] === 'whitelist'){
            $numbers = Number::query()->where('is_whitelist', true)->paginate(20);
        }else{
            $numbers = Number::query()->where('is_whitelist', false)->paginate(20);
        }

        if (!empty($numbers))
            return $this->generateResponse($numbers);
        else
            return $this->generateResponse('No numbers found with the given parameter', 'error');

    }
}
