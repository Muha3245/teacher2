<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\CoinHistory;

use Illuminate\Http\Request;
use App\Models\TeacherProfile as techProfil;

class CoinController extends Controller
{
    public function checkCoins(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:student_posts,id',
            'coins_needed' => 'required|numeric|min:0.01',
        ]);

        $user = auth()->user();
        $postId = $request->post_id;
        $coinsNeeded = $request->coins_needed;

        $alreadyPaid = CoinHistory::where('user_id', $user->id)
            ->where('student_post_id', $postId)
            ->where('type', 'deduction')
            ->exists();

        if ($alreadyPaid) {
            return response()->json([
                'status' => 'success',
                'message' => 'You already paid coins for this post.'
            ]);
        }
        if ($user->coins < $coinsNeeded) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not enough coins.'
            ]);
        }

        // Deduct coins
        $user->coins -= $coinsNeeded;
        $user->save();

       

        $teacherProfile = techProfil::where('user_id', auth()->id())->first();
        $teacherId = $teacherProfile ? $teacherProfile->id : null;
        if (!$teacherId) {
            return response()->json([
                'status' => 'error',
                'message' => 'You dont have profile'
            ]);
        }else{

            // Record coin history
            CoinHistory::create([
                'user_id' => $user->id,
                'student_post_id' => $postId,
                'coins' => $coinsNeeded,
                'type' => 'deduction',
                'description' => 'Paid to contact post #' . $postId,
            ]);
            Connection::create([
                'teacher_id' => $teacherId,
                'student_post_id' => $postId,
                'body' => 'teacher paid this post',
                'status' => 1,
            ]);
        }
        

        return response()->json([
            'status' => 'success',
            'message' => 'Coins deducted successfully.'
        ]);
    }
}
