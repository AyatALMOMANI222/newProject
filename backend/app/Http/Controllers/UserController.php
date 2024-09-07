<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class UserController extends Controller
{
    public function store(Request $request)
    {
        try {
            // التحقق من صحة البيانات مع تحديد القواعد
            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // تحقق من أن الصورة هي نوع ملف صورة
                'biography' => 'nullable|string',
                'registration_type' => 'nullable|in:speaker,attendance,sponsor,group_registration',
                'phone_number' => 'nullable|string|max:255',
                'whatsapp_number' => 'nullable|string|max:255',
                'specialization' => 'nullable|string|max:255',
                'nationality' => 'nullable|string|max:255',
                'country_of_residence' => 'nullable|string|max:255',
            ]);
        
            // التعامل مع الصورة
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                $validatedData['image'] = $path;
            } else {
                $validatedData['image'] = null; // تعيين قيمة null إذا لم تكن الصورة موجودة
            }
        
            // إنشاء مستخدم جديد باستخدام البيانات المعتمدة
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'image' => $validatedData['image'],
                'biography' => $validatedData['biography'],
                'registration_type' => $validatedData['registration_type'],
                'phone_number' => $validatedData['phone_number'],
                'whatsapp_number' => $validatedData['whatsapp_number'],
                'specialization' => $validatedData['specialization'],
                'nationality' => $validatedData['nationality'],
                'country_of_residence' => $validatedData['country_of_residence'],
            ]);
        
            // إرجاع استجابة JSON بنجاح
            return response()->json(['message' => 'User created successfully!'], 201);
        
        } catch (\Exception $e) {
            // إرجاع استجابة JSON عند حدوث خطأ
            return response()->json([
                'message' => 'Failed to create user.',
                'error' => $e->getMessage() // عرض رسالة الخطأ
            ], 500);
        }
    }
}

