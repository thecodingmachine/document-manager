<?php
namespace Mouf\Document\Manager\Services;

use League\Flysystem\Filesystem;
use Mouf\Document\Manager\Interfaces\FileDescriptorDaoInterface;
use Mouf\Document\Manager\Interfaces\FileDescriptorInterface;
use Psr\Http\Message\UploadedFileInterface;

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
     * @param UploadedFileInterface $file
     * @param array $data
     */
    public function write(UploadedFileInterface $file, $data = [])
    {
        $fileDescritor = $this->fileDescriptorDao->generate($file, $data);
        $this->fileSystem->write($fileDescritor->getPath(), $file->getStream());
        $this->fileDescriptorDao->save($fileDescritor);
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