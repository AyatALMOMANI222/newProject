<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
    
        // التحقق من قيمة is_admin
        $isAdmin = $user->isAdmin;
    
        // إرسال التوكن ومعلومات is_admin في الاستجابة
        return response()->json([
            'token' => $token,
            'isAdmin' => $isAdmin,
        ]);
    }
    
    public function userProfile(Request $request)
    {
        // الحصول على المستخدم المصادق عليه من التوكن
        $user = $request->user();
        
        // إعادة تفاصيل المستخدم
        return response()->json($user);
    }
}
