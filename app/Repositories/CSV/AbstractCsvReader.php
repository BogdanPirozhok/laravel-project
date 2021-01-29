<?php


namespace App\Repositories\CSV;


use App\Exceptions\CustomException;
use Illuminate\Http\UploadedFile;
use League\Csv\Reader;
use function League\Csv\delimiter_detect;

abstract class AbstractCsvReader
{

    public ?Reader $reader = null;

    public array $delimiters = [';', ',', '|'];

    public ?UploadedFile $file = null;

    public int $headerOffset = 0;

    /**
     * AbstractCsvReader constructor.
     * @param UploadedFile $file
     * @param array|null $delimiters
     * @param int $headerOffset
     * @throws \League\Csv\Exception
     */
    public function __construct(
        UploadedFile $file,
        array $delimiters = null,
        int $headerOffset = 0
    )
    {
        $this->file = $file;

        if($delimiters !== null) {
            $this->delimiters = $delimiters;
        }

        $this->headerOffset = $headerOffset;

        $this->setReader($this->file);
        $this->updateDelimiters();
        $this->setHeaderOffset();
    }

    /**
     * @var AbstractCsvReader|null
     */
    protected static ?AbstractCsvReader $instance = null;

    abstract public function work();

    /**
     * @param UploadedFile $file
     * @return AbstractCsvReader
     */
    protected function setReader(UploadedFile $file): AbstractCsvReader
    {
        $this->reader = Reader::createFromPath($file->getPathname(), 'r');

        return $this;
    }

    /**
     * @param array $delimiters
     * @return $this
     * @throws \Exception
     */
    protected function setDelimiters(array $delimiters): AbstractCsvReader
    {
        if ($this->reader === null) {
            throw new \Exception('Reader not exists');
        }
        $this->delimiters = $delimiters;

        return $this;
    }

    /**
     * @return $this
     * @throws \League\Csv\Exception
     */
    protected function setHeaderOffset(): AbstractCsvReader
    {
        $this->reader->setHeaderOffset($this->headerOffset);

        return $this;
    }

    /**
     * @throws \League\Csv\Exception
     */
    protected function updateDelimiters()
    {
        $delimiters =  delimiter_detect($this->reader, [';', ',', '|'], 1);

        foreach ($delimiters as $key => $delimiter) {
            $delimiter !== 0 ? $this->reader->setDelimiter($key) : null;
        }

    }

    protected function findColumns(): array
    {
        $errors = [];
        $header = $this->reader->getHeader();

        $needles = [];

        foreach ($this->getDefaultColumns() as $column => $callback) {
            $index = array_search($column, $header, true);
            $index === false ?
                $errors[$column] = __('map.csv.column.not_found', ['column' => $column]) :
                $needles[$column] = [
                    'index'    => $index,
                    'callback' => $callback,
                ];
        }

        if (count($errors)) {
            throw new CustomException(implode(', ', $errors), 422);
        }


        return $needles;
    }

}
