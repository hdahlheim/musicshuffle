<?php
declare(strict_types=1);

namespace App\Application\Controllers;

// use App\Domain\User\UserRepository;
use DI\Container;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class PlaylistController
{
    /**
     * @var PlaylistRepository
     */
    protected $playlistRepository;

    /**
     * @var \Slim\Views\Twig
     */
    protected $view;

    /**
     * @param UserRepository  $playlistRepository
     */
    // public function __construct(Container $container, UserRepository $playlistRepository)
    public function __construct(Container $container)
    {
        $this->view = $container->get('view');
        // $this->userRepository = $playlistRepository;
    }

    /**
     * Show all playlists
     *
     * @param Request $req
     * @param Response $res
     * @return Response
     */
    public function index($req, $res): Response
    {
        $playlists = ['hsifsdhfaskfd', 'dfkjshjamnfg', 'lbgrjbg,fmnbnnnnnn'];
        // $users = $this->userRepository->findAll();

        return $this->view->render($res, 'playlists.twig', compact("playlists"));

    }


    /**
     * Show playlist
     *
     * @param Request $req
     * @param Response $res
     * @param array    $args
     * @return Response
     */
    public function show($req, $res, $args)
    {
        $playlistId = (int) $args['id'];

        return $this->view->render($res, 'playlist.twig', compact("playlist"));

    }
}
