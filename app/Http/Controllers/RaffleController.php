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
        $raffleDraws = $this->drawWinners($conv);
        return view('admin.raffles.index', [
            'raffleItems' => $conv->raffleItems,
            'raffleDraws' => $raffleDraws
        ]);
    }

    public function drawWinners($conv) {
        return RaffleDraw::join('participants', 'raffle_draws.participant_id', 'participants.id')
                ->join('users', 'participants.user_id', 'users.id')
                ->join('raffle_items', 'raffle_draws.raffle_item_id', 'raffle_items.id')
                ->where('participants.convention_id', $conv->id)
                ->select(['users.lname', 'users.fname', 'users.school', 'raffle_items.itemName', 'raffle_items.sponsor'])
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
        $raffleItems = RaffleItem::where('convention_id', $conv->id)->get();
        return $raffleItems;
    }

    /** On-API */
    public function getRaffleDraws() {
        $conv = Convention::getActive();
        return $this->drawWinners($conv);
    }
}
