<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyRequest;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Info(
 *     title="Survey API",
 *     version="1.0.0",
 *     description="API documentation for Survey API",
 *     @OA\Contact(
 *         email="rohitgautamofficialmail@gmail.com"
 *     )
 * )
 */
class SurveyController extends Controller
{
    public function index()
    {
        return view('survey');
    }

    /**
     * @OA\Post(
     *     path="/api/store",
     *     summary="Create a new survey",
     *     tags={"Surveys"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(property="name", type="string", example="Enter Your Name", description="Name of the user"),
     *                 @OA\Property(property="email", type="string", format="email", example="Enter Your Email", description="Email address of the user"),
     *                 @OA\Property(property="age", type="integer", example=25, description="Age of the user"),
     *                 @OA\Property(property="role", type="string", example="Admin", description="Role of the user"),
     *                 @OA\Property(property="g1", type="string", example="Group 1", description="Group of the user"),
     *                 @OA\Property(property="feature", type="string", example="Some Feature", description="Feature description"),
     *                 @OA\Property(property="skill_suggestion[]", type="array", @OA\Items(type="string"), example={"Suggestion 1", "Suggestion 2", "Suggestion 3"}, description="Array of skill suggestions"),
     *                 @OA\Property(property="suggestion", type="string", example="Some suggestion", description="Other suggestions"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="201", description="Survey saved successfully"),
     *     @OA\Response(response="400", description="Bad Request"),
     * )
     */
    public function store(SurveyRequest $request)
    {
        try {
            DB::beginTransaction();
            // Save the survey data to the database
            $survey = new Survey();
            $survey->name = $request->input('name');
            $survey->email = $request->input('email');
            $survey->age = $request->input('age');
            $survey->role = $request->input('role');
            $survey->g1 = $request->input('g1');
            $survey->feature = $request->input('feature');
            $survey->skill_suggestion = json_encode($request->input('skill_suggestion'));
            $survey->suggestion = $request->input('suggestion');
            $survey->save();

            DB::commit();

            // Return a response indicating success
            return response()->json(['message' => 'Survey saved successfully'], 201);
        } catch (\Exception $e) {
            // If an error occurs, rollback the transaction and return an error response
            DB::rollback();
            return response()->json(['message' => 'Failed to save survey'], 500);
        }
    }

      /**
     * @OA\Get(
     *     path="/api/surveys/{id}/edit",
     *     summary="Get the survey data for editing",
     *     tags={"Surveys"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Survey ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="OK"),
     *     @OA\Response(response="404", description="Survey not found"),
     * )
     */
    public function edit($id)
    {
        $survey = Survey::findOrFail($id);
        return response()->json($survey, 200);
    }


    /**
     * @OA\Post(
     *     path="/api/surveys/{id}",
     *     summary="Update the survey data",
     *     tags={"Surveys"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Survey ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(property="name", type="string", example="Enter Your Name", description="Name of the user"),
     *                 @OA\Property(property="email", type="string", format="email", example="Enter Your Email", description="Email address of the user"),
     *                 @OA\Property(property="age", type="integer", example=25, description="Age of the user"),
     *                 @OA\Property(property="role", type="string", example="Admin", description="Role of the user"),
     *                 @OA\Property(property="g1", type="string", example="Group 1", description="Group of the user"),
     *                 @OA\Property(property="feature", type="string", example="Some Feature", description="Feature description"),
     *                 @OA\Property(property="skill_suggestion[]", type="array", @OA\Items(type="string"), example={"Suggestion 1", "Suggestion 2", "Suggestion 3"}, description="Array of skill suggestions"),
     *                 @OA\Property(property="suggestion", type="string", example="Some suggestion", description="Other suggestions"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Survey updated successfully"),
     *     @OA\Response(response="400", description="Bad Request"),
     *     @OA\Response(response="404", description="Survey not found"),
     * )
     */
    public function update(SurveyRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $survey = Survey::findOrFail($id);

            // Update the survey data
            $survey->name = $request->input('name');
            $survey->email = $request->input('email');
            $survey->age = $request->input('age');
            $survey->role = $request->input('role');
            $survey->g1 = $request->input('g1');
            $survey->feature = $request->input('feature');
            $survey->skill_suggestion = json_encode($request->input('skill_suggestion'));
            $survey->suggestion = $request->input('suggestion');
            $survey->save();

            DB::commit();

            // Return a response indicating success
            return response()->json(['message' => 'Survey updated successfully'], 200);
        } catch (\Exception $e) {
            // If an error occurs, rollback the transaction and return an error response
            DB::rollback();
            return response()->json(['message' => 'Failed to update survey'], 500);
        }
    }
}
