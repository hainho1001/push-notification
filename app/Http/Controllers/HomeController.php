<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function saveToken(Request $request)
    {
        return response()->json(['token saved successfully.']);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendNotification(Request $request)
    {
        $firebaseToken = 'cmLb6pfO8N3nAaG827NJUi:APA91bFvKxORZAfXCxILULhlEaoRsqOz7ybUy3BuigZFnL8HzSMXG8TgfnKIBp6Iw1Vq6WM6DuNo0ne-x6lGWusdwhBiuE5pZLBoU4KScZHoDfKtqTXYYl0BUwd-5CmnxktDHY6XdlTn';
        $serverKey = 'AAAAQgNwwyo:APA91bGc7djKoInA2ECVswbH085r_MjMx0S-36OQvsKSAUvY_0NbZNdLpZ4xsQUkl-Dm6GiJsVpFxBEZMEmZZBu_4wNjfdQBHxoP8MX6-S7jL8L_lAJuUmaE2UoDXJSN10QcTfuD1aYp';

        $data = [
            "registration_ids" => [ $firebaseToken ],
            "notification" => [
                "title" => '12313123',
                "body" => '12312312312321',
                "content_available" => true,
                "priority" => "high",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        dd($response);
    }
}
