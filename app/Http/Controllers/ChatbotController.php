<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DatabaseSearch;
use App\Services\IntentService;
use App\Services\AISummaryService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChatbotController extends Controller
{
    public function chat(
        Request $request,
        DatabaseSearch $search,
        IntentService $intent,
        AISummaryService $summary
    ) {
        $message = trim($request->message);

        // Detect the most relevant table
        $table = $intent->detect($message);

        // Search
        if ($table) {
            $results = $search->searchTable($table, $message);
        } else {
            $results = $search->search($message);
        }

        // No results
        if (empty($results)) {
            return response()->json([
                'answer' => "I couldn't find any matching records."
            ]);
        }

        // Get the first returned table
        $table = array_key_first($results);

        $records = $results[$table] ?? [];

        // No records found
        if (count($records) == 0) {
            return response()->json([
                'answer' => "I couldn't find any matching records."
            ]);
        }

        // Generate AI-style summary
        $answer = $summary->summarize($table, $records);

        return response()->json([
            'answer' => $answer
        ]);
    }
}
