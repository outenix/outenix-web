<?php

namespace App\Utils;

use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;

class DeviceUtils
{
    public static function parseDeviceInfo(Request $request)
    {
        $agent = new Agent();
        $userAgent = $request->header('User-Agent');

        $deviceName = 'Unknown';
        if (preg_match('/iPhone/', $userAgent)) {
            $deviceName = 'iPhone';
        } elseif (preg_match('/iPad/', $userAgent)) {
            $deviceName = 'iPad';
        } elseif (preg_match('/Android/', $userAgent)) {
            $deviceName = 'Android';
        } elseif (preg_match('/Windows NT 10.0/', $userAgent)) {
            $deviceName = 'Windows 10';
        } elseif (preg_match('/Windows NT 6.1/', $userAgent)) {
            $deviceName = 'Windows 7';
        } elseif (preg_match('/Mac OS X/', $userAgent)) {
            $deviceName = 'Mac OS X';
        } elseif (preg_match('/Linux/', $userAgent)) {
            $deviceName = 'Linux';
        } elseif (preg_match('/CrOS/', $userAgent)) {
            $deviceName = 'Chrome OS';
        } elseif (preg_match('/Tablet/', $userAgent)) {
            $deviceName = 'Tablet';
        }

        return [
            'device_name' => $deviceName,
            'browser' => $agent->browser(),
            'device' => $agent->isDesktop() ? 'desktop' : ($agent->isMobile() ? 'mobile' : ($agent->isTablet() ? 'tablet' : 'unknown')),
            'platform' => $agent->platform(),
        ];
    }
}
