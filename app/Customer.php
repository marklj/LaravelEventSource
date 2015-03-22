<?php namespace App;

use App\Events\Customer\CustomerRegistered;
use App\Events\Customer\CustomerUpdatedProfile;
use App\EventSource\BaseAggregate;

class Customer extends BaseAggregate {

    protected $name;
    protected $surname;
    protected $email;

    /**
     * @param $dispatcher
     * @param $name
     * @param $surname
     * @param $email
     *
     * @return Customer
     */
    public static function register($dispatcher, $name, $surname, $email)
    {
        $event = new CustomerRegistered($name, $surname, $email);
        $customer = new self($dispatcher);
        $customer->recordThat($event);
        $customer->dispatch($event);

        return $customer;
    }

    protected function applyCustomerRegistered(CustomerRegistered $event)
    {
        $this->name = $event->getName();
        $this->surname = $event->getSurname();
        $this->email = $event->getEmailAddress();
    }

    public function updateProfile($field, $value)
    {
        $event = new CustomerUpdatedProfile($this->email, $field, $value);
        $this->recordThat($event);
        $this->dispatch($event);
    }

    protected function applyCustomerUpdatedProfile(CustomerUpdatedProfile $event)
    {
        $field = $event->getField();
        $this->$field = $event->getValue();
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }



}