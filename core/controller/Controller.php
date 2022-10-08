<?php
namespace Core\Controller;

class Controller
{

    protected $viewPath;

    protected $template = 'main';

    public function __construct()
    {
        $this->viewPath = ROOT . '/public/views/';
    }

    protected function render($view, $variables = [])
    {
        ob_start();
        extract($variables);
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        require($this->viewPath . 'layout/' . $this->template . '.php' );
    }

    protected function notFound()
    {
        header("HTTP/1.0 404 Not Found");
        header('Location:index.php?p=404');
    }

    protected function forbidden()
    {
        header('HTTP/1.0 403 Forbidden');
        die('Acces interdit');
    }

    protected function redirect($page)
    {
        header("location: index.php?p=$page", true, 301);
        exit;
    }

}
