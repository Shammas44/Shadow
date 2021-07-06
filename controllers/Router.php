<?php
declare (strict_types = 1);
namespace controllers;

/**
 * class Router - permet de charger une page en fonction de l’action de l’utilisateur (par la superglobale GET)
 */
class Router
{
    private $_ctrl;
    private $_view;

    public function routeReq()
    {
        try {
            $url = '';
            if (isset($_GET['url'])) {
                $url = explode('/', filter_var($_GET['url'],
                    FILTER_SANITIZE_URL));

                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = '\controller\Controller' . $controller;
                $controllerFile = 'controllers/' . $controllerClass . '.php';

                if (file_exists($controllerFile)) {
                    $this->_ctrl = new $controllerClass($url);
                } else {
                    throw new Exception('Page introuvable');
                }
            } else {
                $this->_ctrl = new \controllers\ControllerAccueil($url);
            }
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            $this->_view = new \views\View('Error');
            $content = $this->_view->generate(array('errorMsg' => $errorMsg));
            $this->_view->generateTemplate($content);
        }
    }
}
