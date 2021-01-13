<?php


namespace App\Http\Controllers\Open;


use App\Http\Controllers\Controller;
use App\Services\OfficialAccountService;
use Illuminate\Http\Request;

class OfficialAccountController extends Controller
{

    /**
     * @param Request $request
     * @param OfficialAccountService $service
     * @return mixed|string
     */
    public function check(Request $request, OfficialAccountService $service)
    {
        $query = $request->query();
        return $service->checkSignature($query['signature'] ?? '', $query['timestamp'] ?? '', $query['nonce'] ?? '') ? $query['echostr'] : '';
    }

    /**
     * @param Request $request
     * @param OfficialAccountService $service
     * @return string
     */
    public function receipt(Request $request, OfficialAccountService $service)
    {
        return $service->receipt($request->getContent());
    }

}
