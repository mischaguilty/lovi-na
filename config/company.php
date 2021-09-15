<?php
if (!function_exists('company')) {
    function company()
    {
        return \App\Models\Company::find(1);
    }
}
