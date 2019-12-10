<?php
declare(strict_types=1);

namespace App\Application\Controllers;

use App\Domain\User\UserRepository;
use DI\Container;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class UserController
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var \Slim\Views\Twig
     */
    protected $view;

    /**
     * @param UserRepository  $userRepository
     */
    public function __construct(Container $container, UserRepository $userRepository)
    {
        $this->view = $container->get('view');
        $this->userRepository = $userRepository;
    }

    /**
     * Show all users
     *
     * @param Request $req
     * @param Response $res
     * @return Response
     */
    public function index($req, $res): Response
    {
        $users = $this->userRepository->findAll();

        return $this->view->render($res, 'user_list.twig', compact("users"));

        // $json = json_encode([ 'data' => $users], JSON_PRETTY_PRINT);

        // $res->withStatus(200);
        // $res->getBody()->write($json);
        // return $res->withHeader('Content-Type', 'application/json');
    }


    /**
     * Show users
     *
     * @param Request $req
     * @param Response $res
     * @param array    $args
     * @return Response
     */
    public function show($req, $res, $args)
    {
        $userId = (int) $args['id'];
        $user = $this->userRepository->findUserOfId($userId);

        return $this->view->render($res, 'user.twig', compact("user"));

        // $json = json_encode([ 'data' => $user], JSON_PRETTY_PRINT);

        // $res->withStatus(200);
        // $res->getBody()->write($json);
        // return $res->withHeader('Content-Type', 'application/json');
    }
}
