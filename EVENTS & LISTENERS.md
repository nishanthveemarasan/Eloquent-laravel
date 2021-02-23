 <h3>#Events and Listeners</h3>
    <hr>
     <p>We can create an event that will perform the actions through the listeners</p>
    <p>Event usually holds the data that is used by listeners </p>
    <br>
    <b>Once we create a clinet, following events will occur</b>
    <b>1. welcome email will be sent to the new user</b>
    <b>2. The new user will be registered to NEws Letter</b>
    <b>1. Notification will be sent to admin</b>
    <br>
    <p><b>So user creation is an event and those 3 actions are listeners</b></p>
    <br>
    <h4>#Event Creation</h4>
    <pre><b>php artisan make:event NewCustomerRegisteredEvent</b></pre>
    <br>
    <pre><b>
        $customer = Customer::create($user);
        //call the event  and pass the customer data
        event(new NewCustomerHasRegisteredEvent($customer));
    </b></pre>
    <h5>In NewCustomerHasRegisteredEvent event class</h5>
    <pre><b>
        public $customer; //this should be public to be used by listeners
        public function __construct($customer)
        {
            $this->customer = $customer;
        }
    </b></pre>
    <br>
    <b>Now We need to create 3 listeners</b>
    <pre><b>
        php artisan make:listener WelcomeNewCustomerListener //welcome email will be sent to new customer
        php artisan make:listener RegisterNEwsLetterListener // customer will be registered to News Letter
        php artisan make:listener NOtifySlackAdminListener //Notification will be sent to Admin
    </b></pre>
    <br>
    <br>
    <h6>For example, in WelcomeNewCustomerListener</h6>
    <br>
    <pre><b>
        public function handle($event)
        {
            //$event->customer->email // to access the data that is in the event
            dump($event->customer->email . ' sending mail to new user');
        }
    </b></pre>
    <br>
    <br>
    <h5>Join the listeners to Event</h5>
    <br>
    <h6>In EventServiceProvider</h6>
    <br>
    <pre><b>
        use App\Listeners\NOtifySlackAdminListener;
        use App\Events\NewCustomerHasRegisteredEvent;
        use App\Listeners\RegisterNEwsLetterListener;
        use App\Listeners\WelcomeNewCustomerListener;
        //
        protected $listen = [
        NewCustomerHasRegisteredEvent::class => [
            WelcomeNewCustomerListener::class,
            RegisterNEwsLetterListener::class,
            NOtifySlackAdminListener::class,
        ],
    ];
    </b></pre>
    