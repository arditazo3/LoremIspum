<?php

namespace App\Http\Controllers;

use App\Event;
use DateTime;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

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
            'name' => 'required|min:5|max:20',
            'title' => 'required|min:5|max:100',
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
        //
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

        // Validation
        $this->validate($request, [
            'name'	=> 'required|min:5|max:15',
            'title' => 'required|min:5|max:100',
            'time'	=> 'required'
        ]);

        $event = Event::findOrFail($id);
        $inputs = $request->all();

        $time = explode(" - ", $request->input('time'));

        $inputs['start_time'] = $this->change_date_format($time[0]);
        $inputs['end_time'] = $this->change_date_format($time[1]);

        $updated = $event->update($inputs);

        if ($updated)
            Session::flash('updated_event', 'The event was successfully updated!');

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
