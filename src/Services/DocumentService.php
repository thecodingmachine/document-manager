<?php
namespace Mouf\Document\Manager\Exceptions;

use League\Flysystem\Filesystem;

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

    public function __construct( Filesystem $filesystem, FileDescriptorDaoInterface $fileDescriptorDao)
    {
        $this->fileSystem = $filesystem;
        $this->fileDescriptorDao = $fileDescriptorDao;
    }
    
    //TODO : method write, read, delete 

}