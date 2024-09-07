<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // التحقق من صحة البيانات الواردة
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    
        // إنشاء توكن للمستخدم
        $token = $user->createToken('laravel')->plainTextToken;
        
        // إرسال التوكن في الاستجابة
        return response()->json(['token' => $token]);
    }

    public function userProfile(Request $request)
    {
        // الحصول على المستخدم المصادق عليه من التوكن
        $user = $request->user();
        
        // إعادة تفاصيل المستخدم
        return response()->json($user);
    }
}
