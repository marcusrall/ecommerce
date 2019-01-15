<?php
namespace Hcode;

use Rain\Tpl;

class Page{

    private $tpl;
    private $defaults = [
        "data" => []
    ];
    private $options = [];

    public function __construct($opts = array()){
        
        $this->options = array_merge($this->defaults, $opts);
        
        $baseUrl = realpath($PHP_SELF);

        // config
        $config = array(
            "tpl_dir"       => $baseUrl."/views/",
            "cache_dir"     => $baseUrl."/views-cache/",
            "debug"         => false
        );

        Tpl::configure( $config );

        // create the Tpl object
        $this->tpl = new Tpl;

        $this->setData($this->options['data']);

        $this->tpl->draw("header");
        
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
        $this->tpl->draw("footer");
    }
}

?>