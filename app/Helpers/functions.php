<?php
/**
 * Created by PhpStorm.
 * User: Amin
 * Date: 03/10/2019
 * Time: 19:09
 */

/**
 * Return contracted api response
 * @param $result
 * @param int $code
 * @param $messages array|string|\Illuminate\Contracts\Support\MessageBag if string passed, it will be convert to array
 * @param bool $success
 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
 * @throws \Exception if messages was'nt array or string
 */
function apiResponse($result, int $code, $messages, bool $success){

    //++ validate messages
    if(is_string($messages))
        $messages = [ $messages ];
    // convert messages bag to simple single column array
    else if($messages instanceof \Illuminate\Contracts\Support\MessageBag){
        $messages = \Illuminate\Support\Arr::flatten($messages->toArray());
    }
    else if(is_null($messages))
        $messages = [];
    else if(!is_array($messages))
        throw new \Exception("Api response messages can't be except of array or string");
    //--

    if (($success and ($code >= 400 and $code <= 499)) OR (!$success and ($code >= 200 and $code <= 299)))
        throw new \Exception('Http response code is not compatible with success value');

    return response([
        'success' => $success,
        'code' => $code,
        'result' => $result,
        'messages' => $messages
    ], $code );
}
