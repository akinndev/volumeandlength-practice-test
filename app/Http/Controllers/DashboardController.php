<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function list(Request $request): View | RedirectResponse
    {
        try {
            $startDate = $request->get('start_date') ?? '2015-09-07';
            $endDate = $request->get('end_date') ?? '2015-09-08';

            $response = Http::get('https://api.nasa.gov/neo/rest/v1/feed', [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'api_key' => 'DEMO_KEY'
            ]);

            $data = $response->json();

            // Loop through each date key and merge the corresponding arrays
            if (isset($data['near_earth_objects'])) {
                $combinedNEO = [];
                foreach ($data['near_earth_objects'] as $date => $objects) {
                    $combinedNEO = array_merge($combinedNEO, $objects);
                }
                $data['near_earth_objects'] =  $combinedNEO;
            }

            return view('dashboard.list', compact('data'));
        } catch (\Exception $e) {
            Log::error('DashboardController::list' . $e);
            abort(500);
        }
    }

    public function detail(string $id): View | RedirectResponse
    {
        try {
            $response = Http::get('http://api.nasa.gov/neo/rest/v1/neo/' . $id, [
                'api_key' => 'DEMO_KEY'
            ]);

            $data = $response->json();

            return view('dashboard.detail', compact('data'));
        } catch (\Exception $e) {
            Log::error('DashboardController::detail' . $e);
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
