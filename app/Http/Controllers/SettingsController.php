<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Services\ImageService;
use App\Models\SchoolYear;

class SettingsController extends Controller
{
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $setting = Setting::first();
        $app_name = $this->replaceUnderscoreToWhiteSpaces(env('APP_NAME'));
        $school_years = SchoolYear::all();

        $this->setAppName(1,'Settings');
        return view('setting.index', compact('setting', 'app_name', 'school_years'));
    }

    public function getSetting()
    {
        $setting = Setting::first();
        return response()->json($setting);
    }

    // update any env variable
    public function update(Request $request)
    {
        $request->validate([
            'system_name' => 'required',
            'system_email' => 'required|email',
            'system_title' => 'required',
            'address' => 'sometimes',
            'school_year' => 'sometimes|exists:school_years,id',
            // validate phone for 11 digits and starts with 09
            'phone' => 'sometimes|nullable|digits:11|regex:/(09)[0-9]{9}/',        
            'logo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // validate favicon size 16x16 for min and max of 32x32
            'favicon' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=16,min_height=16,max_width=32,max_height=32',
        ]);

        // remove white spaces to avoid any trouble
        $request->merge([
            'system_email' => preg_replace('/\s+/', '', $request->system_email),
        ]);

        // replace white spaces to underscore
        $app_name_request = $this->replaceWhiteSpacesToUnderscore($request->system_name);

        // replace whu

        $setting = Setting::first();

        // upload logo
        if ($request->hasFile('logo')) {
            $this->imageService->delete($setting->logo);
            $logo = $this->imageService->upload($request->logo, 'uploads', 'public', 'logo');
            
        }

        // upload favicon
        if ($request->hasFile('favicon')) {
            $this->imageService->delete($setting->favicon);
            $favicon = $this->imageService->upload($request->favicon, 'uploads', 'public', 'favicon');
        }

        if ($request->hasFile('background')) {
            $this->imageService->delete($setting->background);
            $background = $this->imageService->upload($request->background, 'uploads', 'public', 'background');
        }


        $setting->system_name = $request->system_name;
        $setting->system_email = $request->system_email;
        $setting->logo = $logo ?? $setting->logo;
        $setting->favicon = $favicon ?? $setting->favicon;
        $setting->system_title = $request->system_title;
        $setting->address = $request->address;
        $setting->background_logo = $background ?? $setting->background;
        $setting->school_year_id = $request->school_year;
        $setting->phone = $request->phone;
        $setting->save();
        

        // update .env file
        $env_update = $this->changeEnv([
            'APP_NAME' => $app_name_request,
            'MAIL_FROM_ADDRESS' => $request->system_email,
        ]);


        if ($env_update) {
            return redirect()->back()->with('success', 'Settings updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }


    // change env variable
    public function changeEnv($data = array())
    {
        if (count($data) > 0) {
            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);

            // Loop through given data
            foreach ((array)$data as $key => $value) {
                // Loop through .env-data
                foreach ($env as $env_key => $env_value) {
                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check if new key fits the actual .env-key
                    if ($entry[0] == $key) {
                        // If the value contains whitespace, enclose it in double quotes
                        if (strpos($value, ' ') !== false) {
                            $value = '"' . $value . '"';
                        } else {
                            // If the value doesn't contain whitespace, remove existing double quotes
                            $value = str_replace('"', '', $value);
                        }
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                        // Remove the existing value from the data array
                        unset($data[$key]);
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Append the remaining new parameters to the .env file
            foreach ($data as $key => $value) {
                // If the value contains whitespace, enclose it in double quotes
                if (strpos($value, ' ') !== false) {
                    $value = '"' . $value . '"';
                } else {
                    // If the value doesn't contain whitespace, remove existing double quotes
                    $value = str_replace('"', '', $value);
                }
                $env[] = $key . "=" . $value;
            }

            // Turn the array back to a string
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

            return true;
        } else {
            return false;
        }
    }
    
}
