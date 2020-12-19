<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;

class UserController extends Controller
{
    public function users() {
        $users = User::paginate(5);
        return view('users', compact('users'));
    }

    public function changeStatus(Request $request) {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success' => 'Status Change Successfully']);
    }


    public function deleteall(Request $request) {
        $ids = $request->get('ids');
        // $dbs = DB::table('users')->whereIn('id', explode(',', $ids))->delete();
         $dbs = DB::delete('DELETE FROM users WHERE id IN ('.implode(",", $ids).')');
        return redirect()->route('users');
    }
}
