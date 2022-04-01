<?php

namespace Utils;

class Browser
{
    public function userAgent(): string
    {
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            return $_SERVER['HTTP_USER_AGENT'];
        }
    }

    public function operatingSystem(): string
    {
        $OS_Platform = 'Unknown OS Platform';
        $OS_Arr = [
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/windows nt 5.0/i' => 'Windows 2000',
            '/windows me/i' => 'Windows ME',
            '/win98/i' => 'Windows 98',
            '/win95/i' => 'Windows 95',
            '/win16/i' => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile',
            '/x11/i' => 'ChromeOS'
        ];

        foreach ($OS_Arr as $RegEx => $Value) {
            if (preg_match($RegEx, $this->userAgent())) {
                return $Value;
            }
        }
    }

    public function browser(): string
    {
        $Browser_Arr = [
            '/msie/i' => 'Internet Explorer',
            '/firefox/i' => 'Firefox',
            '/safari/i' => 'Safari',
            '/chrome/i' => 'Chrome',
            '/edge/i' => 'Edge',
            '/opera/i' => 'Opera',
            '/netscape/i' => 'Netscape',
            '/maxthon/i' => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i' => 'Handheld/Mobile Browser'
        ];

        foreach ($Browser_Arr as $RegEx => $Value) {
            if (preg_match($RegEx, $this->userAgent())) {
                return $Value;
            }
        }
    }

    public function ip(): string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_HOST'])) { // is used for host name, dont use for ip
            return $_SERVER['REMOTE_HOST'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    public function getClientIpAddress()
    {
        # Initialization
        $searchList = "HTTP_CLIENT_IP,HTTP_X_FORWARDED_FOR,HTTP_X_FORWARDED,HTTP_X_CLUSTER_CLIENT_IP,HTTP_FORWARDED_FOR,HTTP_FORWARDED,REMOTE_ADDR";
        $clientIpAddress = "";

        # Loop through parameters
        $mylist = explode(',', $searchList);
        foreach ($mylist as $myItem) {
            # Is our list set?
            if (isset($_SERVER[trim($myItem)])) {
                # Loop through IP addresses
                $myIpList = explode(',', $_SERVER[trim($myItem)]);
                foreach ($myIpList as $myIp) {
                    if (filter_var(trim($myIp), FILTER_VALIDATE_IP)) {
                        # Set client IP address
                        $clientIpAddress = trim($myIp);

                        # Exit loop
                        break;
                    }
                }
            }

            # Did we find any IP addresses?
            if (trim($clientIpAddress) != "") {
                # Exit loop
                break;
            }
        }

        # Default (if needed)
        if (trim($clientIpAddress) == "") {
            # IP address was not found, use "Unknown"
            $clientIpAddress = "Unknown";
        }

        # Exit
        return $clientIpAddress;
    }

    public function hostname($ip): string
    {
        return gethostbyaddr($ip);
    }

    // MISC
    public function props()
    {
        echo '<b>Browser Class => Display Properties:</b>';
        echo '<pre>';
        print_r(get_object_vars(__CLASS__));
        echo '</pre>';
    }
}
