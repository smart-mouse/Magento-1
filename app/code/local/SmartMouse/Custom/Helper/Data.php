<?php
class SmartMouse_Custom_Helper_Data extends Mage_Core_Helper_Abstract
{
    const IMAGE_URL = 'custom_games';

    public function getImageDir() {
        return self::IMAGE_URL;
    }

    public function getImageUrl($img) {
        return Mage::getStoreConfig('web/secure/base_url') . 'media' . DS . $img;
    }

    public function formatDate($date) {
        return date("M d (D)", strtotime($date));
    }
}