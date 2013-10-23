<?php
namespace Guest\BookBundle\Libraries;

class RepositoryData
{
    const PATH = '../data/GuestBook.txt';

    public function getAll()
    {
        $data = file_get_contents(self::PATH);
        return ($data != '')? unserialize($data) : [];
    }
    public function add(\Guest\BookBundle\Entity\Guest $eb)
    {
        $data = $this->getAll();
        array_unshift($data, $eb);
        file_put_contents(self::PATH, serialize($data));
    }
}