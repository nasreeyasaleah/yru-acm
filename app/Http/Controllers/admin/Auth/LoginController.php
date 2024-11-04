<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function callbackYRUPassport(Request $request) {
        if ($request->code) {
            $http = new Client();
            $response = $http->post(env('OAUTH_TOKEN_ENDPOINT'), [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'client_id' => env('OAUTH_CLIENT_ID'),
                    'client_secret' => env('OAUTH_CLIENT_SECRET'),
                    'redirect_uri' => env('OAUTH_CLIENT_REDIRECT_URI'),
                    'code' => $request->code,
                ],
            ]);

            $token = json_decode((string)$response->getBody(), true);

            if($user = $this->createOrUpdateUser($token)) {
                if (Auth::loginUsingId($user->id)) {
                    return Redirect('/activities');
                }
            }
        }

        echo 'เข้าสู่ระบบล้มเหลว!';
    }

    /**
     * @throws GuzzleException
     */
    protected function createOrUpdateUser($token): User
    {
        $userInfo = $this->getUserInfo($token['access_token'])['data'];

        // dd($userInfo);

        // ตรวจสอบสถานะบุคลากร *หมายเหตุ กรณีอนุญาติเฉพาะบุคลากรทเ่านั้น
        if ($userInfo['type'] <> 'staff') {
            // abort(403, 'Forbidden!');
        }

        // ตรวจสอบผู้ใช้มีในระบบหรือยัง ?
        /** @var User $user */
        if (!($user = User::query()->where('email', '=', $userInfo['email'])->first())) {
            $user = new User();
        }
        $user->fillFromYRUPassport($userInfo);
        $user->save();

        return $user;
    }

    /**
     * @throws GuzzleException
     */
    protected function getUserInfo($accessToken)
    {
        $http = new Client();
        $response = $http->get(env('OAUTH_USERINFO_ENDPOINT'), [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ],
        ]);
        return json_decode((string)$response->getBody(), true);
    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}

