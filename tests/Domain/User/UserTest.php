<?php
declare(strict_types=1);

namespace Tests\Domain\User;

use App\Domain\User\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function userProvider()
    {
        return [
            [1, 'bill.gates', 'bill.gates@example.com'],
            [2, 'steve.jobs', 'steve.jobs@example.com'],
            [3, 'mark.zuckerberg', 'mark.zuckerberg@example.com'],
            [4, 'evan.spiegel', 'evan.spiegel@example.com'],
            [5, 'jack.dorsey', 'jack.dorsey@example.com'],
        ];
    }

    /**
     * @dataProvider userProvider
     * @param $id
     * @param $username
     * @param $email
     * @param $lastName
     */
    public function testGetters($id, $username, $email)
    {
        $user = new User($id, $username, $email);

        $this->assertEquals($id, $user->getId());
        $this->assertEquals($username, $user->getUsername());
        $this->assertEquals($email, $user->getEmail());
    }

    /**
     * @dataProvider userProvider
     * @param $id
     * @param $username
     * @param $email
     * @param $lastName
     */
    public function testJsonSerialize($id, $username, $email)
    {
        $user = new User($id, $username, $email);

        $expectedPayload = json_encode([
            'id' => $id,
            'username' => $username,
            'email' => $email,
        ]);

        $this->assertEquals($expectedPayload, json_encode($user));
    }
}
