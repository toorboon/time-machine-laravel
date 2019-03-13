<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Timetable;
use Carbon\Carbon;

class TimetableController extends Controller
{
    /**
     * Set the startDate which is handed in from the request to start the actual session.
     *
     * @return \Illuminate\Http\Response
     */
    public function setStartDate(Request $request)
    {
        // check first, if already a session has started, if so, don't execute the following code!!!
        $checkSession = count(DB::table('timetables')
             ->whereNull('stop_time')
             ->get());

        if($checkSession == 0){
            // Save startDate to database because no session is started yet
            $session = new Timetable;
            $session->start_time = $request->input('date');
            $session->save();
            return ('Session has started!');
        } else {
            // There is already a session started, that cannot be!
            return array('error'=>true, 'message'=>'A sessions is already running! You can only have one active session!');
        }

        // maybe try to keep mysql from inserting a startDate twice with triggers||constraints???
    }

    /**
     * Set the stopDate which is handed in from the request to stop the actual session.
     *
     * @return \Illuminate\Http\Response
     */
    public function setStopDate(Request $request)
    {
        // Save stopDate to database
        $sessionId = $request->get('sessionId');
        $session = Timetable::find($sessionId);
        $session->stop_time = $request->input('date');
        $session->save();

        return ('Session has stopped!');
    }

    /**
     * Set the pauseDate which is handed in from the request to pause the actual session.
     *
     * @return \Illuminate\Http\Response
     */
    public function setPauseDate(Request $request)
    {
        // get the pause status of the running session
        $sessionId = $request->get('sessionId');
        $breakIndicator = filter_var($request->get('breakIndicator'),FILTER_VALIDATE_BOOLEAN);
        $pauseDate = $request->get('date');
        $session = Timetable::find($sessionId);

        if (!$breakIndicator){
            $session->start_pause = $pauseDate;
            $session->stop_pause = null;
            $session->save();
            return ('Pause set!');
        } else {
            $session->stop_pause = $pauseDate;
            // $session->save();
            
            $startPause = Carbon::create($session['start_pause']);
            $pauseDate = Carbon::create($pauseDate);
            $difference = $startPause->diffInSeconds($pauseDate)*1000;
            
            if ($session['duration_pause']){
                $difference = $session['duration_pause'] + $difference;
            }
            
            $session->duration_pause = $difference;
            $session->save();

            return ('Pause stopped!');
        }
    }

    /**
     * Check, if a session is already running.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkSession(Request $request)
    {
        // Session::set('user_id',1);
        // $userId = Session::get('user_id');

        $session = DB::table('timetables')
            ->whereNull('stop_time')
            // ->where('user_id'), $userId) //there is no user_id column yet, so no need to query it!
            ->get();
        
        $countSession = count($session);

        switch ($countSession){
            case 0:
                return array('error'=>true, 'message'=>'No session started yet!');
                break;

            case 1:
                return $session;
                break;

            default:
                return array('error'=>true, 'message'=>'Two sessions started! You can only have one active session!');
        }
    }

   
}
