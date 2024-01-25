<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Models\WebsiteSetting;
use App\Models\ManualDepositMethod;
use App\Models\Admin;
use App\Models\Section;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    //return view for email templates
    public function emailTemplates()
    {
        $page_title = 'Email Templates';
        $email_templates = EmailTemplate::orderBy('name', 'ASC')->get();

        return view('admin.settings.email.email-template', compact(
            'page_title',
            'email_templates'
        ));
    }

    //return view for a single email template edit
    public function editEmailTemplate(Request $request)
    {
        //check that the email template exists
        $template = EmailTemplate::where('id', $request->route('id'))->first();
        if (!$template) {
            return redirect(route('admin.settings.email-templates'))->with('fail', 'The email template you are tying to edit does not exists');
        }

        $page_title = 'Edit Email Template';

        //Get a list of all allowed shortcodes;        
        preg_match_all('/{{\$\w+}}/', $template->shortcodes_body, $body_shortcodes);
        preg_match_all('/{{\$\w+}}/', $template->shortcodes_subject, $subject_shortcodes);

        $shortcodes_subject = $subject_shortcodes[0];
        $shortcodes_body = $body_shortcodes[0];
        return view('admin.settings.email.edit-email-template', compact(
            'page_title',
            'template',
            'shortcodes_body',
            'shortcodes_subject'
        ));
    }

    //validate email template edit
    public function editEmailTemplateValidate(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'subject' => 'required',
            'message' => 'required',
            'status' => 'required'
        ]);

        $update = EmailTemplate::find($request->id);
        $update->subject = str_replace('{{', '{{$', $request->subject);
        $update->body = str_replace('{{', '{{$', $request->message);
        $update->status = $request->status;
        $update->save();

        return back()->with('success', 'Email Templete Edited successfully');
    }

    //return view for email configuration
    public function emailConfig()
    {
        $page_title = 'SMTP Setting';
        return view('admin.settings.email.email-config', compact('page_title'));
    }

    //validate email smtp setting
    public function emailConfigValidate(Request $request)
    {
        $request->validate([
            'smtp_host' => 'required',
            'smtp_port' => 'required',
            'smtp_encryption' => 'required',
            'smtp_username' => 'required',
            'smtp_password' => 'required',
            'smtp_from_address' => 'required',
            'smtp_from_name' => 'required',
            'email_queue' => 'required'
        ]);

        //save to .ENV
        setEnv('MAIL_HOST', $request->smtp_host);
        setEnv('MAIL_PORT', $request->smtp_port);
        setEnv('MAIL_USERNAME', $request->smtp_username);
        setEnv('MAIL_PASSWORD', $request->smtp_password);
        setEnv('MAIL_ENCRYPTION', $request->smtp_encryption);
        setEnv('MAIL_FROM_ADDRESS', $request->smtp_from_address);
        setEnv('MAIL_FROM_NAME', $request->smtp_from_name);
        websiteInfoUpdate('email_queue', $request->email_queue);

        return back()->with('success', 'Mail Configuration has been updated successfully');
    }

    /**************************************
     * Payment Gateways
     * This section is for managing all automated payment gateways
     */

    //return index automated payment gateway
    public function gateways()
    {
        $page_title = 'Automatic Payment Gateways Settings';
        $gateways = ManualDepositMethod::where('class', 'gateway')->orderBy('name', 'ASC')->get();

        return view('admin.settings.gateways.index', compact(
            'page_title',
            'gateways'
        ));
    }

    //return edit page of automatic gateways
    public function edit(Request $request)
    {
        //check if the gateway with the refernced id exists
        $gateway = ManualDepositMethod::where('id', $request->route('id'))->first();
        if (!$gateway) {
            return redirect(route('admin.settings.gateways.index'))->with('fail', 'The gateway you were trying to edit does not exist');
        }

        $page_title = 'Edit ' . $gateway->name;

        return view('admin.settings.gateways.edit', compact(
            'page_title',
            'gateway'
        ));
    }

    // change gateway status
    public function gatewayStatus(Request $request)
    {
        $request->validate([
            'action' => 'required',
            'gateway_id' => 'required'
        ]);

        if ($request->action == 'disable') {
            $status = 'inactive';
            $message = 'Payment gateway disabled successfully';
        } else {
            $status = 'active';
            $message = 'Payment gateway enabled successfully';
        }

        $gateway = ManualDepositMethod::find($request->gateway_id);
        $gateway->status = $status;
        $gateway->save();

        return back()->with('success', $message);
    }

    //validate payment gateway edit
    public function editValidate(Request $request)
    {
        if (!$request->id || !$request->type) {
            return back()->with('fail', 'An Error Occurred, please contact the developer');
        }

        //authorize .net
        if ($request->type == 'authorize') {
            if (function_exists('updateAuthorizeNet') && isAddonEnabled('authorizenet')) {
                if (updateAuthorizeNet($request)) {
                    return back()->with('success', 'Authorize.net updated successfully');
                } else {
                    return back()->withInput()->with('fail', 'An Error occurred');
                }
            } else {
                return back()->withInput()->with('fail', 'Authorize.net is not activated');
            }
        }
        //cashmaal
        if ($request->type == 'cashmaal') {
            if (function_exists('updateCashmaal') && isAddonEnabled('cashmaal')) {
                if (updateCashmaal($request)) {
                    return back()->with('success', 'Cashmaal updated successfully');
                } else {
                    return back()->withInput()->with('fail', 'An Error occurred');
                }
            } else {
                return back()->withInput()->with('fail', 'Cashmaal is not activated');
            }
        }


        //coinbase
        if ($request->type == 'coinbase') {

            if (function_exists('updateCoinbase') && isAddonEnabled('coinbase')) {
                if (updateCoinbase($request)) {
                    return back()->with('success', 'Coinbase updated successfully');
                } else {
                    return back()->withInput()->with('fail', 'An Error occurred');
                }
            } else {
                return back()->withInput()->with('fail', 'Coinbase is not activated');
            }
        }

        //coingate
        if ($request->type == 'coingate') {

            if (function_exists('updateCoingate') && isAddonEnabled('coingate')) {
                if (updateCoingate($request)) {
                    return back()->with('success', 'Coingate updated successfully');
                } else {
                    return back()->withInput()->with('fail', 'An Error occurred');
                }
            } else {
                return back()->withInput()->with('fail', 'Coingate is not activated');
            }
        }

        //flutterwave
        if ($request->type == 'flutterwave') {
            if (function_exists('updateFlutterwave') && isAddonEnabled('flutterwave')) {
                if (updateFlutterwave($request)) {
                    return back()->with('success', 'Flutterwave updated successfully');
                } else {
                    return back()->withInput()->with('fail', 'An Error occurred');
                }
            } else {
                return back()->withInput()->with('fail', 'Flutterwave is not activated');
            }
        }


        //Monnify
        if ($request->type == 'monnify') {
            if (function_exists('updateMonnify') && isAddonEnabled('monnify')) {
                if (updateMonnify($request)) {
                    return back()->with('success', 'Monnify updated successfully');
                } else {
                    return back()->withInput()->with('fail', 'An Error occurred');
                }
            } else {
                return back()->withInput()->with('fail', 'Monnify is not activated');
            }
        }


        //Paypal
        if ($request->type == 'paypal') {
            if (function_exists('updatePayPal') && isAddonEnabled('paypal')) {
                if (updatePayPal($request)) {
                    return back()->with('success', 'Paypal updated successfully');
                } else {
                    return back()->withInput()->with('fail', 'An Error occurred');
                }
            } else {
                return back()->withInput()->with('fail', 'Paypal is not activated');
            }
        }

        //Paystack
        if ($request->type == 'paystack') {
            //validate input
            $request->validate([
                //general
                'id' => 'required',
                'min_amount' => 'required|numeric',
                'max_amount' => 'required|numeric',
                'charge_type' => 'required',
                'charge' => 'required|numeric',
                'status' => 'required',
                'payment_instruction' => 'required',

                //config
                'paystack_public_key' => 'required',
                'paystack_secret_key' => 'required',
                'merchant_email' => 'email',

            ]);


            //save config
            setEnv('PAYSTACK_PUBLIC_KEY', $request->paystack_public_key);
            setEnv('PAYSTACK_SECRET_KEY', $request->paystack_secret_key);
            setEnv('MERCHANT_EMAIL', $request->merchant_email);


            //save general
            $general = ManualDepositMethod::find($request->id);
            $general->min_amount = $request->min_amount;
            $general->max_amount = $request->max_amount;
            $general->charge_type = $request->charge_type;
            $general->charge = $request->charge;
            $general->status = $request->status;
            $general->payment_instruction = $request->payment_instruction;
            $save_general = $general->save();

            if ($save_general) {
                return back()->with('success', $general->name . ' Payment Gateway  updated successfully');
            } else {
                return back()->with('fail', 'An Error Occured');
            }
        }

        //RazorPay
        if ($request->type == 'razorpay') {
            if (function_exists('updateRazorPay') && isAddonEnabled('razorpay')) {
                if (updateRazorPay($request)) {
                    return back()->with('success', 'RazorPay updated successfully');
                } else {
                    return back()->withInput()->with('fail', 'An Error occurred');
                }
            } else {
                return back()->withInput()->with('fail', 'RazorPay is not activated');
            }
        }

        //Stripe
        if ($request->type == 'stripe') {

            if (function_exists('updateStripe') && isAddonEnabled('paypal')) {
                if (updateStripe($request)) {
                    return back()->with('success', 'Stripe updated successfully');
                } else {
                    return back()->withInput()->with('fail', 'An Error occurred');
                }
            } else {
                return back()->withInput()->with('fail', 'Stripe is not activated');
            }
        }
    }

    /*************
     * General Website Settings
     * This section is for managing several componets of the website.
     * Related componets are grouped together.
     */


    //return view for core settings cores

    public function core()
    {
        /**
         * Core compenents are
         * 1.  website name          3. register bonus   
         * 4   general_currency      5. website email    6. website phone
         * 7.  website address       8. Decimals         9. ref_bonus
         * 10. theme                 11. website address
         */
        $page_title = 'Website Settings';
        $currencies = getCurrency();
        $themes = getThemes();
        return view('admin.settings.core', compact(
            'page_title',
            'currencies',
            'themes'
        ));
    }

    //validate core edit
    public function coreValidate(Request $request)
    {

        $request->validate([
            "website_name" => "required",
            "website_email" => "required|email",
            "website_phone" => "required",
            "website_address" => "required",
            "theme" => "required",
            "register_bonus" => "required|numeric",
            "ref_bonus" => "required|numeric",
            "decimal_places" => "required|numeric",
        ]);

        websiteInfoUpdate('website_name', $request->website_name);
        websiteInfoUpdate('general_currency', $request->general_currency ?? 'NGN');
        websiteInfoUpdate('website_email', $request->website_email);
        websiteInfoUpdate('website_phone_no', $request->website_phone);
        websiteInfoUpdate('website_contact_address', $request->website_address);
        websiteInfoUpdate('theme', $request->theme);
        websiteInfoUpdate('register_bonus', $request->register_bonus);
        websiteInfoUpdate('ref_bonus', $request->ref_bonus);
        websiteInfoUpdate('decimal_places', $request->decimal_places);
        return back()->with('success', 'Website Settings Saved');
    }

    //return index of theme manager
    public function themes()
    {
        $page_title = 'Theme Manager';
        $themes = getThemes();

        return view('admin.settings.themes.index', compact(
            'page_title',
            'themes'
        ));
    }

    //return index of new theme
    public function newTheme()
    {
        $page_title = 'Create New Theme';
        return view('admin.settings.themes.new', compact(
            'page_title',

        ));
    }

    //create new theme
    public function newThemeValidate(Request $request)
    {
        //validate input
        $request->validate([
            'theme_name' => 'required|max:30|min:3',
            'theme_status' => 'required',
            'theme_bg_color' => 'required',
            'type' => 'required'
        ]);

        $theme_bg_hex_color = str_replace('#', '', $request->theme_bg_color);
        $theme_bg_rgb_color = str_replace('#', '', $theme_bg_hex_color);
        $theme_bg_rgb_color = str_split($theme_bg_rgb_color, 2);
        $theme_bg_rgb_color = hexdec($theme_bg_rgb_color[0]) . ' ' . hexdec($theme_bg_rgb_color[1]) . ' ' . hexdec($theme_bg_rgb_color[2]);

        //format name
        $theme_name = str_replace('-', '_', $request->theme_name);
        $theme_name = str_replace(' ', '_', $theme_name);
        $theme_name = str_replace('__', '_', $theme_name);
        $theme_name = 'custom_' . strtolower($theme_name);


        $type = $request->type;
        //check if a theme with same name exists
        $path = base_path('resources/views/themes/' . $theme_name);
        $copy_path = base_path('resources/views/themes/' . $type);
        if (\Illuminate\Support\Facades\File::isDirectory($path)) {
            return back()
                ->withInput()
                ->with('fail', 'A theme with this name already exist');
        } else {

            \Illuminate\Support\Facades\File::copyDirectory($copy_path, $path);
            //check check status
            if ($request->theme_status == 'active') {
                websiteInfoUpdate('theme', $theme_name);
            }

            //update references of 'cryptic' to $theme_name

            $disk = Storage::build([
                'driver' => 'local',
                'root' => resource_path('views/themes'),
            ]);

            $files_to_update = $disk->allFiles($theme_name);


            $errors = [];

            foreach ($files_to_update as $file) {
                //confirm that the file was created before proceeding
                $file_path = base_path('resources/views/themes/' . $file);
                if (file_exists($file_path)) {
                    $file_content = file_get_contents($file_path);
                    $replace = '.' . $theme_name . '.';
                    $defualt = '.' . $type . '.';
                    $new_file = str_replace($defualt, $replace, $file_content);
                    $update = file_put_contents($file_path, $new_file);
                    if (!$update) {
                        array_push($errors, 'FAILED: ' . $file_path);
                    }
                } else {
                    array_push($errors, 'NOT FOUND: ' . $file_path);
                }
            }



            if (count($errors) > 0) {
                //revert to defaulth theme
                websiteInfoUpdate('theme', 'cryptic');
                session()->flash('upload_errors', $errors);
                return back()->with('fail', $request->theme_name . ' was created but an error occured, while updating references. Delete the this theme and create a new one');
            } else {
                //create theme asset files
                $path = root_path() . 'public/assets/themes/' . $theme_name;
                $copy_path = root_path() . 'public/assets/themes/' . $type;
                $assets_create = \Illuminate\Support\Facades\File::copyDirectory($copy_path, $path);
                if ($assets_create) {
                    //replace color references                    

                    //Update color references in assets [hex and rgb]
                    $asset_files = [
                        'config.php',
                        'style/styles.css',

                    ];

                    $result = [];
                    $asset_file_list = [];
                    $all_files_r = [];

                    foreach ($asset_files as $asset_file) {
                        $asset_file_path = root_path() . 'public/assets/themes/' . $theme_name . '/' . $asset_file;

                        //dd(file_exists($asset_file_path));
                        if (file_exists($asset_file_path)) {
                            array_push($asset_file_list, 'FILE: ' . $asset_file_path);
                            $file_content = file_get_contents($asset_file_path);
                            //update hex color
                            $replace = $theme_bg_hex_color;
                            $new_file = str_replace('060818', $replace, $file_content);
                            //for RGB
                            $replace = $theme_bg_rgb_color;
                            $new_file = str_replace('6 8 24', $replace, $new_file);
                            $update = file_put_contents($asset_file_path, $new_file);

                            $all_filesrr = [
                                'old' => $file_content,
                                'new' => $new_file,
                                'update' => $new_file,
                                'updated' => file_get_contents($asset_file_path)
                            ];



                            array_push($all_files_r, $all_filesrr);


                            if (!$update) {
                                array_push($errors, 'FAILED: ' . $asset_file_path);
                            } else {
                                array_push($result, 'UPDATED: ' . $asset_file_path);
                            }
                        } else {
                            array_push($asset_file_list, 'NOT FILE: ' . $asset_file_path);
                        }
                    }
                } else {
                    //revert to defaulth theme
                    websiteInfoUpdate('theme', 'cryptic');
                    return back()->with('fail', $request->theme_name . ' was created but an error occured, while updating references. Delete the this theme and create a new one');
                }
                return redirect(route('admin.settings.theme-manager.themes'))->with('success', $request->theme_name . ' has been created successfully created');
            }
        }
    }

    //delete theme
    public function deleteTheme(Request $request)
    {
        $page_title = 'Delete Theme';
        $theme_name = $request->route('name');

        return view('admin.settings.themes.delete', compact(
            'theme_name',
            'page_title'
        ));
    }

    //validate theme deletion
    public function deleteThemeValidate(Request $request)
    {
        $request->validate([
            'theme_name' => 'required',
            'password' => 'required|confirmed'
        ]);

        $theme_name = $request->theme_name;

        //validate password
        if (!Hash::check($request->password, admin('password'))) {
            return back()->with('fail', 'Incorrect Password');
        }

        //prevent deleting default theme
        $default_themes = [
            'cryptic',
            'skeleton'
        ];

        if (in_array($theme_name, $default_themes)) {
            return redirect(route('admin.settings.theme-manager.themes'))->with('fail', ucwords(str_replace('_', ' ', $theme_name)) . ' is a default theme');
        }


        //check if a theme with same name exists
        $path = base_path('resources/views/themes/' . $theme_name);
        if (\Illuminate\Support\Facades\File::isDirectory($path)) {
            //revert to default theme if its currently set to active
            if (websiteInfo('theme') == $theme_name) {
                websiteInfoUpdate('theme', 'cryptic');
            }

            //delete 
            $delete  = \Illuminate\Support\Facades\File::deleteDirectory($path);
            if ($delete) {
                //delete assets too
                $asset_path = root_path() . 'public/assets/themes/' . $theme_name;
                if (\Illuminate\Support\Facades\File::isDirectory($asset_path)) {
                    $delete  = \Illuminate\Support\Facades\File::deleteDirectory($asset_path);
                }

                return redirect(route('admin.settings.theme-manager.themes'))->with('success', ucwords(str_replace('_', ' ', $theme_name)) . ' has been deleted');
            } else {
                return redirect(route('admin.settings.theme-manager.themes'))->with('fail', ucwords(str_replace('_', ' ', $theme_name)) . ' could not deleted');
            }
        } else {
            return back()->with('fail', 'Theme does not exist or not valid');
        }
    }

    //edit transfer, loan and withdrawal
    public function misc()
    {
        /********
         * Transfer components are
         * 1. balance transfer          2. auto_approve_tr      3. min_transfer
         * 4. max_transfer              5. transfer_fee_type    6. transfer_fee
         */

        /************
         * Loan Components
         * 1. multiple loans    2. loan
         */

        $page_title = 'Misc Setting';
        return view('admin.settings.misc', compact('page_title'));
    }


    //validate transfer Edit
    public function miscValidate(Request $request)
    {

        $request->validate([
            "balance_transfer" => "present",
            "transfer_auto_approve" => "present",
            "min_transfer" => "present|numeric",
            "max_transfer" => "present|numeric",
            "transfer_fee" => "present|numeric",
            "transfer_fee_type" => "present",
            'loan' => 'present',
            'multiple_loans' => 'present',
            'withdrawal_fee' => 'required|numeric',
            'withdrawal_fee_type' => 'required',
            'min_withdrawal' => 'required|numeric',
            'max_withdrawal' => 'required|numeric',
            'auto_blog' => 'required',
            'auto_delete_expired_investments' => 'required'
        ]);

        if ($request->balance_transfer) {
            websiteInfoUpdate('balance_transfer', $request->balance_transfer);
            websiteInfoUpdate('transfer_auto_approve', $request->transfer_auto_approve);
            websiteInfoUpdate('min_transfer', $request->min_transfer);
            websiteInfoUpdate('max_transfer', $request->max_transfer);
            websiteInfoUpdate('transfer_fee', $request->transfer_fee);
            websiteInfoUpdate('transfer_fee_type', $request->transfer_fee_type);
        }

        if ($request->loan) {
            websiteInfoUpdate('loan', $request->loan);
            websiteInfoUpdate('multiple_loans', $request->multiple_loans);
        }

        websiteInfoUpdate('withdrawal_fee', $request->withdrawal_fee);
        websiteInfoUpdate('withdrawal_fee_type', $request->withdrawal_fee_type);
        websiteInfoUpdate('min_withdrawal', $request->min_withdrawal);
        websiteInfoUpdate('max_withdrawal', $request->max_withdrawal);
        websiteInfoUpdate('auto_blog', $request->auto_blog);
        websiteInfoUpdate('auto_delete_expired_investments', $request->auto_delete_expired_investments);

        return back()->with('success', 'Misc Settings saved');
    }

    //edit security and otp
    public function security()
    {
        /********
         * security and otp components are 
         * 1. google capcha         2. email verification   3. Transfer otp
         * 4. loan otp              5. login otp-user       6. login otp-admin
         * 7. id verification       8. withdrawal otp
         */

        $page_title = 'Security and Otp Settings';
        return view('admin.settings.security', compact('page_title'));
    }

    //validate security and otp
    public function securityValidate(Request $request)
    {

        $request->validate([
            "google_captcha" => "required",
            "email_verification" => "required",
            "id_verification" => "required",
            "transfer_otp" => "required",
            "withdrawal_otp" => "required",
            "loan_otp" => "required",
            "login_otp_user" => "required",
            "login_otp_admin" => "required",
        ]);

        websiteInfoUpdate('google_captcha', $request->google_captcha);
        setEnv('RECAPTCHA_SITE_KEY', $request->recaptcha_site_key);
        setEnv('RECAPTCHA_SECRET_KEY', $request->recaptcha_secret_key);
        websiteInfoUpdate('email_verification', $request->email_verification);
        websiteInfoUpdate('id_verification', $request->id_verification);
        websiteInfoUpdate('transfer_otp', $request->transfer_otp);
        websiteInfoUpdate('withdrawal_otp', $request->withdrawal_otp);
        websiteInfoUpdate('loan_otp', $request->loan_otp);
        websiteInfoUpdate('login_otp_user', $request->login_otp_user);
        websiteInfoUpdate('login_otp_admin', $request->login_otp_admin);

        return back()->with('success', 'Security Settings Saved');
    }


    //livechat starts here
    public function livechat()
    {
        $page_title = 'Livechat Setting';
        $whatsapp = json_decode(websiteInfo('whatsapp'));


        return view('admin.settings.livechat', compact('page_title', 'whatsapp'));
    }

    //livechat starts here
    public function livechatValidate(Request $request)
    {
        $request->validate([
            'livechat' => 'required',
            'livechat_script' => 'required',
            'whatsapp' => 'required',
            'whatsapp_no' => 'required|numeric',
            'whatsapp_message' => 'required'
        ]);

        websiteInfoUpdate('livechat', $request->livechat);
        file_put_contents(resource_path('store/livechat.store'), $request->livechat_script);

        $whatsapp = json_encode([
            'status' => $request->whatsapp,
            'no' => $request->whatsapp_no,
            'message' => $request->whatsapp_message
        ]);

        websiteInfoUpdate('whatsapp', $whatsapp);

        return back()->with('success', 'Livechat Settings Saved Successfully');
    }


    //custom css
    public function customCss()
    {
        $page_title = 'Custom CSS';
        return view('admin.settings.custom-css', compact('page_title'));
    }

    //custom css validate
    public function customCssValidate(Request $request)
    {
        //validate input
        $request->validate([
            'custom_css' => 'required'
        ]);

        //save 
        $save = file_put_contents(resource_path('store/customcss.store'), json_encode($request->custom_css));

        if ($save) {
            return back()->with('success', 'Custom Css updated, clear cache if change have not reflected yet');
        } else {
            return back()
                ->withInput()
                ->with('fail', 'Something went wrong');
        }
    }

    //custom js
    public function customJs()
    {
        $page_title = 'Custom JS';
        return view('admin.settings.custom-js', compact('page_title'));
    }

    //custom js validate
    public function customJsValidate(Request $request)
    {
        //validate input
        $request->validate([
            'custom_js' => 'required'
        ]);

        //save 
        $save = file_put_contents(resource_path('store/customjs.store'), json_encode($request->custom_js));

        if ($save) {
            $message = "Custom JS updated, clear cache if change have not reflected yet";
            return $message;
            //return back()->with('success', 'Custom JS updated, clear cache if change have not reflected yet');
        } else {
            return 'Failed to save changes';
        }
    }

    //Return view sections index
    public function sections()
    {
        $page_title = 'Manage Sections';
        $sections = Section::orderBy('name', 'ASC')->get();
        return view('admin.settings.sections.index', compact('page_title', 'sections'));
    }

    //return view section edit index
    public function editSection(Request $request)
    {
        //get the section
        $section = Section::where('id', $request->route('id'))->first();

        //ensure that the section actual exist before proceeding
        if (!$section) {
            return redirect(route('admin.settings.sections.index'))->with('fail', 'Invalid section, check the name and try again');
        }

        $page_title = 'Edit Section: ' . ucwords(str_replace('_', ' ', $section->name));
        return view('admin.settings.sections.edit', compact('page_title', 'section'));
    }

    //validate sections edit
    public function editSectionValidate(Request $request)
    {
        //general valiation excluding breadcrum
        if ($request->name != 'breadcrumb') {
            $request->validate([
                'section_heading' => 'required|max:255',
                'section_bg_img' => 'mimes:png,jpg,jpeg,svg',
                'section_text' => 'required',
                'about' => 'required',
                'blog' => 'required',
                'blog_detail' => 'required',
                'contact' => 'required',
                'home' => 'required',
                'plans' => 'required',
            ]);
        } else {
            $request->validate([
                'section_bg_img' => 'mimes:png,jpg,jpeg,svg',
            ]);
        }


        //check if the bg image is in request and save it
        $section_bg_img = $request->old_section_bg_img;

        if ($request->file('section_bg_img')) {
            $file = $request->file('section_bg_img');
            $extention = $file->getClientOriginalExtension();
            $file_name = $request->name . '-bg-' . time() . '.' . $extention;
            $section_bg_img = uploadImagePublic($file, $file_name);
        }

        //update for hero section starts here
        if ($request->name == 'hero'  || $request->name == 'about') {
            $request->validate([
                'section_button_text' => 'required|max:255',
                'section_button_url' => 'required|max:255',
                'old_section_bg_img' => 'required',
            ]);


            //define contents
            $content = [
                'section_heading' => $request->section_heading,
                'section_text' => $request->section_text,
                'section_button_text' => $request->section_button_text,
                'section_button_url' => $request->section_button_url,
                'section_bg_img' => $section_bg_img,
            ];
        } elseif ($request->name == 'plans' || $request->name == 'calculator' || $request->name == 'faq' || $request->name == 'deposit_withdraw' || $request->name == 'deposit_methods' || $request->name == 'newsletter' || $request->name == 'loan_plans'  || $request->name == 'testimonials' || $request->name == 'teams' || $request->name == 'blog' || $request->name == 'contact') {
            //define contents
            $content = [
                'section_heading' => $request->section_heading,
                'section_text' => $request->section_text,
            ];
        } elseif ($request->name == 'why') {

            $request->validate([
                'why_title_0' => 'required|max:255',
                'why_text_0' => 'required',
                'why_icon_0' => 'required',
                'why_title_1' => 'required|max:255',
                'why_text_1' => 'required',
                'why_icon_1' => 'required',
                'why_title_2' => 'required|max:255',
                'why_text_2' => 'required',
                'why_icon_2' => 'required',
                'why_title_3' => 'required|max:255',
                'why_text_3' => 'required',
                'why_icon_3' => 'required',
                'why_title_4' => 'required|max:255',
                'why_text_4' => 'required',
                'why_icon_4' => 'required',
                'why_title_5' => 'required|max:255',
                'why_text_5' => 'required',
                'why_icon_5' => 'required',
            ]);

            //define contents
            $content = [
                'section_heading' => $request->section_heading,
                'section_text' => $request->section_text,
                'whys' => [
                    [
                        'icon' => $request->why_icon_0,
                        'title' => $request->why_title_0,
                        'text' => $request->why_text_0,
                    ],
                    [
                        'icon' => $request->why_icon_1,
                        'title' => $request->why_title_1,
                        'text' => $request->why_text_1,
                    ],
                    [
                        'icon' => $request->why_icon_2,
                        'title' => $request->why_title_2,
                        'text' => $request->why_text_2,
                    ],
                    [
                        'icon' => $request->why_icon_3,
                        'title' => $request->why_title_3,
                        'text' => $request->why_text_3,
                    ],
                    [
                        'icon' => $request->why_icon_4,
                        'title' => $request->why_title_4,
                        'text' => $request->why_text_4,
                    ],
                    [
                        'icon' => $request->why_icon_5,
                        'title' => $request->why_title_5,
                        'text' => $request->why_text_5,
                    ],


                ],
            ];
        } elseif ($request->name == 'how') {
            //validate request only input
            $request->validate([
                'register_icon' => 'required',
                'register_text' => 'required',
                'fund_wallet_icon' => 'required',
                'fund_wallet_text' => 'required',
                'invest_icon' => 'required',
                'invest_text' => 'required',
                'withdraw_icon' => 'required',
                'withdraw_text' => 'required',

            ]);
            //define content
            $content = [
                'section_heading' => $request->section_heading,
                'section_text' => $request->section_text,
                'steps' => [
                    'register' => [
                        'icon' => $request->register_icon,
                        'text' => $request->register_text,
                    ],
                    'fund_wallet' => [
                        'icon' => $request->fund_wallet_icon,
                        'text' => $request->fund_wallet_text,
                    ],

                    'invest' => [
                        'icon' => $request->invest_icon,
                        'text' => $request->invest_text,
                    ],
                    'withdraw' => [
                        'icon' => $request->withdraw_icon,
                        'text' => $request->withdraw_text,
                    ],
                ]
            ];
        } elseif ($request->name == 'breadcrumb') {
            $content = [
                'section_bg_img' => $section_bg_img,
            ];
        } elseif ($request->name == 'stats') {
            //validate stats specific values
            $request->validate([
                'counter_icon_0' => 'required',
                'counter_title_0' => 'required',
                'counter_count_0' => 'required|numeric',
                'counter_icon_1' => 'required',
                'counter_title_1' => 'required',
                'counter_count_1' => 'required|numeric',
                'counter_icon_2' => 'required',
                'counter_title_2' => 'required',
                'counter_count_2' => 'required|numeric',
            ]);
            //define contents
            $content = [
                'section_heading' => $request->section_heading,
                'section_text' => $request->section_text,
                'counters' => [
                    [
                        'icon' => $request->counter_icon_0,
                        'title' => $request->counter_title_0,
                        'count' => $request->counter_count_0,
                    ],
                    [
                        'icon' => $request->counter_icon_1,
                        'title' => $request->counter_title_1,
                        'count' => $request->counter_count_1,
                    ],
                    [
                        'icon' => $request->counter_icon_2,
                        'title' => $request->counter_title_2,
                        'count' => $request->counter_count_2,
                    ],

                ],
            ];
        }

        $pages = [];
        if ($request->about == 'enabled') {
            array_push($pages, 'about');
        }

        if ($request->blog == 'enabled') {
            array_push($pages, 'blog');
        }

        if ($request->blog_detail == 'enabled') {
            array_push($pages, 'blog_detail');
        }

        if ($request->contact == 'enabled') {
            array_push($pages, 'contact');
        }

        if ($request->home == 'enabled') {
            array_push($pages, 'home');
        }

        if ($request->plans == 'enabled') {
            array_push($pages, 'plans');
        }


        //save to database
        $section  = Section::find($request->route('id'));
        $section->content = json_encode($content);
        $section->pages = json_encode($pages);
        $save = $section->save();

        if ($save) {
            return back()->with('success', $request->name . ' has been updated');
        } else {
            return back()->withInput()->with('fail', 'Section Update failed');
        }
    }

    //section ajax
    public function sectionsAjax(Request $request)
    {
        $request->validate([
            'page' => 'required',
            'section' => 'required',
            'status' => 'required'
        ]);

        $section = Section::where('name', $request->section)->first();
        if (!$section) {
            abort(404);
        }

        //check if the 
        $pages = json_decode($section->pages);
        if ($request->status == 'disabled' && in_array($request->page, $pages)) {
            //search for page in the pages array
            $key = array_search($request->page, $pages);
            unset($pages[$key]);
            $pages = array_values($pages);

            //update the section
            $update = Section::find($section->id);
            $update->pages = json_encode($pages);
            $is_updated = $update->save();

            if (!$is_updated) {
                abort(404);
            }

            return 'success';
        } elseif ($request->status == 'enabled' && !in_array($request->page, $pages)) {
            array_push($pages, $request->page);
            $update = Section::find($section->id);
            $update->pages = json_encode($pages);
            $is_updated = $update->save();

            if ($is_updated) {
                return 'success';
            } else {
                abort(404);
            }
        }
    }

    //logo and SEO Settings
    public function logoSeo()
    {
        $page_title = 'Logo and SEO';

        return view('admin.settings.logo-seo', compact('page_title'));
    }

    //validate logo and seo setting
    public function logoSeoValidate(Request $request)
    {
        $request->validate([
            'logo' => 'mimes:png,jpeg,jpg,svg,gif',
            'logo_rec' => 'mimes:png,jpeg,jpg,svg,gif',
            'favicon' => 'mimes:png,jpeg,jpg,svg,gif',
            'banner' => 'mimes:png,jpeg,jpg,svg,gif',
            'keywords' => 'required',
            'description' => 'required',
            'robots' => 'required',

        ]);

        if ($request->robots == 'enabled') {
            $robots = 'all';
        } else {
            $robots = 'noindex';
        }

        $logo = json_decode(websiteInfo('meta'))->logo;
        $logo_rec = json_decode(websiteInfo('meta'))->logo_rec;
        $banner = json_decode(websiteInfo('meta'))->banner;
        $favicon = json_decode(websiteInfo('meta'))->favicon;
        if ($request->file('logo')) {
            $file = $request->file('logo');
            $file_name = 'logo.' . $file->extension();
            $logo =  uploadImagePublic($file, $file_name);
        }

        if ($request->file('logo_rec')) {
            $file = $request->file('logo_rec');
            $file_name = 'logo-rec.' . $file->extension();
            $logo_rec =  uploadImagePublic($file, $file_name);
        }

        if ($request->file('favicon')) {
            $file = $request->file('favicon');
            $file_name = 'favicon.' . $file->extension();
            $favicon =  uploadImagePublic($file, $file_name);
        }

        if ($request->file('banner')) {
            $file = $request->file('banner');
            $file_name = 'banner-' . time() . '.' . $file->extension();
            $banner =  uploadImagePublic($file, $file_name);
        }

        $meta = [
            'logo' => $logo,
            'logo_rec' => $logo_rec,
            'favicon' => $favicon,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'robots' => $robots,
            'banner' => $banner,
        ];

        $meta = json_encode($meta);

        $update = websiteInfoUpdate('meta', $meta);

        if ($update) {
            return back()->with('success', 'Settings saved');
        } else {
            return back()->withInput()->with('fail', 'Something went wrong');
        }
    }


    //social media starts here
}
