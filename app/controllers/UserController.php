<?php

namespace App\Controllers;

use App\Models\User;
use Leaf\Controller;
use Leaf\Helpers\Password;
use Leaf\Http\Request;
use Leaf\Redis;

class UserController extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->request = new Request;
	}

	public function register()
	{
        $data = [
            'email' => $this->request->get('email'),
            'password' => $this->request->get('password'),
        ];

        $validated = form()->validate($data, [
            'email' => 'email',
            'password' => 'min:8',
        ]);

        if ($validated) {
            $user = new User();
            $user->email = $data['email'];
            $user->password = Password::hash($data['password']);

            if ($user->save()) {
                response()->json([
                    'success' => true,
                    'message' => 'Kullanıcı başarıyla kaydedildi.'
                ]);
            }

            response()->json([
                'success' => false,
                'message' => 'Database kayıt hatası.'
            ]);
        }

        response()->json(
            [
                'success' => false,
                'errors' => form()->errors()
            ]
        );
	}

    /*
     *  User details - Redis cache
     * */
    public function details()
    {
        $key = 'user_1';
        if (Redis::init()->get($key)) {
            response()->json([
                'success' => true,
                'data' => Redis::get($key)
            ]);
        }

        $user = User::find(1);
        Redis::init()->set($key, $user->email);

        response()->json([
            'success' => true,
            'data' => $user->email
        ]);
    }
}