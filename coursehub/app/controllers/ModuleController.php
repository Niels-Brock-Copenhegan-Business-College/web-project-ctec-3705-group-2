<?php
declare(strict_types=1);
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

/**
 * ModuleController — Handles module listing (all and by programme),
 * and individual module detail pages.
 * All actions are logged via Monolog for audit purposes.
 */

class ModuleController
{
    private ModuleModule    $module;
    private ModuleView      $view;
    private LoggerInterface $logger;

    public function __construct(ModuleModule $module, ModuleView $view, LoggerInterface $logger)
    {
        $this->module = $module;
        $this->view   = $view;
        $this->logger = $logger;
    }

    public function listAll(Request $req, Response $res): Response
    {
        // TODO: Add logging here
        $modules = $this->module->getAllModules();
        // TODO: Add logging here
        $res->getBody()->write($this->view->renderAllModules($modules));
        return $res;
    }

    public function listByProgramme(Request $req, Response $res, array $args): Response
    {
        $pid = (int)$args['id'];
        // TODO: Add logging here
        $modules = $this->module->getModulesByProgrammeId($pid);
        $res->getBody()->write($this->view->render($modules, $pid));
        return $res;
    }

    public function show(Request $req, Response $res, array $args): Response
    {
        $id = (int)$args['id'];
        $m  = $this->module->getModuleById($id);
        if (!$m) {
            // TODO: Add logging here
            $_SESSION['flash_error'] = 'Module not found.';
            return $res->withHeader('Location', '/modules')->withStatus(302);
        }
        // TODO: Add logging here
        $programmes = $this->module->getProgrammesForModule((int)$m['id']);
        $res->getBody()->write($this->view->renderModuleDetail($m, $programmes));
        return $res;
    }
}
