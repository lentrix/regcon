<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Convention;
use App\RaffleItem;
use App\RaffleDraw;
use App\Participant;

class RaffleController extends Controller
{
    public function index() {
        $conv = Convention::getActive();
        $raffleDraws = $this->drawWinners();
        return view('admin.raffles.index', [
            'raffleItems' => $conv->raffleItems,
            'raffleDraws' => $raffleDraws
        ]);
    }

    public function userIndex() {
        $drawWinners = $this->drawWinners();
        $myWin = RaffleDraw::where('participant_id', auth()->user()->id)->get();

        return view('raffles.index',[
            'drawWinners' => $drawWinners,
            'myWin' => $myWin
        ]);
    }

    public function drawWinners() {
        $conv = Convention::getActive();
        return RaffleDraw::join('participants', 'raffle_draws.participant_id', 'participants.id')
                ->join('users', 'participants.user_id', 'users.id')
                ->join('raffle_items', 'raffle_draws.raffle_item_id', 'raffle_items.id')
                ->where('participants.convention_id', $conv->id)
                ->select(['users.lname', 'users.fname', 'users.school', 'raffle_items.itemName', 'raffle_items.sponsor'])
                ->orderByRaw('raffle_draws.created_at DESC')
                ->get();
    }

    public function create() {
        return view('admin.raffles.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'itemName' => 'required',
            'sponsor' => 'required',
            'qty' => 'required|numeric'
        ]);

        $conv = Convention::getActive();

        RaffleItem::create([
            'itemName' => $request['itemName'],
            'sponsor' => $request['sponsor'],
            'qty' => $request['qty'],
            'convention_id' => $conv->id
        ]);

        return redirect('/admin/raffles')->with('Info', 'A new raffle item has been added.');
    }

    public function edit(RaffleItem $item) {
        return view('admin/raffles/edit', compact('item'));
    }

    public function update(Request $request, RaffleItem $item) {
        $this->validate($request, [
            'itemName' => 'required',
            'sponsor' => 'required',
            'qty' => 'required|numeric'
        ]);

        $item->update([
            'itemName' => $request['itemName'],
            'sponsor' => $request['sponsor'],
            'qty' => $request['qty'],
        ]);

        return redirect('/admin/raffles')->with('Info', 'The raffle item has been updated.');
    }

    public function draw() {
        return view('admin.raffles.draw');
    }

    /** On-API */
    public function getItems() {
        $conv = Convention::getActive();
        $raffleItems = RaffleItem::where('convention_id', $conv->id)
                ->where('qty','>',0)
                ->get();
        return $raffleItems;
    }

    /** On-API */
    public function getRaffleDraws() {
        $conv = Convention::getActive();
        return $this->drawWinners($conv);
    }

    /** On-API */
    public function getParticipants($exclusive) {
        $conv = Convention::getActive();
        $part = \App\Participant::where('convention_id', $conv->id);

        if($exclusive=="true") {
            $part->whereDoesntHave('raffleDraw');
        }

        $part->with('user');

        $data = [];

        foreach($part->get() as $p) {
            $user = $p->user;
            $data[] = [
                'lname' => $user->lname,
                'fname' => $user->fname,
                'school' => $user->school,
                'imgUrl' => $user->imgUrl,
                'participant_id' => $p->id
            ];
        }

        return $data;
    }

    /** On-API */
    public function commit(Request $request) {
        \App\RaffleDraw::create([
            'raffle_item_id' => $request['raffle_item_id'],
            'participant_id' => $request['participant_id']
        ]);

        $item = \App\RaffleItem::find($request['raffle_item_id']);
        $item->qty-=1;
        $item->save();
    }
}
