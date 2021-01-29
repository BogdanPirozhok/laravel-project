<?php


namespace App\Repositories\ManagerMailer;


use App\Models\ManagerMailingList;

/**
 * Class MailerManager
 * @package App\Repositories\ManagerMailer
 * @method AbstractMailer mail($model)
 */
class MailerManager
{
    private array $mailers = [
        ManagerMailingList::VACANCY => VacancyMailer::class,
        ManagerMailingList::TENDER  => TenderMailer::class,
        ManagerMailingList::CONTACT => ContactMailer::class,
        ManagerMailingList::QUALITY => QualityMailer::class,
        ManagerMailingList::CATALOG => CatalogMailer::class,
    ];

    public AbstractMailer $instance;


    /**
     * ManagerMailer constructor.
     * @param int $type
     * @throws \Exception
     */
    public function __construct(int $type)
    {
        $this->instance = $this->getInstance($type);
    }


    /**
     * @param int $type
     * @return mixed
     * @throws \Exception
     */
    protected function findStrategy(int $type): AbstractMailer
    {
        if (array_key_exists($type, $this->mailers)) {
            $this->instance = new $this->mailers[$type];
            return $this->instance;
        } else {
            throw new \Exception('Mailer not found');
        }
    }


    /**
     * @param int $type
     * @return AbstractMailer|mixed
     * @throws \Exception
     */
    public function getInstance(int $type): AbstractMailer
    {
        return $this->findStrategy($type);
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     * @throws \ReflectionException
     */
    public function __call($method, $arguments)
    {
        $reflector = new \ReflectionClass($this->instance);
        if($reflector->hasMethod($method)) {
            return $this->instance->{$method}(...$arguments);
        } else {
            throw new \BadMethodCallException(sprintf(
                'Method %s::%s does not exist.', $reflector->getName(), $method
            ));
        }
    }

}
