<?php namespace App\Projectors;

use Illuminate\Support\Facades\Redis;

class CustomerRepository {

    protected $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }


    public function create($name, $surname, $email)
    {
        $customer = new \stdClass();
        $customer->name = $name;
        $customer->surname = $surname;
        $customer->email = $email;
        $this->redis->set('customer:'.$email, serialize($customer));

        $customers = unserialize($this->redis->get('customer_bag'));
        $customers[$email] = $customer;
        $this->redis->set('customer_bag', serialize($customers));
    }

    public function update($customer_email, $field, $value)
    {
        $customer = unserialize($this->redis->get('customer:'.$customer_email));
        $customer->$field = $value;
        $customer->email = $customer_email;
        $this->redis->set('customer:'.$customer_email, serialize($customer));

        $customers = unserialize($this->redis->get('customer_bag'));
        $customers[$customer_email] = $customer;
        $this->redis->set('customer_bag', serialize($customers));
    }

    public function findByEmail($email)
    {
        return unserialize($this->redis->get('customer:'.$email));
    }
    
    public function all()
    {
        return unserialize($this->redis->get('customer_bag'));
    }
}