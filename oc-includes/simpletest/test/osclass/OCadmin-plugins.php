<?php
require_once dirname(__FILE__).'/../../../../oc-load.php';

//require_once('FrontendTest.php');

class OCadmin_plugins extends OCadminTest {

    private $plugin = "plugins_breadcrumbs_2.0.zip" ;
    
    /*
     * Login oc-admin
     * UPLOAD / INSTALL / CONFIGURE / DISABLE / ENABLE / UNINSTALL PLUGIN
     */
    function testPluginsUpload()
    {
        
        // UPLOAD
        $this->loginWith();
        $this->selenium->open( osc_admin_base_url(true) ) ;
        $this->selenium->click("link=Plugins");
        $this->selenium->click("link=Add new plugin");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->type("package", $this->selenium->_path(LIB_PATH."simpletest/test/osclass/plugins_breadcrumbs_2.0.zip") );
        $this->selenium->click("//input[@type='submit']");
        $this->selenium->waitForPageToLoad("10000");
        $this->assertTrue($this->selenium->isTextPresent("The plugin has been uploaded correctly"),"Upload plugin $this->plugin");
    }
        
    function testPluginsInstall()
    {
        // INSTALL
        $this->loginWith();
        $this->selenium->open( osc_admin_base_url(true) ) ;
        $this->selenium->click("link=Plugins");
        $this->selenium->click("link=Manage plugins");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->click("//table[@id='datatables_list']/tbody/tr/td/a[@href[contains(.,'breadcrumbs')] and text()='Install']");
        $this->selenium->waitForPageToLoad("10000");
        $this->assertTrue($this->selenium->isTextPresent("Plugin installed"),"Install plugin $this->plugin");
    }
        
    function testPluginsConfigure()
    {
        // CONFIGURE
        $this->loginWith();
        $this->selenium->open( osc_admin_base_url(true) ) ;
        $this->selenium->click("link=Plugins");
        $this->selenium->click("link=Manage plugins");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->click("//table[@id='datatables_list']/tbody/tr/td/a[@href[contains(.,'breadcrumbs')] and text()='Configure']");
        $this->selenium->waitForPageToLoad("10000");
        $this->assertTrue($this->selenium->isTextPresent("Breadcrumbs Help"),"Configure plugin $this->plugin");
    }
        
    function testPluginsDisable()
    {
        // DISABLE
        $this->loginWith();
        $this->selenium->open( osc_admin_base_url(true) ) ;
        $this->selenium->click("link=Plugins");
        $this->selenium->click("link=Manage plugins");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->click("//table[@id='datatables_list']/tbody/tr/td/a[text()='Disable' and @href[contains(.,'breadcrumbs')]]");
        $this->selenium->waitForPageToLoad("10000");
        $this->assertTrue($this->selenium->isTextPresent("Plugin disabled"),"Disable plugin $this->plugin");
    }
        
    function testPluginsEnable()
    {
        // ENABLE
        $this->loginWith();
        $this->selenium->open( osc_admin_base_url(true) ) ;
        $this->selenium->click("link=Plugins");
        $this->selenium->click("link=Manage plugins");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->click("//table[@id='datatables_list']/tbody/tr/td/a[text()='Enable' and @href[contains(.,'breadcrumbs')]]");
        $this->selenium->waitForPageToLoad("10000");
        $this->assertTrue($this->selenium->isTextPresent("Plugin enabled"),"Enable plugin $this->plugin");
    }
        
    function testPluginsUninstall()
    {
        // UNINSTALL
        $this->loginWith();
        $this->selenium->open( osc_admin_base_url(true) ) ;
        $this->selenium->click("link=Plugins");
        $this->selenium->click("link=Manage plugins");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->click("//table[@id='datatables_list']/tbody/tr/td/a[text()='Uninstall' and @href[contains(.,'breadcrumbs')]]");
        $this->selenium->waitForPageToLoad("10000");
        $this->assertTrue($this->selenium->isTextPresent("Plugin uninstalled"),"Uninstall plugin $this->plugin");
        $this->deletePlugin();
    }
    
    
    private function deletePlugin() {
        $path = CONTENT_PATH . "plugins/breadcrumbs/";
        $dir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);
        for ($dir->rewind(); $dir->valid(); $dir->next()) {
            if ($dir->isDir()) {
                if ($dir->getFilename() != '.' && $dir->getFilename() != '..') {
                    rmdir($dir->getPathname());
                }
            } else {
                unlink($dir->getPathname());
            }
        }
    }


}
?>