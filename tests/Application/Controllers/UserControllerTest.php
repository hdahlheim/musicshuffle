<?php
declare(strict_types=1);

namespace Tests\Application\Controllers\UserController;

use App\Domain\User\UserRepository;
use App\Domain\User\User;
use DI\Container;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testIndex()
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $user = new User(1, 'bill.gates', 'Bill', 'Gates');

        $userRepositoryProphecy = $this->prophesize(UserRepository::class);
        $userRepositoryProphecy
            ->findAll()
            ->willReturn([$user])
            ->shouldBeCalledOnce();

        $container->set(UserRepository::class, $userRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/users');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload = ['data' => [$user]];
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }

    public function testShow()
    {
        $app = $this->getAppInstance();

        /** @var Container $container */
        $container = $app->getContainer();

        $user = new User(1, 'bill.gates', 'Bill', 'Gates');

        $userRepositoryProphecy = $this->prophesize(UserRepository::class);
        $userRepositoryProphecy
            ->findUserOfId(1)
            ->willReturn($user)
            ->shouldBeCalledOnce();

        $container->set(UserRepository::class, $userRepositoryProphecy->reveal());

        $request = $this->createRequest('GET', '/users/1');
        $response = $app->handle($request);

        $payload = (string) $response->getBody();
        $expectedPayload =  ['data' => $user];
        $serializedPayload = json_encode($expectedPayload, JSON_PRETTY_PRINT);

        $this->assertEquals($serializedPayload, $payload);
    }
}
