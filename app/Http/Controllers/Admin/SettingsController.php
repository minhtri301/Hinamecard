<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role_or_permission:Chủ sở hữu|settings']);
    }

    public function getGeneralConfig()
    {
        $data = Settings::where('type', 'general')->first();

        $content = $data ? json_decode($data->content) : null;

        return view('admin.settings.general', compact('content'));
    }

    public function postGeneralConfig(Request $request)
    {
        $options = Settings::where('type', 'general')->first();
        
        $options->content = !empty($request->content) ? json_encode($request->content) : null;
        
        $options->save();

        return back()->with('success', 'Cập nhật thành công');
    }
}
