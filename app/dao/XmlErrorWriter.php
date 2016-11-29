<?php
declare(strict_types=1);
namespace app\dao;
class XmlErrorWriter implements Observer {

    /*
     * vérifier php.ini
     * 
     */

    private $file = null;
    public function __construct($file){
        $this->file = $file;
    }
    public function update($value)
    {
        // TODO: Implement update() method.
        $root = \simplexml_load_file($this->file);
        $account = $root->addChild("error");
        $now = new \DateTime();
        $account->addAttribute("date",$now->format('Y-m-d H:i:s'));
        $account->addchild(utf8_encode("message"),$value);
        // voir problème encodage ...
        // rajouter la possibilité de mieux structurer le fichier xml
        // retour à la ligne après ajout de la balise error
        // $root->asXml($this->file);

        $xml = $root->asXML( );
        $config = array(
            'indent' => true,
            'output-xml' => true,
            'input-xml' => true
        );
        $tidy = new \tidy();
        // voir si extension php_tidy.dll dans php.ini
        $tidy->parseString($xml, $config);
        $tidy->cleanRepair();
        file_put_contents($this->file,tidy_get_output($tidy));
    }
}