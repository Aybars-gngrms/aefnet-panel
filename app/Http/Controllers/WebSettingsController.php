<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//? library
use Illuminate\Support\Str;
use App\Http\Controllers\HashController;

//? Models
use App\Models\SiteSettings;

class WebSettingsController extends Controller
{
    public function index()
    {
        $site_settings = SiteSettings::find(1);
        return view('settings/site-settings', compact('site_settings'));
    }

    //** Website ayarları güncelleme
    public function update(Request $request)
    {
        $site_settings = SiteSettings::findOrFail(1);
        $hash = new HashController();
        $site_settings->title = $request->input('title');
        $site_settings->email = $request->input('email');
        $site_settings->admin_panel_login_form_title = $request->input('admin_panel_login_form_title');

        if($request->hasFile('logo'))
        {
            $logo=Str::slug($request->title).'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads/site_settings'),$logo);
            $site_settings->logo='uploads/site_settings/'.$logo;
        }
        else
        {
            $site_settings->logo = $site_settings->logo;
        }

        if($request->hasFile('favicon'))
        {
            $favicon=Str::slug($request->title).$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads/site_settings'),$favicon);
            $site_settings->favicon='uploads/site_settings/'.$favicon;
        }
        else
        {
            $site_settings->favicon = $site_settings->favicon;
        }



        $site_settings->save();

        session()->flash('success', 'Website ayarları başarıyla güncellendi');
        return redirect()->back();
    }



}
