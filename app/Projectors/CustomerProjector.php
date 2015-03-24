<?php namespace App\Projectors;

use App\Events\Customer\CustomerRegistered;
use App\Events\Customer\CustomerUpdatedProfile;

class CustomerProjector {

    /**
     * @var CustomerRepository
     */
    private $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function handle($event)
    {
        $class = new \ReflectionClass($event);
        $class_name = $class->getShortName();
        $this->$class_name($event);
    }
    
    public function customerRegistered(CustomerRegistered $event)
    {
        $this->repository->create(
            $event->getName(),
            $event->getSurname(),
            $event->getEmailAddress()
        );
    }
 
    public function customerUpdatedProfile(CustomerUpdatedProfile $event)
    {
        $this->repository->update(
            $event->customer_email,
            $event->getField(),
            $event->getValue()
        );
    }
}