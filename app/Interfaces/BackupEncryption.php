<?php

namespace App\Interfaces;

use PhpZip\ZipFile;

interface BackupEncryption
{
    const ENCRYPTION_DEFAULT = ZipFile::ENCRYPTION_METHOD_TRADITIONAL;

    const ENCRYPTION_WINZIP_AES_128 = ZipFile::ENCRYPTION_METHOD_WINZIP_AES_128;

    const ENCRYPTION_WINZIP_AES_192 = ZipFile::ENCRYPTION_METHOD_WINZIP_AES_192;

    const ENCRYPTION_WINZIP_AES_256 = ZipFile::ENCRYPTION_METHOD_WINZIP_AES_256;
}
