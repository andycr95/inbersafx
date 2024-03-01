<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $data['pageTitle'] = 'General Setting';
        $data['navGeneralSettingsActiveClass'] = 'active';
        $data['subNavGeneralSettingsActiveClass'] = 'active';
        $data['general'] = GeneralSetting::first();
        $data['timezone'] = json_decode(file_get_contents(resource_path('views/backend/setting/timezone.json')));

        return view('backend.setting.general_setting')->with($data);
    }

    public function generalSettingUpdate(Request $request)
    {


        $general = GeneralSetting::first();

        $request->validate([
            'sitename' => 'required',
            'refer_need' => 'required',
            'signup_bonus' => 'gte:0',

            'trans_type' => 'required|in:fixed,percent',
            'trans_limit' => 'required|numeric',
            'trans_charge' => 'required|numeric',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',

            'withdraw_limit' => 'integer',
            'site_currency' => 'required|max:10',
            'currency_sym' => 'required',
            'logo' => [Rule::requiredIf(function () use ($general) {
                return $general == null;
            }), 'image', 'mimes:jpg,png,jpeg'],
            'icon' => [Rule::requiredIf(function () use ($general) {
                return $general == null;
            }), 'image', 'mimes:jpg,png,jpeg'],
            'login_image' => [Rule::requiredIf(function () use ($general) {
                return $general == null;
            }), 'image', 'mimes:jpg,png,jpeg'],
            'whitelogo' => [Rule::requiredIf(function () use ($general) {
                return $general == null;
            }), 'image', 'mimes:jpg,png,jpeg'],
        ]);

        if ($request->has('logo')) {

            $logo = 'logo' . '.' . $request->logo->getClientOriginalExtension();

            $request->logo->move(filePath('logo'), $logo);
        }

        if ($request->has('whitelogo')) {

            $whitelogo = 'whitelogo' . '.' . $request->whitelogo->getClientOriginalExtension();

            $request->whitelogo->move(filePath('logo'), $whitelogo);
        }

        if ($request->has('icon')) {

            $icon = 'icon' . '.' . $request->icon->getClientOriginalExtension();

            $request->icon->move(filePath('icon'), $icon);
        }
        if ($request->has('login_image')) {

            $login_image = 'login_image' . '.' . $request->login_image->getClientOriginalExtension();

            $request->login_image->move(filePath('login'), $login_image);
        }

        if ($request->has('frontend_login_image')) {

            $frontend_login_image = 'frontend_login_image' . '.' . $request->frontend_login_image->getClientOriginalExtension();

            $request->frontend_login_image->move(filePath('frontendlogin'), $frontend_login_image);
        }

        if ($request->has('breadcrumbs')) {

            $breadcrumbs = 'breadcrumbs' . '.' . $request->breadcrumbs->getClientOriginalExtension();

            $request->breadcrumbs->move(filePath('breadcrumbs'), $breadcrumbs);
        }

        if ($request->has('main')) {

            $main = 'main' . '.' . $request->main->getClientOriginalExtension();

            $request->main->move(filePath('main'), $main);
        }


        GeneralSetting::updateOrCreate([
            'id' => 1
        ], [
            'sitename' => $request->sitename,
            'refer_need' => $request->refer_need,
            'signup_bonus' => $request->signup_bonus,
            'site_currency' => $request->site_currency,
            'currency_sym' => $request->currency_sym,
            'user_reg' => $request->user_reg == 'on' ? 1 : 0,
            'is_email_verification_on' => $request->is_email_verification_on == 'on' ? 1 : 0,
            'is_sms_verification_on' => $request->is_sms_verification_on == 'on' ? 1 : 0,
            'logo' => isset($logo) ? ($logo ?? '') : GeneralSetting::first()->logo,
            'favicon' => isset($icon) ? ($icon ?? '') : GeneralSetting::first()->favicon,
            'login_image' => isset($login_image) ? ($login_image ?? '') : GeneralSetting::first()->login_image,
            'whitelogo' => isset($whitelogo) ? ($whitelogo ?? '') : GeneralSetting::first()->whitelogo,
            'primary_color' =>  $request->primary_color ?? '',
            'copyright' => $request->copyright,
            'map_link' => $request->map_link,
            'frontend_login_image' => isset($frontend_login_image) ? ($frontend_login_image ?? '') : GeneralSetting::first()->frontend_login_image,
            'breadcrumbs' => isset($breadcrumbs) ? ($breadcrumbs ?? '') : GeneralSetting::first()->breadcrumbs,
            'frontend_main_background_image' => isset($main) ? ($main ?? '') : GeneralSetting::first()->frontend_main_background_image,
            'withdraw_limit' => $request->withdraw_limit,

            'trans_type' => $request->trans_type,
            'trans_limit' => $request->trans_limit,
            'trans_charge' => $request->trans_charge,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,

            'user_kyc' => $request->user_kyc == 'on' ? 1 : 0,

        ]);

        $this->setEnv([
            'NEXMO_KEY' => $request->sms_username,
            'NEXMO_SECRET' => $request->sms_password,
            'APP_TIMEZONE' => $request->timezone
        ]);


        $notify[] = ['success', 'General setting has been updated.'];
        return back()->withNotify($notify);
    }

    public function setEnv(array $values)
    {

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {

                $str .= "\n";
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;
    }

    public function preloader()
    {
        $data['pageTitle'] = 'Preloader Setting';
        $data['navGeneralSettingsActiveClass'] = 'active';
        $data['subNavPreloaderActiveClass'] = 'active';

        $data['general'] = GeneralSetting::first();

        return view('backend.setting.preloader')->with($data);
    }

    public function preloaderUpdate(Request $request)
    {
        $general = GeneralSetting::first();

        $request->validate([
            'preloader_status' => 'required',
        ]);


        $general->preloader_status = $request->preloader_status;

        $general->save();



        $notify[] = ['success', "Preloader Updated Successfully"];

        return redirect()->back()->withNotify($notify);
    }

    public function analytics()
    {
        $data['pageTitle'] = 'Google Analytics Setting';
        $data['navGeneralSettingsActiveClass'] = 'active';
        $data['subNavAnalyticsActiveClass'] = 'active';
        $data['general'] = GeneralSetting::first();

        return view('backend.setting.analytics')->with($data);
    }

    public function analyticsUpdate(Request $request)
    {
        $general = GeneralSetting::first();

        $data = $request->validate([
            'analytics_key' => 'required',
            'analytics_status' => 'required'
        ]);

        $general->update($data);


        $notify[] = ['success', "Analytics Updated Successfully"];

        return redirect()->back()->withNotify($notify);
    }

    public function cookieConsent()
    {
        $data['pageTitle'] = 'Cookie Consent';
        $data['navGeneralSettingsActiveClass'] = 'active';
        $data['subNavCookieActiveClass'] = 'active';
        $data['cookie'] = GeneralSetting::first();

        return view('backend.setting.cookie')->with($data);
    }

    public function cookieConsentUpdate(Request $request)
    {
        $data = $request->validate([
            'allow_modal' => 'required|integer',
            'button_text' => 'required|max:100',
            'cookie_text' => 'required'
        ]);

        GeneralSetting::updateOrCreate(['id' => 1], $data);

        $notify[] = ['success', "Cookie Consent Updated Successfully"];

        return redirect()->back()->withNotify($notify);
    }

    public function recaptcha()
    {
        $data['pageTitle'] = 'Google Recaptcha';
        $data['navGeneralSettingsActiveClass'] = 'active';
        $data['subNavRecaptchaActiveClass'] = 'active';

        $data['recaptcha'] = GeneralSetting::first();



        return view('backend.setting.recaptcha')->with($data);
    }

    public function recaptchaUpdate(Request $request)
    {
        $data = $request->validate([
            'allow_recaptcha' => 'required',
            'recaptcha_key' => 'required',
            'recaptcha_secret' => 'required'
        ]);

        GeneralSetting::updateOrCreate(['id' => 1], $data);

        $notify[] = ['success', "Recaptcha Updated Successfully"];

        return redirect()->back()->withNotify($notify);
    }

    public function liveChat()
    {
        $data['pageTitle'] = 'Twak To Live Chat Setting';
        $data['navGeneralSettingsActiveClass'] = 'active';
        $data['subNavLiveChatActiveClass'] = 'active';
        $data['twakto'] = GeneralSetting::first();

        return view('backend.setting.twakto')->with($data);
    }

    public function liveChatUpdate(Request $request)
    {
        $data = $request->validate([
            'twak_allow' => 'required',
            'twak_key' => 'required'
        ]);

        $twak = GeneralSetting::first();

        $twak->update($data);

        $notify[] = ['success', "Twak Updated Successfully"];

        return redirect()->back()->withNotify($notify);
    }

    public function seoManage()
    {
        $data['pageTitle'] = 'Manage SEO';
        $data['navGeneralSettingsActiveClass'] = 'active';
        $data['subNavSEOManagerActiveClass'] = 'active';
        $data['seo'] = GeneralSetting::first();

        return view('backend.setting.seo')->with($data);
    }

    public function seoManageUpdate(Request $request)
    {

        $general = GeneralSetting::first();

        $data = $request->validate([
            'seo_description' => 'required',
        ]);

        $general->update($data);

        $notify[] = ['success', "Seo Updated Successfully"];

        return redirect()->back()->withNotify($notify);
    }


    public function cacheClear()
    {

        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('optimize:clear');

        return back()->with('success', 'Caches cleared successfully!');
    }

    public function manageTheme()
    {
        $data['pageTitle'] = 'Manage Theme';
        return view('backend.setting.theme')->with($data);
    }

    public function themeUpdate($name)
    {
        $general = GeneralSetting::first();

        $general->theme = $name;

        $general->save();

        return redirect()->back()->with('success','Template Actived successfully');
    }

    // trading
    public function trading()
    {
        $data['pageTitle'] = 'trading Setting';
        $data['navTradingSettingsActiveClass'] = 'active';
        $data['subNavTradingSettingsActiveClass'] = 'active';
        $data['general'] = GeneralSetting::first();

        return view('backend.setting.trading_setting')->with($data);
    }

    public function tradingSettingUpdate(Request $request)
    {


        $trading = GeneralSetting::first();

        $request->validate([
            'coin_name' => 'required',
            'trading_bonus' => 'required|numeric',
            'trading_min_amount' => 'required|numeric',
            'profit_type' => 'required',
            'invest_end_time' => 'required',
        ]);

        if ($request->has('coin_image')) {

            $coin_image = 'coin_image' . '.' . $request->coin_image->getClientOriginalExtension();

            $request->coin_image->move(filePath('coin_image'), $coin_image);
        }

        GeneralSetting::updateOrCreate([
            'id' => 1
        ], [
            'coin_name' => $request->coin_name,
            'trading_bonus' => $request->trading_bonus,
            'trading_min_amount' => $request->trading_min_amount,
            'profit_type' => $request->profit_type,
            'invest_end_time' => $request->invest_end_time,
            'coin_image' => isset($coin_image) ? ($coin_image ?? '') : GeneralSetting::first()->coin_image,
        ]);

        $notify[] = ['success', 'Trading setting has been updated.'];
        return back()->withNotify($notify);
    }
}
