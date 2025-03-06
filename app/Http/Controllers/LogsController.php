<?php

namespace App\Http\Controllers;

use App\Models\ErrorQueryLog;
use Illuminate\Http\Request;

class LogsController extends Controller
{

    public function errorQueryLogs()
    {
        // Fetch all error logs sorted by ID in descending order
        $errorLogs = ErrorQueryLog::orderBy('id', 'desc')->get();

        // Send data to the view
        return view('publics.app-logs', compact('errorLogs'));
    }

    public function refreshErrorQueryLogs(Request $request)
    {
        if (!$request->ajax()) {
            return view('publics.layouts-error-404');
        }

        // Fetch the latest error logs
        $errorLogs = ErrorQueryLog::orderBy('id', 'desc')->get();

        // Render the partial view and return as JSON
        $html = view('partials.error-query-logs', compact('errorLogs'))->render();
        return response()->json(['html' => $html]);
    }

    public function searchErrorQueryLogs(Request $request)
    {
        if (!$request->ajax()) {
            return view('publics.layouts-error-404');
        }
    
        $search = $request->input('search');
    
        // Perform the search on user_id, error_at, or error_title
        $searchErrorLogs = ErrorQueryLog::query()
            ->where('user_id', 'LIKE', "%{$search}%")
            ->orWhere('error_at', 'LIKE', "%{$search}%")
            ->orWhere('error_title', 'LIKE', "%{$search}%")
            ->orderBy('id', 'desc')  // Fix the syntax error here
            ->get();
    
        // Store the result in errorLogs
        $errorLogs = $searchErrorLogs;
    
        // Render the partial view and return as JSON
        $html = view('partials.search-error-query-logs', compact('errorLogs'))->render();
        return response()->json(['html' => $html]);
    }  
}
