<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 31.08.2023
 * Time: 15:36
 */
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class ProjectTest extends TestCase
{
    public function testMainPage()
    {
        $client = new Client();
        $response = $client->get('http://testtaskturboweb');
        $statusCode = $response->getStatusCode();
        $content = $response->getBody()->getContents();

        $this->assertEquals(200, $statusCode);
    }

    public function testMakeCommand()
    {
        $data = [
            'command' => "mops sound", // Your POST data here
        ];
        $content = $this->makeDogCommandRequest($data);

        $this->assertStringContainsString('woof! woof!', $content);
        $this->assertStringContainsString('Пііп!! Піі!!', $content);
        $this->assertStringContainsString('Cобака "Плюшевий лабрадор" не може робити звуки.', $content);
    }

    public function testMakeMissingCommand()
    {
        $data = [
            'command' => "test", // Your POST data here
        ];
        $content = $this->makeDogCommandRequest($data);

        $this->assertStringNotContainsString('woof! woof!', $content);
    }

    public function testMakeCommand3()
    {
        $data = [
            'command' => "hunt", // Your POST data here
        ];
        $content = $this->makeDogCommandRequest($data);

        $this->assertStringContainsString('Cобака "Плюшевий лабрадор" не може полювати.', $content);
        $this->assertStringContainsString('Cобака "Сіба-іну" пішла на полювання.', $content);
        $this->assertStringNotContainsString('Cобака "Гумова такса з пищалкою" пішла на полювання.', $content);
    }

    public function testMakeCommandWithWrongParameter()
    {
        $data = [
            'command1' => "hunt", // Your POST data here
        ];
        $content = $this->makeDogCommandRequest($data);

        $this->assertEquals("", $content);
    }

    private function makeDogCommandRequest($data)
    {
        $client = new Client();
        $url = 'http://testtaskturboweb/api/run_command'; // Replace with your API endpoint URL

        $response = $client->get($url, [
            'query' => $data,
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getBody()->getContents();

        $this->assertEquals(200, $statusCode);

        return $content;
    }
}