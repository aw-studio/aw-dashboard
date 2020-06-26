<?php

namespace App\Http\Controllers\Api;

use App\Models\Site;
use App\Models\Deploy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForgeController extends Controller
{
    public function deploy(Request $request)
    {
        $site_id = $request->site['id'] ?? abort(404);
        $site = Site::findOrFail($site_id);

        Deploy::create([
            'site_id' => $site->id,
            'data' => $request->all(),
        ]);
    }
}
