<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\Passwordreset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'number' => 'required|numeric',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'push_token' => 'required'
        ]);

        if ($validator->fails()) {
            // return $this->sendError('please Validate error', $validator->errors());
            return response()->json([
                'success' => false,
                'error' => "The email has already been taken."
            ], 200);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['push_token'] = $request['push_token'];
        // $input['real_age'] = Carbon::parse($input['age'])->age;
        $user = User::create($input);

        $users = User::all();
        // $cart['user_id'] = $users[count($users) - 1]->id ;
        // Cart::create($cart);

        return response()->json([
            'success' => true,
            'user' => new UserResource($user)
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'push_token' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user =  User::find(Auth::user()->id);
            $user['push_token'] = $request['push_token'];
            $user->save();
            return response()->json([
                'success' => true,
                'user' => new UserResource($user)
            ], 200);
        } else {
            return response()->json(
                [
                    'success' => false,
                    'user' => [],
                    'message' => 'Please Check your credentials',
                ],
                200
            );
        }
    }

    public function profile()
    {
        $user = Auth::user();
        return response()->json(new UserResource($user), 200);
    }

    public function editData(Request $request)
    {
        $user = User::find(Auth::id());

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'number' => 'required|numeric',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $data = $request->all();

        $user->update($data);

        return response()->json(new UserResource($user), 200);
    }

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $user = User::find(Auth::id());

        if (password_verify($request->password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return response()->json(new UserResource($user), 200);
        } else {
            return response()->json(['error' => 'كلمة المرور القديمة غير صحيحة'], 400);
        }
    }

    public function send_code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $user = User::whereEmail($request->email)->firstOrFail();
        $user->verification_code = random_int(1000, 9999);
        $user->save();

        $resetData = [
            'user' => $user->name,
            'body' => 'here is your reset code',
            'code' => $user->verification_code,
            'url' => '/',
            'thankyou' => 'thank your for using our services'
        ];

        Notification::send($user, new Passwordreset($resetData));

        return response()->json([
            'message' => 'تم إرسال الكود على بريدك الإلكتروني',
            'id' => $user->id
        ], 200);
    }

    public function confirm_code(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $user = User::find($id);

        if ($user->verification_code == $request['code']) {
            return response()->json([
                'success' => true,
                'message' => 'الكود صحيح'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'الكود الذي ادخلته غير صحيح'
            ], 200);
        }
    }

    public function password_reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|exists:users,verification_code',
            'password' => 'required|confirmed|min:8|required_with:password_confirmation',
            'password_confirmation' => 'min:8|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }
        $user = User::where('verification_code', $request->code)->first();
        $user->password = Hash::make($request['password']);
        $user->save();
        return response()->json(['success' => true, 'message' => 'تم إعادة تعيين كلمة المرور بنجاح.'], 200);
    }
}
