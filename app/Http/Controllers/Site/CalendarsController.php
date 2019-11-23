<?php

namespace App\Http\Controllers\Site;

use App\Achievements\UserMade1000Events;
use App\Achievements\UserMade100Events;
use App\Achievements\UserMade200Events;
use App\Achievements\UserMade300Events;
use App\Achievements\UserMade400Events;
use App\Achievements\UserMade500Events;
use App\Achievements\UserMade50Events;
use App\Achievements\UserMade600Events;
use App\Achievements\UserMade700Events;
use App\Achievements\UserMade800Events;
use App\Achievements\UserMade900Events;
use App\Achievements\UserMadeFirstEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CalendarRequest;
use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('site.calendars.index');
    }

    public function store(CalendarRequest $request)
    {
        $user = $request->user();
        $user->calendars()->create($request->except('_token'));

        // Achievements
        $user->unlock(new UserMadeFirstEvent());
        $user->addProgress(new UserMade50Events(), 1);
        $user->addProgress(new UserMade100Events(), 1);
        $user->addProgress(new UserMade200Events(), 1);
        $user->addProgress(new UserMade300Events(), 1);
        $user->addProgress(new UserMade400Events(), 1);
        $user->addProgress(new UserMade500Events(), 1);
        $user->addProgress(new UserMade600Events(), 1);
        $user->addProgress(new UserMade700Events(), 1);
        $user->addProgress(new UserMade800Events(), 1);
        $user->addProgress(new UserMade900Events(), 1);
        $user->addProgress(new UserMade1000Events(), 1);

        //give points to user
        $points = setting('points_rating');
        $user->updatePoints($points);

        toastr()->info('Evento Criado com Sucesso!', 'Sucesso');
        return redirect()->to('calendars');
    }

    public function show($calendar_id)
    {
        $calendar = Calendar::findOrFail($calendar_id);
        $calendar->increment('views');

        $comments = $calendar->comments()->latest()->paginate(5);

        if (request()->ajax()) {
            return view('layouts.includes.comment_layout', compact('comments'));
        }

        return view('site.calendars.calendar', compact('calendar', 'comments'));
    }

    public function edit($calendar_id)
    {
        $calendar = Calendar::findOrFail($calendar_id);

        abort_unless(auth()->user()->id == $calendar->user_id, 403);

        return view('site.calendars.edit', compact('calendar'));
    }

    public function update(Request $request, $calendar_id)
    {
        $calendar = Calendar::findOrFail($calendar_id);

        abort_unless(auth()->user()->id == $calendar->user_id, 403);

        $calendar->update($request->except('_token'));

        toastr()->success('Evento Atualizado', 'Sucesso');
        return redirect()->to('calendars');
    }

    public function destroy($calendar_id)
    {
        $calendar = Calendar::findOrFail($calendar_id);

        abort_unless(auth()->user()->id == $calendar->user_id, 403);

        $calendar->delete();

        toastr()->warning('Evento Deletado', 'Aviso');
        return redirect()->to('calendars');
    }
}
