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
            $session->user_id = auth()->user()->id;
            $session->start_time = $request->input('date');
            $session->save();
            return ('Session has started!');
        } else {
            // Tells the user that a session is already running!
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
        $userId = auth()->user()->id;

        $session = DB::table('timetables')
            ->whereNull('stop_time')
            ->where('user_id', $userId) 
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Todo: php artisan make:request and put the validation there and check for validation above in the parameter handle!
        $this->validate($request, [
            'start_time' => 'required'
        ]); 
        
        $start_pause = $request->input('start_pause');
        $stop_pause = $request->input('stop_pause');

        //Todo: fill($request)->all() --> put the fill() method due to shorter code
        $session = new Timetable;
        $session->user_id = auth()->user()->id;
        $session->start_time = $request->input('start_time');
        $session->stop_time = $request->input('stop_time');
        $session->start_pause = $request->input('start_pause');
        $session->stop_pause = $request->input('stop_pause');
        $session->duration_pause = $request->input('duration_pause');
        $session->notes = $request->input('notes');
        $session->save();

        return redirect('/dashboard')->with('success', 'Session has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // check for correct user and show session
        $session = Timetable::where([
            ['user_id', auth()->id()],
            ['id', '=', $id],
        ])->get();
        
        if($session->isEmpty()){
            return redirect('dashboard')->with('error', 'Unauthorized Page!');
        }
        
        $session = $session->first();

        return view('sessions.show')->with('session', $session);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // check for correct user and fetch session
        $session = Timetable::where([
            ['user_id', auth()->id()],
            ['id', '=', $id],
        ])->get();
        
        if($session->isEmpty()){
            return redirect('dashboard')->with('error', 'Unauthorized Page!');
        }
        
        $session = $session->first();
        
        return view('sessions.edit')->with('session', $session);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Todo: php artisan make:request and put the validation there and check for validation above in the parameter handle!
        $this->validate($request, [
            'start_time' => 'required'
        ]); 

        //Todo: fill($request)->all() --> put the fill() method due to shorter code
        //Update Session
        
        $session = Timetable::find($id);
        // $session->fill($request);
        $session->start_time = $request->input('start_time');
        $session->stop_time = $request->input('stop_time');
        $session->start_pause = $request->input('start_pause');
        $session->stop_pause = $request->input('stop_pause');
        $session->duration_pause = $request->input('duration_pause');
        $session->notes = $request->input('notes');
        $session->save();

        return redirect('/dashboard')->with('success', 'Session edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $session = Timetable::find($id);
        
        // check for correct user
        if(auth()->user()->id !== $session->user_id){
            return back()->with('error', 'Unauthorized Page');
        }

        $session->delete();

        return redirect('/dashboard')->with('success', 'Session Deleted');
    }
   
}
