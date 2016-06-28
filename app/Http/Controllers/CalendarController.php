<?php

namespace App\Http\Controllers;

use App\Event;
use App\Patient;
use DateTime;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('webapp-layouts.calendar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('webapp-layouts.calendar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validation
        $this->validate($request, [
            'title' => 'required|min:5|max:20',
            'content' => 'required|min:5|max:100',
            'time' => 'required',
        ]);

        $inputs = $request->all();

        $time = explode(" - ", $request->input('time'));

        $inputs['start_time'] = $this->change_date_format($time[0]);
        $inputs['end_time'] = $this->change_date_format($time[1]);

        Event::create($inputs);

        Session::flash('created_event', 'The event was successfully created!');

        return redirect('admin/calendar');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('admin/calendar');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $event = Event::findOrFail($id);

        $event->start_time =  $this->change_date_format_fullcalendar($event->start_time);
        
        $event->end_time =  $this->change_date_format_fullcalendar($event->end_time);
        
        return view('webapp-layouts.calendar.edit', compact('event'));
        
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
        return redirect('admin/calendar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $event = Event::findOrFail($id);

        $deleted = $event->delete();

        if ($deleted)
            Session::flash('deleted_event', 'The event was successfully deleted!');

        return redirect('admin/calendar');

    }

    public function allEventsAjax(Request $request) {

        $events = DB::table('events')->select('id', 'id_patient', 'title', 'content', 'backgroundColor', 'start_time as start', 'end_time as end')->get();
        foreach($events as $event)
        {

            $event->titleModal = $event->title;
            $event->contentModal = $event->content;

            /**
             * IMPORTANT: THIS IS NOT A ELOQUENT OBJECT, DOESNT HAVE THE ABILITY
             * TO GET THE FIELDS FROM RELATIONSHIP
             * FOR EXAMPLE
             *
             * $event->first_name = $event->patient->first_name;
             *
             * DOESNT WORK
             */
            $event->first_name = Patient::findOrFail($event->id_patient)->first_name;
            $event->last_name = Patient::findOrFail($event->id_patient)->last_name;

            $event->title = $event->title . ' - ' .$event->content;

        }

        return $events;
    }

    public function updateEventAjax(Request $request) {

        // Validation
        $this->validate($request, [
            'title'	=> 'required',
            'content' => 'required',
            'time'	=> 'required'
        ]);

        $inputs = $request->all();

        /**
         * We delete the event and create/save the new one
         * because of problems updating the old one
         * */
        $event = Event::findOrFail($inputs['id']);
        $event->delete();

        $time = explode(" - ", $request->input('time'));

        $inputs['start_time'] = $this->change_date_format($time[0]);
        $inputs['end_time'] = $this->change_date_format($time[1]);

        //$updated = $event->update($inputs);

     // $event->id = $inputs['id'];
        $event->id_patient = $inputs['id_patient'];
        $event->title = $inputs['title'];
        $event->content = $inputs['content'];
        $event->start_time = $inputs['start_time'];
        $event->end_time = $inputs['end_time'];

        $event->save();

        Session::flash('updated_event', 'The event was successfully updated!');

        return response()->json(['message'=>'The event has been updated.', 'newName'=>$event->name], 200);

    }

    public function deleteEventAjax(Request $request) {

        $inputs = $request->all();

        $event = Event::findOrFail($inputs['id']);

        $deleted = $event->delete();

        if ($deleted)
            Session::flash('deleted_event', 'The event was successfully deleted!');

        if ($deleted)
            return response()->json(['message' => 'The event has been deleted.', 'newName' => $event->name], 200);
        else
            return response()->json(['message' => 'The event has not been deleted.'], 401);
    }

    public function createEventAjax(Request $request) {

        // Validation
        $this->validate($request, [
            'id_patient' => 'required',
            'title' => 'required',
            'content' => 'required',
            'time' => 'required'
        ]);

        $colors = ['#f16932', '#eb7f33', '#83adb5', '#006666', '#ff7d7d', '#ddb435'];

        $inputs = $request->all();

        $time = explode(" - ", $request->input('time'));

        $inputs['start_time'] = $this->change_date_format($time[0]);
        $inputs['end_time'] = $this->change_date_format($time[1]);
        $inputs['backgroundColor'] = $colors[ random_int( 0, 5) ];


        Event::create($inputs);

        Session::flash('created_event', 'The event was successfully created!');

        return response()->json(['message' => 'The event has been created.', 'newName' => 'New event created'], 200);
    }


    public function change_date_format($date)
    {
        $time = DateTime::createFromFormat('d/m/Y H:i:s', $date);
        return $time->format('Y-m-d H:i:s');
    }

    public function change_date_format_fullcalendar($date)
    {
        $time = DateTime::createFromFormat('Y-m-d H:i:s', $date);
        return $time->format('d/m/Y H:i:s');
    }

    public function format_interval(\DateInterval $interval)
    {
        $result = "";
        if ($interval->y) { $result .= $interval->format("%y year(s) "); }
        if ($interval->m) { $result .= $interval->format("%m month(s) "); }
        if ($interval->d) { $result .= $interval->format("%d day(s) "); }
        if ($interval->h) { $result .= $interval->format("%h hour(s) "); }
        if ($interval->i) { $result .= $interval->format("%i minute(s) "); }
        if ($interval->s) { $result .= $interval->format("%s second(s) "); }

        return $result;
    }
}
