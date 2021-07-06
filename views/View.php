<?php
declare (strict_types = 1);
namespace views;

/**
 * class View - génère le html à partir d'un fichier view
 * @property $_file - le nom du fichier view
 */
class View
{
    private $_file;
    /**
     * __construct
     * @param  string $action - nom du fichier requis
     * @return void
     */
    public function __construct(string $action)
    {
        $directory = basename(getcwd());
        $path = ($directory == 'controllers' || $directory == 'views' || $directory == 'models') ? '../' : '';
        $this->_file = $path . 'views/view' . $action . '.php';
    }
    /**
     * generate - génère le contenu de la view
     * @param  array $data - les données
     * @return void
     */
    public function generate(array $data)
    {
        $content = $this->generateFile($this->_file, $data);
        return $content;
    }
    /**
     * generateTemplate - génère et affiche le fichier "views/template.php"
     * @param  array $content - le contenu à incorporer au template
     * @return void
     */
    public function generateTemplate(array $content)
    {
        $view = $this->generateFile('views/template.php', array('content' => $content));
        echo $view;
    }
    /**
     * generateFile - génère un fichier view et renvoie le résultat produit
     * @param  string $file - chemin du fichier à générer
     * @param  array $data - les données à inclure
     * @return void
     */
    private function generateFile(string $file, array $data)
    {
        if (file_exists($file)) {
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        } else {
            throw new Exception('fichier' . $file . 'introuvable');
        }
    }
}
