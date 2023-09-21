<?php


if (!function_exists('privacy_policy')) {
    function privacy_policy(array $dictionary, \App\Language $language)
    {
        if ($dictionary['footer_has_privacy_policy_page'] != '-') {
            return route('site.show_page', ['languageUrl' => $language->uri, 'pageUrl' => 'privacy-policy']);
        }
        return $dictionary['footer_policy_href'];
    }
}
