<?php

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bex\D7dull\ExampleTable;

Loc::loadMessages(__FILE__);

class bex_d7dull extends CModule
{
    public function __construct()
    {
        $arModuleVersion = array();
        
        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
        
        $this->MODULE_ID = 'marfamoduld7';
        $this->MODULE_NAME = Loc::getMessage('MARFAMODULD7_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('MARFAMODULD7_MODULE_DESCRIPTION');
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = Loc::getMessage('MARFAMODULD7_MODULE_PARTNER_NAME');
        $this->PARTNER_URI = 'http://marfa.ru';
    }

    public function doUninstall()
    {
        $this->uninstallDB();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            ExampleTable::getEntity()->createDbTable();
        }
    }


}
