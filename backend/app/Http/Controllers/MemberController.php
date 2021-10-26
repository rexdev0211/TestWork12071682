<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function get_members() {
        $members = Member::all();
        return response()->json($members);
    }

    public function create_member(Request $request) {

        $member = new Member;
        
        $member->name = $request->name;
        $member->email = $request->email;
        $member->gender = $request->gender;
        $member->job_title = $request->job_title;

        $member->save();

        return response()->json($member);
    }

    public function edit_member(Request $request, $id) {

        $member = Member::find($id);

        $member->name = $request->name;
        $member->email = $request->email;
        $member->gender = $request->gender;
        $member->job_title = $request->job_title;

        $member->save();

        return response()->json($member);
    }

    public function delete_member(Request $request, $id) {

        $member = Member::find($id);

        $member->delete();

        return response()->json([
            'deleted' => true,
        ]);
    }
}
