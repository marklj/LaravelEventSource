<?php namespace App\Events\Customer;

use App\Customer;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;


class CustomerUpdatedProfile extends Event {

    use SerializesModels;

    protected $customer;
    protected $field;
    protected $value;

    /**
     * Create a new event instance.
     *
     * @param Customer $customer
     * @param          $field
     * @param          $value
     */
	public function __construct($customer_email, $field, $value)
	{
        $this->customer_email = $customer_email;
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function getType()
    {
        return Customer::class;
    }
}
