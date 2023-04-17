<?php

namespace App\Http\Controllers;

//? Library
use Illuminate\Support\Facades\Storage;

//? Models
use App\Models\SystemAuthorities;

class LogRecordingController extends Controller
{



    public function index()
    {
        // user log
        $logFilePath = 'logs/' . date("Y-m-d") . '/User.log';
        $user_log = explode("\n", Storage::get($logFilePath));
        $user_log = array_reverse($user_log); // logların en sonuncusu en üstte gözüksün diye ters çeviriyoruz
        $user_log = array_slice($user_log, 0, 100); // en son 100 satırı alıyoruz

        //istisna log
        $logFilePath = 'logs/' . date("Y-m-d") . '/Exception.log';
        $exception_log = explode("\n", Storage::get($logFilePath));
        $exception_log = array_reverse($exception_log); // logların en sonuncusu en üstte gözüksün diye ters çeviriyoruz
        $exception_log = array_slice($exception_log, 0, 100); // en son 100 satırı alıyoruz

        //ban işlem log
        $logFilePath = 'logs/' . date("Y-m-d") . '/Ban.log';
        $ban_log = explode("\n", Storage::get($logFilePath));
        $ban_log = array_reverse($ban_log); // logların en sonuncusu en üstte gözüksün diye ters çeviriyoruz
        $ban_log = array_slice($ban_log, 0, 100); // en son 100 satırı alıyoruz

        //sistem log
        $logFilePath = 'logs/' . date("Y-m-d") . '/System.log';
        $system_log = explode("\n", Storage::get($logFilePath));
        $system_log = array_reverse($system_log); // logların en sonuncusu en üstte gözüksün diye ters çeviriyoruz
        $system_log = array_slice($system_log, 0, 100); // en son 100 satırı alıyoruz

        //Manager işlem log
        $logFilePath = 'logs/' . date("Y-m-d") . '/Manager.log';
        $manager_log = explode("\n", Storage::get($logFilePath));
        $manager_log = array_reverse($manager_log); // logların en sonuncusu en üstte gözüksün diye ters çeviriyoruz
        $manager_log = array_slice($manager_log, 0, 100); // en son 100 satırı alıyoruz

        $last_login_date = SystemAuthorities::all();


        return view('settings.log-recording', compact('user_log', 'exception_log', 'ban_log', 'system_log', 'manager_log', 'last_login_date'));
    }

    public function createLogs($logText, $logMode)
    {
        $date = date('Y-m-d');
        $fileName = '';

        switch ($logMode) {
            case 'system':
                $fileName = 'System.log';
                break;
            case 'user':
                $fileName = 'User.log';
                break;
            case 'exceptional':
                $fileName = 'Exception.log';
                break;
            case 'manager':
                $fileName = 'Manager.log';
                break;
            case 'ban':
                $fileName = 'Ban.log';
                break;
            case 'login':
                $fileName = 'Login.log';
            default:
                return false;
        }

        if (!Storage::exists("logs/$date")) {
            Storage::makeDirectory("logs/$date");
        }

        $logFilePath = "logs/$date/$fileName";
        if (!Storage::exists($logFilePath)) {
            Storage::append($logFilePath, '');
        }

        Storage::append($logFilePath, $logText);
    }
}
