<?php


namespace App\Helpers;


use Illuminate\Database\Eloquent\Model;
use UniSharp\LaravelFilemanager\Lfm;
use UniSharp\LaravelFilemanager\LfmPath;


/**
 * Trait LfmHelper
 * @package App\Helpers
 * @property LfmPath $lfm
 * @property Lfm $helper
 */
trait LfmHelper
{

    /**
     * @param $var_name
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    public function __get($var_name)
    {
        if ($var_name === 'lfm') {
            return app(LfmPath::class);
        } elseif ($var_name === 'helper') {
            return app(Lfm::class);
        } else {
            $reflector = new \ReflectionClass($this);
            if($reflector->isSubclassOf(Model::class)) {
                return parent::__get($var_name);
            }

        }
    }


    /**
     * @param Model $model | null
     * @param $file
     * @param $workDir
     * @param array $attr
     * @return array
     */
    private function handleFile($model, $file, $workDir, array $attr): array
    {
        $lfm = $this->lfm;
        $lfm->dir($workDir);

        $disc = config('lfm.disk');
        $fs = config('filesystems.disks.' . $disc);

        $this->deleteFile($model, $workDir, $attr);

        $fileName = $lfm->upload($file);
        $filePath = $fs['url'] . 'files' . $workDir . '/' . $fileName;

        return [
            'fileName' => $fileName ?? null,
            'filePath' => $filePath ?? null,
        ];
    }


    /**
     * @param $model
     * @param $workDir
     * @param array $attr
     * @return bool
     */
    public function deleteFile($model, $workDir, array $attr): bool
    {
        if (isset($model->{$attr['file_path']}) && isset($model->{$attr['file_name']})) {
            $lfm = $this->lfm;
            $lfm->dir($workDir);
            $lfm->setName($model->{$attr['file_name']});
            $lfm->delete();
        }
        return true;
    }
}
