<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatController extends Controller
{
    /*
        1. 채팅방 리스트 리턴
        2. 특정 채팅방의 메시지 리스트 리턴
        3. 특정 메시지 저장
    */

    public function index() {
        return Inertia::render('Chat/container');
    }

    public function rooms() {
        return ChatRoom::all();
    }

    public function messages($roomId) {
        $msgs =  ChatMessage::where('chat_room_id', $roomId)->with('user')->latest()->get(); //with절을 사용해서 관계된 사용자의 정보도 받아올 수 있다.
        // $msgs[0]->user->name;
        //lazy loading(default) VS eager loading
        // dd($msgs);
        return $msgs;
    }

    public function newMessage(Request $request, $roomId) {
        $request->validate(['message' => 'required']);

        $msg = ChatMessage::create([
            'user_id' => auth()->user()->id,
            'chat_room_id' => $roomId,
            'message' => $request->message,
        ]);

        return $msg;
    }
}
