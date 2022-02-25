<?php

namespace Nemke\Crawler;

use Nemke\Db\Mysql;

class StatusCheck
{

    /** @var Mysql  */
    public $database;

    public function __construct()
    {
        $this->database = Mysql::getInstance();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getSingleUrl()
    {
        $url = $this->database->select("urls","status = 'NEW'");
        if ($url === false || !isset($url['url'])) {
            throw new \Exception('No new urls');
        }
        $result = $this->database->update("urls", "status = 'PROCESSING'", "id={$url['id']}");
        if ($result === false) {
            throw new \Exception('Unable to update status of the url');
        }

        return $url;
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testSingleUrl()
    {
        $url = $this->getSingleUrl();

        $handle = \curl_init($url['url']);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, true);
        curl_exec($handle);
        $response = (int)\curl_getinfo($handle,  CURLINFO_HTTP_CODE);
        $this->updateStatus($url, $response);
    }

    /**
     * @param array $url
     * @param int $response
     * @return void
     */
    public function updateStatus(array $url, int $response)
    {
        $status = $response == 0 ?  'ERROR' : 'DONE';
        $this->database->update("urls", "status = '$status', http_code=$response", "id={$url['id']}");
    }
}