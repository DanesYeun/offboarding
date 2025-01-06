<?php

namespace App\Http\Controllers;

use App\Models\ClearanceRequest;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;

class EmployeeQuestionnareController extends Controller
{
    public function index()
    {
        $clearance_request = ClearanceRequest::where('user_id', auth()->user()->id)->first();
        $questions = Question::all();

        return view('pages.employee.questionnaire.index', compact('questions', 'clearance_request'));
    }

    public function store(Request $request, $id)
    {
        try {
            // Validate the responses
            $validated = $request->validate([
                'responses' => 'required|array',
                'responses.*' => 'required|integer|in:1,2,3,4,5',  // Validate each response as an integer from 1 to 5
            ]);

            // Retrieve the clearance request
            $clearance_request = ClearanceRequest::findOrFail($id);

            foreach ($validated['responses'] as $questionId => $responseValue) {
                Response::create([
                    'clearance_request_id' => $clearance_request->id,
                    'question_id' => $questionId,
                    'response' => $responseValue,
                ]);
            }

            $clearance_request->status = 5;
            $clearance_request->save();

            // Redirect with success message
            return redirect()->route('employee_clearance.index', $clearance_request->id)->with('success', 'Responses sent!');
        } catch (\Exception $e) {
            // Log error
            \Log::error('Error saving responses for clearance request ' . $id . ': ' . $e->getMessage());

            return redirect()->route('employee_clearance.index', $id)->with('error', 'Oh no! Something went wrong.');
        }
    }

}
