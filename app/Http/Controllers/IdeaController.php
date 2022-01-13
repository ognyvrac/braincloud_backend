<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Group;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Idea::with('group')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = json_decode($request->ideas, true);
        foreach ($data as $a_idea) {
            Idea::create([
                'content' => $a_idea['content'],
                'group_id' => 1,
                'session_id' => 1
            ]);
        }
        
        return response()->json([
            'status' => 201
        ], 201);
    }

    public function getIdeasWithVotes(){
        return Idea::where('votes_first', '>', 0)
            ->orderBy('votes_first', 'DESC')
            ->get();
    }

    public function getWinner(){
        return Idea::orderBy('votes_second', 'DESC')
            ->first();
    }

    public function updateWithGroups(Request $request)
    {
        $data = json_decode($request->groups, true);
        foreach ($data as $a_group) {
            if ($a_group['name'] != 'No group'){
                $group = Group::create([
                    'name' => $a_group['name']
                ]);
                foreach ($a_group['ideasG'] as $a_idea) {
                    $idea = Idea::find($a_idea['id']);
                    $idea->group_id = $group->id;
                    $idea->save();
                }
            }

        }
        return response()->json([
            'status' => 200
        ], 200);
    }

    public function update($id, Request $request)
    {
        $idea = Idea::find($id);

        $idea->votes_first = $idea->votes_first + 1;
        $idea->criteria1 = $request['criteria1'];
        $idea->criteria2 = $request['criteria2'];

        $idea->save();

        return response()->json([
            'status' => 200
        ], 200);
    }

    public function updateFirst($id){
        $idea = Idea::find($id);
        $idea->votes_first = $idea->votes_first + 1;
        $idea->save();
        return response()->json([
            'status' => 200
        ], 200);
    }

    public function updateSecond($id){
        $idea = Idea::find($id);

        $idea->votes_second = $idea->votes_second + 1;

        $idea->save();

        return response()->json([
            'status' => 200
        ], 200);
    }
}
