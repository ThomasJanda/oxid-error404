<?php

namespace rs\error404\Core;

class Utils extends Utils_parent
{
    /**
     * handler for 404 (page not found) error
     *
     * @param string $sUrl url which was given, can be not specified in some cases
     */
    public function handlePageNotFoundError($sUrl = '')
    {
        $oConfig = $this->getConfig();
        \OxidEsales\Eshop\Core\Registry::getUtils()->redirect($oConfig->getShopHomeUrl(), false, 404);
    }


    /**
     * override complete function to add 404 header code
     *
     * redirect user to the specified URL
     *
     * @param string $sUrl               URL to be redirected
     * @param bool   $blAddRedirectParam add "redirect" param
     * @param int    $iHeaderCode        header code, default 302
     *
     * @return null or exit
     */
    public function redirect($sUrl, $blAddRedirectParam = true, $iHeaderCode = 302)
    {
        //preventing possible cyclic redirection
        //#M341 and check only if redirect parameter must be added
        if ($blAddRedirectParam && \OxidEsales\Eshop\Core\Registry::getConfig()->getRequestParameter('redirected')) {
            return;
        }

        if ($blAddRedirectParam) {
            $sUrl = $this->_addUrlParameters($sUrl, ['redirected' => 1]);
        }

        $sUrl = str_ireplace("&amp;", "&", $sUrl);

        switch ($iHeaderCode) {
            case 301:
                $sHeaderCode = "HTTP/1.1 301 Moved Permanently";
                break;
            case 500:
                $sHeaderCode = "HTTP/1.1 500 Internal Server Error";
                break;
            case 404:
                $sHeaderCode = "HTTP/1.0 404 Not Found";
                break;
            case 302:
            default:
                $sHeaderCode = "HTTP/1.1 302 Found";
        }

        $this->_simpleRedirect($sUrl, $sHeaderCode);

        try { //may occur in case db is lost
            $this->getSession()->freeze();
        } catch (\OxidEsales\Eshop\Core\Exception\StandardException $oEx) {
            $oEx->debugOut();
            //do nothing else to make sure the redirect takes place
        }

        $this->showMessageAndExit('');
    }
}
