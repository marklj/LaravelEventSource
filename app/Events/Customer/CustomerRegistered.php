<?php namespace App\Events\Customer;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class CustomerRegistered extends Event {

    use SerializesModels;

    protected $name;
    protected $surname;
    protected $email_address;

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->email_address;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }


    /**
     * Create a new event instance.
     *
     * @param $name
     * @param $surname
     * @param $email_address
     */
	public function __construct($name, $surname, $email_address)
	{
        $this->email_address = $email_address;
        $this->name = $name;
        $this->surname = $surname;
    }

}
