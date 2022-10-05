<?php

namespace App\Http\Controllers;

use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NumbersController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validateData());

        if ($validate->fails())
            return $this->generateResponse($validate->errors()->first(), 'error');

        DB::beginTransaction();

        try {

            Number::query()->create($this->dumpData($data));

            DB::commit();

            return $this->generateResponse('Number added successfully');

        } catch (\Exception $exception){

            DB::rollback();

            $this->logInfo('number_service', ':: NUMBER CREATING ERROR ::', "{$exception->getMessage()} :: {$exception->getLine()}");

            return $this->generateResponse('Number could not be added. Kindly try again', 'error');

        }
    }

    #======================== ENDPOINT TO FILL FORM FIELDS WITH REQUIRED DATA WHEN EDIT BUTTON IS CLICKED ========================#

    public function preview(Number $number)
    {
        return response()->json([
            'data' => $number,
            'url' => route('numbers.update', $number->id)
        ]);
    }

    public function changeStatus(Number $number)
    {
        DB::beginTransaction();

        try {

            $is_whitelisted = false;

            if ($number->is_whitelist == 1){
                $number->update(['is_whitelist' => 0]);
            }else{
                $number->update(['is_whitelist' => 1]);

                $is_whitelisted = true;
            }

            DB::commit();

            if ($is_whitelisted == false){
                return $this->generateResponse('Number blacklisted successfully');
            }

            return $this->generateResponse('Number whitelisted successfully');

        } catch (\Exception $exception){
            DB::rollback();

            $this->logInfo('number_service', ':: NUMBER STATUS CHANGE ERROR ::', "{$exception->getMessage()} :: {$exception->getLine()}");

            return $this->generateResponse('Number status could not be changed. Kindly try again', 'error');
        }
    }


    #======================== UPDATE NUMBER ========================#

    public function update(Request $request, Number $number)
    {
        $data = $request->all();

        $validate = Validator::make($data, $this->validateData($number->id));

        if ($validate->fails())
            return $this->generateResponse($validate->errors()->first(), 'error');

        DB::beginTransaction();

        try {

            $number->update($this->dumpData($data));

            DB::commit();

            return $this->generateResponse('Number updated successfully');

        } catch (\Exception $exception){

            DB::rollback();

            $this->logInfo('number_service', ':: NUMBER UPDATING ERROR ::', "{$exception->getMessage()} :: {$exception->getLine()}");

            return $this->generateResponse('Number could not be updated. Kindly try again', 'error');

        }
    }

    #======================== DELETE NUMBER ========================#

    public function delete(Number $number)
    {
        DB::beginTransaction();

        try {

            $number->delete();

            DB::commit();

            return $this->generateResponse('Number deleted successfully');

        } catch (\Exception $exception){
            DB::rollback();

            $this->logInfo('number_service', ':: NUMBER DELETING ERROR ::', "{$exception->getMessage()} :: {$exception->getLine()}");

            return $this->generateResponse('Number could not be deleted. Kindly try again', 'error');
        }
    }


    #======================== VALIDATE FORM FIELDS ========================#

    public function validateData($id = null)
    {
        return [
            'number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:18|unique:numbers,number,'.$id,
            'whitelist' => 'required'
        ];
    }

    #======================== PREPARED DB DUMP ========================#

    public function dumpData($data)
    {
        if ($data['whitelist'] === 'yes'){
            $data['is_whitelist'] = true;
        }else{
            $data['is_whitelist'] = false;
        }

        return [
            'number' => $data['number'],
            'is_whitelist' => $data['is_whitelist']
        ];
    }
}
