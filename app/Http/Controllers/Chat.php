<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Conversation;
use App\Models\Chats;

class Chat extends Controller
{
    //
    public function index($idconv, $user)
    {
        //echo $idconv;

        $data = Chats::where('id_conversation', $idconv)->get();
        //dd($data);

        return view('chat',[
            'chats' => $data,
            'user' => $user,
            'idconv' => $idconv
        ]);
    }

    public function getChats(Request $request)
    {
        $user = $request->user;

    }

    public function addchat(Request $request)
    {
        $user = $request->user;
        $chat = $request->chat;
        $idconv = $request->idconv;

        $chats = new Chats();

        $chats->tanggal = date('Y-m-d H:i:s');
        $chats->id_conversation = $idconv;
        $chats->user = $user;
        $chats->chat = $chat;
        $chats->is_processed = 0;
        $chats->save();
        return response()->json([
            'csrf' => csrf_token()
        ]);

    }

    public function getchat(Request $request)
    {
        $idconv = $request->idconv;
        $user = $request->user;

        $chatsM = new Chats();

        $chatsData = Chats::where('id_conversation', $idconv)
        ->where('is_processed', 0)
        ->where('user', '!=', $user)
        ->get();

        $viewChats = array();
        $idToUpdate = array();

        foreach($chatsData as $chat) {
            if($chat['user'] !== $user) {
                $idToUpdate[] = $chat['id'];
            }
            //dd($chat);
            $viewChats[] = [
                'tanggal' => $chat['tanggal'],
                'user' => $chat['user'],
                'chat' => $chat['chat']
            ];
        }

        Chats::whereIn('id', $idToUpdate)->update(['is_processed' => 1]);

        return response()->json([
            'chat' => $chatsData,
            'csrf' => csrf_token()
        ]);

    }
}
