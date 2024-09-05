<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conference;

class ConferenceController extends Controller
{
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'location' => 'required|string|max:255',
            'status' => 'required|in:upcoming,past',
            'image' => 'nullable|image',
            'first_announcement_pdf' => 'nullable|file|mimes:pdf',
            'second_announcement_pdf' => 'nullable|file|mimes:pdf',
            'conference_brochure_pdf' => 'nullable|file|mimes:pdf',
            'conference_scientific_program_pdf' => 'nullable|file|mimes:pdf',
        ]);

        try {
            $conference = new Conference();
            $conference->title = $request->input('title');
            $conference->description = $request->input('description');
            $conference->start_date = $request->input('start_date');
            $conference->end_date = $request->input('end_date');
            $conference->location = $request->input('location');
            $conference->status = $request->input('status');

            // Handle file uploads
            if ($request->hasFile('image')) {
                $conference->image = $request->file('image')->store('conference_images', 'public');
            }
            if ($request->hasFile('first_announcement_pdf')) {
                $conference->first_announcement_pdf = $request->file('first_announcement_pdf')->store('conference_announcements', 'public');
            }
            if ($request->hasFile('second_announcement_pdf')) {
                $conference->second_announcement_pdf = $request->file('second_announcement_pdf')->store('conference_announcements', 'public');
            }
            if ($request->hasFile('conference_brochure_pdf')) {
                $conference->conference_brochure_pdf = $request->file('conference_brochure_pdf')->store('conference_brochures', 'public');
            }
            if ($request->hasFile('conference_scientific_program_pdf')) {
                $conference->conference_scientific_program_pdf = $request->file('conference_scientific_program_pdf')->store('conference_programs', 'public');
            }

            $conference->save();

            return response()->json(['message' => 'Conference created successfully!'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create conference.'], 500);
        }
    }
}


