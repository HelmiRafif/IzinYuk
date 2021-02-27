<?php

namespace App\Libraries;

include_once('Vendor/OpenTBS/tbs_class.php'); // Load the TinyButStrong template engine
include_once('Vendor/OpenTBS/tbs_plugin_opentbs.php'); // Load the OpenTBS plugin

class OpenTBS
{

    private $tbs;
    private $template_name;

    public function __construct($template)
    {
        $this->tbs = new \clsTinyButStrong(); // new instance of TBS
        $this->tbs->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin
        $this->tbs->LoadTemplate($template, OPENTBS_ALREADY_UTF8);
        $this->template_name = $template;
    }

    public static function loadTemplate($template)
    {
        return new static($template);
    }

    public function download($output_file_name = FALSE)
    {
        $this->tbs->Show(OPENTBS_DOWNLOAD, $output_file_name ? $output_file_name : basename($this->template_name));
    }
    
    public function downloadString()
    {
        $this->tbs->Show(OPENTBS_STRING);
        return $this->tbs->Source;
    }

    public function mergeBlock($BlockLst, $SrcId = 'assigned', $Query = '', $QryPrms = false)
    {
        $this->tbs->MergeBlock($BlockLst, $SrcId, $Query, $QryPrms);
    }

    public function MergeField($NameLst, $Value = 'assigned', $IsUserFct = false, $DefaultPrm = false)
    {
        $this->tbs->MergeField($NameLst, $Value, $IsUserFct, $DefaultPrm);
    }

    public function PlugIn($Prm1, $Prm2 = 0)
    {
        return call_user_func_array([$this->tbs, "PlugIn"], func_get_args());
    }
    
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->tbs, $name], $arguments);
    }

}
