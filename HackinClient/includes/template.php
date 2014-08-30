<?php

/**
 * This class is mainly used for loading the required pages to the site.
 * This avoids unwanted trouble with the manual inclusion of files.
 *
 * @author DeltaTiger
 */
class Template {
    //This holds the name of the page we want to load.
    private $pageName;
    private $pageTitle;
    private $templateVars;
	private $rootPath;
    //This is the constructor of template class. Nothing much to do.
    function __construct() {
		$this->rootPath = $_SERVER['DOCUMENT_ROOT'].'/HackinNew/HackinClient/';
        $this->pageName = '';
    }
    //This function is used to set the page name.
    public function setPage($page)  {
        if (trim($page) != '')  {
            $this->pageName = $page;
            return true;
        }
        return false;
    }
    //This function is used to set the variables used in the template files.
    public function setTemplateVars($varsArray) {
        if (is_array($varsArray))   {
            foreach ($varsArray as $varName => $varValue)   {
                $this->templateVars[$varName] = $varValue;
            }
        }
    }
    //Used for setting a single variable of So
    public function setTemplateVar($varName, $varValue) {
        $this->templateVars[$varName] = $varValue;
    }
    
    //This function is used to check if a template variable is set and print it.
    public function printVar($varName)  {
        if ( isset($this->templateVars[$varName]) )     {
            echo $this->templateVars[$varName];
        }
    }
    
    public function getVar($varName)    {
        if ( isset($this->templateVars[$varName]) )     {
            return $this->templateVars[$varName];
        }
    }
    
    //This function is used to load the whole page where required.
    public function loadPage()  {
		//First we decide whether the page is an admin page or not.
		global $session, $user;
		
		//We just set the username for the current session or "Guest"
		$teamName = $authHandler->get('team_name');
		$this->setTemplateVar("username", ($teamName == NULL ? $teamName : 'Guest'));
		
		//Now we load all the pages.
		include $this->rootPath.'templates/header.php';
		include $this->rootPath.'templates/user_navbar.html';
		include $this->rootPath.'templates/'.$this->pageName.'.php';
		include $this->rootPath.'templates/footer.html';
    }
    
    //This function is used to set the page title.
    public function setPageTitle($pageTitle)  {
        $this->pageTitle = $pageTitle;
    }
    
    //This function is used to get the page title for the template page.
    private function getPageTitle() {
        return $this->pageTitle;
    }
}

?>