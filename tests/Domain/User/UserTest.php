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
            [1, 'bill.gates', 'Bill', 'Gates'],
            [2, 'steve.jobs', 'Steve', 'Jobs'],
            [3, 'mark.zuckerberg', 'Mark', 'Zuckerberg'],
            [4, 'evan.spiegel', 'Evan', 'Spiegel'],
            [5, 'jack.dorsey', 'Jack', 'Dorsey'],
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
