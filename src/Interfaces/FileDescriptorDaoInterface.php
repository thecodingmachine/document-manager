<?php

namespace Mouf\Document\Manager\Exceptions;

use Psr\Http\Message\UploadedFileInterface;

interface FileDescriptorDaoInterface
{
    public function save(FileDescriptorInterface $fileDescriptor);
    
    public function find(array $data) :array;
    
    public function generate (UploadedFileInterface $uploadedFile, array $data) :FileDescriptorInterface;
    
    public function findByPath(string $path) :FileDescriptorInterface;
}
