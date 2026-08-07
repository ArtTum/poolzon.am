<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;


class Helper
{

    public static function languageUrl(){

        $languages = DB::table('lang')->get();
        $locale = App::getLocale();
        $language =  DB::table('lang')->where('iso', $locale)->first();

        if(empty($language)){
            abort(404);
        }



        $url = $language->iso == 'am' ? Request::path() : substr_replace(Request::path(), '', 0,2);


        $result = [];
        foreach($languages as $lang){
            if($lang->iso == 'am'){

                $result[] = [
                    'url' => ($url == '/' || $url == '') ?  url('/') : url($url),
                    'lang_name' => $lang->lang_name,
                    'iso' => $lang->iso,
                ];

            }else{
                $result[] = [
                    'url' => $url == '/' ? url($lang->iso) :  url(str_replace('//','/', $lang->iso.'/'.$url)),
                    'lang_name' => $lang->lang_name,
                    'iso' => $lang->iso,
                ];
            }
        }

       // dd($result);

        return $result;
    }

    /**
     * @param null $url
     * @return string
     */
    public static function lang($url = null){

        if(App::getLocale() == 'am'){
            $result = $url ? '/'.$url: '/';
        }else{
            $result = $url ? '/'.App::getLocale().'/'.$url : '/'.App::getLocale();
        }

        return $result;
    }

    /**
     * @param bool $date
     * @param bool $format
     * @return array|null|string
     */
    public function changeDateFormat($date = false, $format = false){

		switch ($format) {
			case 'm/d/y':
				if(!$date)return null;
				$dateArray = explode('/', $date);
				$year = $dateArray[2];
				$month = $dateArray[1];
				$day = $dateArray[0];
				return \Carbon\Carbon::createFromDate($year, $day, $month)->toDateTimeString();
			break;
			case 'timestemp':
				if(!$date)return '';
				$dt = \Carbon\Carbon::parse($date);
				if(!$dt)return '';

				$month = (strlen($dt->month) == 1) ? '0'.$dt->month : $dt->month;
				$year = (strlen($dt->year) == 1) ? '0'.$dt->year : $dt->year;
				$day = (strlen($dt->day) == 1) ? '0'.$dt->day : $dt->day;

				return $month.'/'.$day.'/'.$year;
			break;
			case 'dayMonth':
				if(!$date)return '';
				$dt = \Carbon\Carbon::parse($date);
				if(!$dt)return '';

				$months = array (1=>trans('app.month_jan'),2=>trans('app.month_feb'),3=>trans('app.month_mar'),4=>trans('app.month_apr'),5=>trans('app.month_may'),6=>trans('app.month_jun'),7=>trans('app.month_jul'),8=>trans('app.month_aug'),9=>trans('app.month_sep'),10=>trans('app.month_oct'),11=>trans('app.month_nov'),12=>trans('app.month_dec'));
				$month = $months[$dt->month];
				$day = $dt->day;

				return  array('day' => $day,'month' => $month );
			break;
			default:
				return null;
			break;
		}

		return null;
	}

    /**
     * @param $response
     * @return bool
     */
    public function recaptchaCheck($response)
    {
        $parameters = http_build_query([
            'secret'   => value(env('RECAPTCHA_SECRET')),
            'response' => $response,
        ]);
        $url = 'https://www.google.com/recaptcha/api/siteverify?' . $parameters;
        $checkResponse = null;

        // prefer curl, but fall back to file_get_contents
        if (function_exists('curl_version')) {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $checkResponse = curl_exec($curl);
        } else {
            $checkResponse = file_get_contents($url);
        }
        if (is_null($checkResponse) || empty( $checkResponse )) {
            return false;
        }
        $decodedResponse = json_decode($checkResponse, true);

        return $decodedResponse['success'];
    }

    /**
     * @param $text
     * @param $limit
     * @return string
     */
    public function limit_text($text, $limit) {
		$text = strip_tags($text);
		if (str_word_count($text, 0) > $limit)
		{
		  $words = str_word_count($text, 2);
		  $pos = array_keys($words);
		  $text = substr($text, 0, $pos[$limit]) . '...';
		}
		return $text;
    }


    /**
     * @param $type
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    public static function translatePaymentTypesCsv($type)
	{
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $locale = Session::get('currentLanguage');//$_SESSION["currentLanguage"];

        switch (strtolower($type)) {
            case 'account':
                $translatedType = trans('app.calc_delivery_method_account', [], 'messages', $locale);
                break;
            case 'card':
                $translatedType = trans('app.calc_delivery_method_card', [], 'messages', $locale);
                break;
            case 'cash collection':
                $translatedType = trans('app.calc_delivery_method_cash_collection', [], 'messages', $locale);
                break;
            case 'home delivery':
                $translatedType = trans('app.calc_delivery_method_home_delivery', [], 'messages', $locale);
                break;
            case 'mobile transfer':
                $translatedType = trans('app.calc_delivery_method_mobile_transfer', [], 'messages', $locale);
                break;
            case 'utility_bill':
                $translatedType = trans('app.calc_delivery_method_utility_bill', [], 'messages', $locale);
                break;
            default:
                return "";
        }
        return $translatedType;
	}

    /**
     * @return array
     */
    public static function getLocales()
    {
        return [
          1 => 'am',
          2 => 'ru',
          3 => 'en',
        ];
    }

}
