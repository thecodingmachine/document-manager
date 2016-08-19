<?php

namespace Mouf\Document\Manager\Interfaces;

use Psr\Http\Message\UploadedFileInterface;

interface FileDescriptorDaoInterface
{
    public function save(FileDescriptorInterface $fileDescriptor);
    
    public function find(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL);
    
    public function generate(UploadedFileInterface $uploadedFile, array $data) :FileDescriptorInterface;
    
    public function findByPath(string $path) :FileDescriptorInterface;
}
