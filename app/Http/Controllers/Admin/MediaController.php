<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use ctf0\MediaManager\App\Controllers\Modules\Delete;
use ctf0\MediaManager\App\Controllers\Modules\Download;
use ctf0\MediaManager\App\Controllers\Modules\GetContent;
use ctf0\MediaManager\App\Controllers\Modules\GlobalSearch;
use ctf0\MediaManager\App\Controllers\Modules\Lock;
use ctf0\MediaManager\App\Controllers\Modules\Move;
use ctf0\MediaManager\App\Controllers\Modules\NewFolder;
use ctf0\MediaManager\App\Controllers\Modules\Rename;
use ctf0\MediaManager\App\Controllers\Modules\Upload;
use ctf0\MediaManager\App\Controllers\Modules\Utils;
use ctf0\MediaManager\App\Controllers\Modules\Visibility;
use Jhofm\FlysystemIterator\Plugin\IteratorPlugin;
use ctf0\MediaManager\App\Controllers\MediaController as BaseMediaController;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaController extends BaseMediaController
{
    use Utils,
        GetContent,
        Delete,
        Download,
        Lock,
        Move,
        Rename,
        Upload,
        NewFolder,
        Visibility,
        GlobalSearch;

    protected $baseUrl;
    protected $db;
    protected $fileChars;
    protected $fileSystem;
    protected $folderChars;
    protected $ignoreFiles;
    protected $LMF;
    protected $GFI;
    protected $sanitizedText;
    protected $storageDisk;
    protected $storageDiskInfo;
    protected $unallowedMimes;

    public function __construct()
    {
        $config = app('config')->get('mediaManager');

        $this->fileSystem = $config['storage_disk'];
        $this->ignoreFiles = $config['ignore_files'];
        $this->fileChars = $config['allowed_fileNames_chars'];
        $this->folderChars = $config['allowed_folderNames_chars'];
        $this->sanitizedText = $config['sanitized_text'];
        $this->unallowedMimes = $config['unallowed_mimes'];
        $this->LMF = $config['last_modified_format'];
        $this->GFI = $config['get_folder_info'] ?? true;
        $this->paginationAmount = $config['pagination_amount'] ?? 50;

        $this->storageDisk = app('filesystem')->disk($this->fileSystem);
        $this->storageDiskInfo = app('config')->get("filesystems.disks.{$this->fileSystem}");
        $this->baseUrl = $this->storageDisk->url('/');
        $this->db = app('db')
            ->connection($config['database_connection'] ?? 'mediamanager')
            ->table($config['table_locked'] ?? 'locked');

        $this->storageDisk->addPlugin(new IteratorPlugin());
    }

    /**
     * main view.
     *
     * @return [type] [description]
     */
    public function index()
    {
        return view('backend.media.index');
    }

    protected function optimizeUpload(UploadedFile $file)
    {
        app(\Spatie\ImageOptimizer\OptimizerChain::class)->optimize($file->getPathname());
        return $file;
    }
}
