<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailSettings;
use Storage;
// use Config;
use Str;
use Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class EmailSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email_settings = EmailSettings::where('status', '!=', 'delete')
            ->select('id', 'mail_encryption', 'mail_protocol', 'mail_title', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'status')
            ->first();

        if (!empty($email_settings)) {
            return view('admin.settings.email_settings', compact('email_settings'));
        } else {
            return view('admin.settings.email_settings');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->txtpkey;

        if ($request->has('email_settings')) {

            $email = EmailSettings::where('id', '=', $id)
                ->where('status', '=', 'active')
                ->first();


            $request->validate([
                'mail_encryption' => 'required|string',
                'mail_protocol' => 'required|string',
                'mail_title' => 'required|string',
                'mail_host' => 'required|string',
                'mail_port' => 'required|string',
                'mail_username' => 'required|email',
                'mail_password' => 'required|string'
            ]);

            $input['mail_encryption'] = $request->mail_encryption;
            $input['mail_protocol'] = $request->mail_protocol;
            $input['mail_host'] = $request->mail_host;
            $input['mail_port'] = $request->mail_port;
            $input['mail_username'] = strtolower($request->mail_username);
            $input['mail_password'] = $request->mail_password;
            $input['mail_title'] = $request->mail_title;

            if (!empty($id)) {

                if (!empty($email)) {
                    $input['modified_by'] = auth()->guard('admin')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    EmailSettings::where('id', '=', $id)->update($input);



                    // Update .env variables

                    // $mailer = $request->input('mail_protocol');
                    // $host = $request->input('mail_host');
                    // $port = $request->input('mail_port');
                    // $username = $request->input('mail_username');
                    // $password = $request->input('mail_password');
                    // $encryption = $request->input('mail_encryption');

                    // // Set the mail configuration dynamically using Config facade
                    // Config::set('mail.driver', $mailer);
                    // Config::set('mail.host', $host);
                    // Config::set('mail.port', $port);
                    // Config::set('mail.username', $username);
                    // Config::set('mail.password', $password);
                    // Config::set('mail.encryption', $encryption);

                    // File::put('.env', "MAIL_MAILER=$mailer");
                    // File::put('.env', "MAIL_HOST=$host");
                    // File::put('.env', "MAIL_PORT=$port");
                    // File::put('.env', "MAIL_USERNAME=$username");
                    // File::put('.env', "MAIL_PASSWORD=$password");
                    // File::put('.env', "MAIL_ENCRYPTION=$encryption");
                    // // Refresh configuration cache to apply changes
                    // Artisan::call('config:cache');

                    return redirect('admin/email-settings')->with('success', 'Email Settings updated successfully.');
                } else {
                    return redirect('admin/email-settings')->with('error', 'Email verification is disabled.');
                }

            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                EmailSettings::create($input);

                // Update .env variables

                // $mailer = $request->input('mail_protocol');
                // $host = $request->input('mail_host');
                // $port = $request->input('mail_port');
                // $username = $request->input('mail_username');
                // $password = $request->input('mail_password');
                // $encryption = $request->input('mail_encryption');

                // // Set the mail configuration dynamically using Config facade
                // Config::set('mail.driver', $mailer);
                // Config::set('mail.host', $host);
                // Config::set('mail.port', $port);
                // Config::set('mail.username', $username);
                // Config::set('mail.password', $password);
                // Config::set('mail.encryption', $encryption);

                // File::put('.env', "MAIL_MAILER=$mailer");
                // File::put('.env', "MAIL_HOST=$host");
                // File::put('.env', "MAIL_PORT=$port");
                // File::put('.env', "MAIL_USERNAME=$username");
                // File::put('.env', "MAIL_PASSWORD=$password");
                // File::put('.env', "MAIL_ENCRYPTION=$encryption");
                // // Refresh configuration cache to apply changes
                // Artisan::call('config:cache');
                return redirect('admin/email-settings')->with('success', 'Email Settings added successfully.');
            }
        }

        if ($request->has('email_verification')) {

            $email = EmailSettings::where('id', '=', $id)->first();

            if ($request->has('enable')) {
                $input['status'] = 'active';
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
            }
            if ($request->has('disable')) {
                $input['status'] = 'inactive';
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
            }

            if (!empty($email)) {
                EmailSettings::where('id', '=', $id)->update($input);
                return redirect('admin/email-settings')->with('success', 'Email verification updated successfully.');
            } else {
                return redirect('admin/email-settings')->with('error', 'No email found for verification settings.');
            }

        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
