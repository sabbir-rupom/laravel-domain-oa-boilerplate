<?php

namespace App\Library\Resource;

use App\Traits\Singleton;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FileStorage
{

    protected $config;
    private $_default = [
        'file_type' => 0,
        'path_prefix' => 'resources',
        'path' => 'resources',
        'date' => '',
        'disc' => 'public',
        'prefix' => '',
        'return' => '',
    ];

    use Singleton;

    public function __construct($options = null)
    {
        $this->initConfig($options);
    }

    /**
     * Initialize library configuration
     *
     * @param [mixed] $options
     * @return void
     */
    private function initConfig($options)
    {
        if (empty($options)) {
            $this->config = (object) $this->_default;
        } else {
            if (is_array($options)) {
                $this->config = (object) $options;
            } elseif (is_string($options) || is_numeric($options)) {
                $this->config->value = $options;
            }

            foreach ($this->_default as $key => $value) {
                if (isset($this->config->{$key})) {
                    continue;
                }
                $this->config->{$key} = $value;
            }
        }
        if (empty($this->config->date)) {
            $this->config->date = date('Ymd');
        }
        if (!empty($this->config->path_prefix)
            && $this->config->path_prefix != $this->config->path
            && !strstr($this->config->path, $this->config->path_prefix)) {
            $this->config->path = $this->config->path_prefix . '/' . trim($this->config->path, '/');
        }
        return;

    }

    /**
     * Update instance configuration
     *
     * @param array $config
     * @return \App\Library\Resource\FileStorage
     */
    public function setConfig(array $config)
    {
        $this->initConfig($config);
        return $this;
    }

    public function store($file)
    {
        if (empty($file)) {
            throw new Exception("Request file is empty");
        }

        return $this->upload($file);
    }

    public function replace($file)
    {

    }

    public static function remove(string $fileName)
    {
        if (!Storage::exists($fileName)) {
            return false;
        }

        return Storage::delete($fileName);

    }

    public function read()
    {
        # code...
    }

    public function renderHtml()
    {
        # code...
    }

    public function render()
    {
        $path = storage_path('app/public/resources/' . $this->config->path);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    private function upload($file)
    {
        if ($this->config->path == $this->config->prefix) {
            $this->config->prefix = '';
        }

        $uploadPath = "{$this->config->path}/{$this->config->date}" . (!empty($this->config->prefix) ? "/{$this->config->prefix}" : '');

        // config('filesystems')['default']

        $storagePath = Storage::put($uploadPath, $file);

        if (empty($storagePath)) {
            return false;
        }

        if ($this->config->return === 'fullpath') {
            // $storedFile = asset('storage/' . $storedFile);
        }

        return [
            'fullpath' => storage_path($storagePath),
            'path' => $storagePath
        ];

        return false;
    }

    public static function url($fileName = '')
    {
        if (empty($fileName)) {
            return url('/');
        }
        return Storage::url($fileName); //asset('storage/' . $fileName);
    }

    /**
     * Render view html based on resource file type

     *
     * @param string $file
     * @param integer $resourceType
     * @return void
     */
    public static function renderFile(string $file, int $resourceType)
    {
        $fileUrl = $type = '';
        return '';
        if (!Storage::exists($file)) {
        }
        // $video = $audio = $image = $pdf = $slider = false;
        // $type = 'image';
        // if (empty($type)) {
        //     return '';
        // }
        // $fileUrl = self::url($file);
        // $resourceMedia = ResourceMedia::where('file_path', $file)->first();

        // return view('raw.course.file-resource')->with([
        //     'url' => $fileUrl,
        //     'type' => $type,
        //     'media' => $resourceMedia,
        // ])->render();
    }

    /**
     *  Get file upload path
     *
     * @param string $path
     * @return string
     */
    public static function getUploadPath(string $path = ''): string
    {
        $uploadPath = Storage::getDriver()->getAdapter()->getPathPrefix() . trim($path, '/');
        if ($path == 'temp') {
            File::isDirectory($uploadPath) or File::makeDirectory($uploadPath, 0777, true, true);
        }
        return $uploadPath;
    }

    /**
     * Get file upload public url
     *
     * @return string
     */
    public static function getUploadUrl(string $path = ''): string
    {
        return Storage::url($path);
    }
}
