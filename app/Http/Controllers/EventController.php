<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;


class EventController extends Controller
{
    public function index(){

        $search = request('search');

       if($search){
        $events = Event::where([
            ['title','like','%'.$search.'%']

        ])->get();

       }else{
        $events = Event::all();
       }

        return view('welcome' , ['events'=>$events , 'search'=>$search]);
    }


    public function create(){

        return view('events.create');
    }


    public function store (Request $request){

        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->itens = $request->itens;

        //image upload
        if($request->hasFile('image') && $request->file('image')->isvalid()){

            $requestImage = $request->image;

            $extension = $requestImage->extension(); //pega a extensão do arquivo

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now').".".$extension); //nome do arquivo para ir para o banco

            $requestImage->move(public_path('img/events'),$imageName);

            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg','evento criado com sucesso');

    }


    public function show ($id){

        $event = Event::findOrFail($id);

        $user= auth()->user();
        $hasUserJoined = false;

        if($user){

            $userEvents = $user->eventsAsParticipant->toArray();
            foreach($userEvents as  $userEvent){
                if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }
        $eventOwner = User:: Where ('id' , $event->user_id)->first()->toArray();

        return view('events.show' , ['event'=>$event ,'eventOwner'=>$eventOwner , 'hasUserJoined'=>$hasUserJoined]);
    }


    public function dashboard(){

        $user = auth()->user();

        $events =$user->events;

        $eventsAsParticipant = $user -> eventsAsParticipant;

        return view('events.dashboard', ['events'=>$events , 'eventsAsParticipant'=> $eventsAsParticipant]);


    }


    public function destroy ($id){

        Event::findOrFail($id)->delete();
        return redirect('/dashboard')->with('msg','Evento Exluido com sucesso!');

    }


    public function edit ($id){

        $user = auth()->user();
        $event =  Event::findOrFail($id);

        if($user->id != $event->user_id){
            return redirect('/dasboard');
        }



        return view('/events.edit' , ['event'=>$event]);
    }



    public function update (Request $request){

        $data =$request->all();

        //image upload
        if($request->hasFile('image') && $request->file('image')->isvalid()){

            $requestImage = $request->image;

            $extension = $requestImage->extension(); //pega a extensão do arquivo

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now').".".$extension); //nome do arquivo para ir para o banco

            $requestImage->move(public_path('img/events'),$imageName);

            $data['image']= $imageName;
        }

            Event::findOrFail($request->id)->update($data);

         return redirect('/dashboard')->with('msg','Evento Editado com sucesso!');



     }



     public function joinEvent ($id){

        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);


         return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento'. $event->title);

     }


     public function leaveEvent($id) {

        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);
        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Você saiu com sucesso do evento'. $event->title);
     }





}
