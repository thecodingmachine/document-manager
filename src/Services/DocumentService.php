<?php
namespace Mouf\Document\Manager\Services;

use League\Flysystem\Filesystem;
use Mouf\Document\Manager\Interfaces\FileDescriptorDaoInterface;
use Mouf\Document\Manager\Interfaces\FileDescriptorInterface;
use Zend\Diactoros\UploadedFile;

class DocumentService
{
    /**
     * @var Filesystem
     */
    private $fileSystem;

    /**
     * @var FileDescriptorDaoInterface
     */
    private $fileDescriptorDao;

    public function __construct(Filesystem $filesystem, FileDescriptorDaoInterface $fileDescriptorDao)
    {
        $this->fileSystem = $filesystem;
        $this->fileDescriptorDao = $fileDescriptorDao;
    }

    /**
     * @param FileDescriptorInterface $fileDescriptor
     * @return bool|false|string
     */
    public function read(FileDescriptorInterface $fileDescriptor)
    {
        return $this->fileSystem->read($fileDescriptor->getPath());
    }

    /**
     * @param UploadedFile $file
     * @param array $data
     * @return bool
     */
    public function write(UploadedFile $file, $data = []) : bool
    {
        $fileDescritor = $this->fileDescriptorDao->generate($file, $data);
        return $this->fileSystem->write($fileDescritor->getPath(), $file->getStream());
    }

    /**
     * @param FileDescriptorInterface $fileDescriptor
     * @return bool
     */
    public function delete(FileDescriptorInterface $fileDescriptor) : bool
    {
        return $this->fileSystem->delete($fileDescriptor->getPath());
    }
}