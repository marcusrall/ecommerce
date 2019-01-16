<?php
namespace Hcode;

use Rain\Tpl;

class Page{

    private $tpl;
    private $defaults = [
        "header" => true,
        "footer" => true,
        "data" => []
    ];
    private $options = [];

    public function __construct($opts = array(), $tpl_dir = "/views/"){
        
        $this->options = array_merge($this->defaults, $opts);
        
        $baseUrl = realpath($PHP_SELF);

        // config
        $config = array(
            "tpl_dir"       => $baseUrl.$tpl_dir,
            "cache_dir"     => $baseUrl."/views-cache/",
            "debug"         => false
        );

        Tpl::configure( $config );

        // create the Tpl object
        $this->tpl = new Tpl;

        $this->setData($this->options['data']);

        if($this->options["header"] === true) $this->tpl->draw("header");
        
    }


    private function setData($data = array())
    {
        foreach ($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }
    }

    public function setTpl($name, $data = array(), $returnHTML = false)
    {

      $this->setData($data);
      return $this->tpl->draw($name, $returnHTML);

    }



    public function __destruct(){
        if($this->options["footer"] === true)  $this->tpl->draw("footer");
    }
}

?>