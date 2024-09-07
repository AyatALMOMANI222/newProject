<?php

namespace App\Http\Controllers;

use App\Models\Exhibition;
use Illuminate\Http\Request;

class ExhibitionController extends Controller
{
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:upcoming,past',
        ]);

        // إنشاء معرض جديد
        $exhibition = new Exhibition();
        $exhibition->title = $validatedData['title'];
        $exhibition->description = $validatedData['description'];
        $exhibition->location = $validatedData['location'];
        $exhibition->start_date = $validatedData['start_date'];
        $exhibition->end_date = $validatedData['end_date'];
        $exhibition->status = $validatedData['status'];

        // تخزين الصورة
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('exhibition_images', 'public'); // تخزين الصورة في مجلد 'exhibition_images'
            $exhibition->image = $imagePath;
        }
       
        $exhibition->save();

        return response()->json([
            'message' => 'Exhibition added successfully!',
            'data' => $exhibition
        ], 201);
    }
}

    