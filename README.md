 <h1>Eloquent Model</h1>
    <h3s>Generating Model Class</h3s>
    <hr>
    <p>php artisan make:model ModelName -m</p>
    <p><b>-m</b> :- it will create migration file for that model</p>
    <h4>Table Name</h4>
    <h6>protected $table = "table_name"</h6>
    <br>
    <h4>Primary Key</h4>
    <h6>protected $primaryKey = "table_id"</h6>
    <p>if the table has the primary key other than <b>id</b> , we have to define the primary key</p>
    <br>
    <h4>Time stamps</h4>
    <h6>protected $timestamps = false</h6>
    <p>if the table doest have the <b>created_at</b> and <b>updated_at</b></p>
    <br>
    <p>if we have customised timestamp names</p>
    <h6>const CREATED_AT = 'creation_at'</h6>
    <h6>const UPDATED_AT = 'updation_at'</h6>
    <br>
    <h5>Database Connection</h5>
    <p>if we want to conect to diffrent database other than default,</p>
    <h6>protected $connection = 'connection_name'</h6>
    <br>
    <h5>Default Attributes Values</h5>
    <p>if we want to define a default values for some of the model's attributes,</p>
    <h6>protected $attributes = array( 'attribute_name' , false,)</h6>
    <br>
    <h4>Model Operations</h4>
 <hr>
 <h5>Retrieving A Single Row</h5>
 <h6>modelName::first()</h6>
 <p>Retiving a single row by its <b>ID</b> </p>
 <h6>modelName::find($id)</h6>
 <br>
 <br>
 <h5>#Aggregates</h5>
 <h6>modelName::count()</h6>
 <h6>modelName::max('col_name')</h6>
 <h6>modelName::min(''col_name)</h6>
 <h6>modelName::avg('col_name')</h6>
 <h6>modelName::sum()</h6>
 <br>
 <h5>#Determining if Records exists</h5>
 <h6>MOdelName::exists()</h6>
 <p>it will retrun <b>true</b> or <b>false</b> </p>
 <hr>
 <h5>Select Statements</h5>
 <p>If we dont want to return all the colums then,</p>
 <h6>ModelName::select('col_1' , 'col_2')->get()</h6>
 <br>
 <h5>#havingRaw / orHavingRaw</h5>
<p>these methods will be used as WHERE clause can not be used with aggregate funations</p>
<p><b>find all the customer who has paid more than 100 in total</b></p>
<h6>ModelName::select('customer_name' , DB::raw('SUM(payment) as total'))</h6>
<h6>->groupBy('customer_name')</h6>
<h6>->havingRaw('SUM(payment) > 100')->get()</h6>
<br>
<br>
<br>
    <br>

<h5>WHERE clauses</h5>
<pre><b>
    $getCity = Payment::where('amount', '>', '10')
                            ->where('customer_id', '>', '20')
                            ->get()
                            ->toArray();
</b>
    
</pre>
<p>we can write above query into like this</p>
<pre><b>
    $getCity = Payment::where(function ($query) {
        $query->where('amount', '>', '10')
            ->where('customer_id', '>', '20');
    })->get()->toArray();
</b></pre>
<br>
<h5>#orWhere</h5>
<p>Select * from table where amount > 2 or id < 10</p>
<pre><b>
    $getCity = Payment::where('amount', '>', '2')
                    ->orWhere('customer_id', '<', '10')
                    ->get()->toArray();
</b></pre>
<br>
<b>Example</b>
<p>select * from users where votes > 100 or (name = 'abc' and votes > 50)</p>
<pre><b>
    $sql = Payment::where('votes' , '>' , '100')
                        ->orWhere(function($query){
                            $query->where('name' , 'Abc')
                                    ->where('votes' ,'>','100');
                        })
                        ->get()
                        ->toArray();
</b></pre>
<br>
<br>
<h5>#Additional Where clauses</h5>
<h6>whereBetween / orWhereBetween</h6>
<p>method verifies that a colum's value is between two values</p>
<pre><b>
    $getCity = Payment::whereBetween('amount' , [2 , 5])
                            ->get()
                            ->toArray();
</b></pre>
    <br>
    <br>
    <h6>whereNotBetween / orWhereNotBetween</h6>
    <pre><b>
        $getCity = Payment::whereNotBetween('amount' , [2 , 5])
                            ->get()
                            ->toArray();
    </b></pre>
    <h6>whereIn/whereNotIn / orWhereIn / orWhereNotIn</h6>
    <p>check the column value against given Array</p>
    <pre><b>
        $cusId = array(1, 2, 3, 4, 5, 8);
        $getCity = Payment::whereIn('customer_id', $cusId)
                            ->get()
                            ->toArray();
    </b></pre>
    <br>
    <br>    
    <h6>whereNull/ whereNotNull</h6>
    <p>check if the column value is null</p>
    <pre><b>
        $getCity = Payment::whereNull('customer_id')
                            ->get()
                            ->toArray();
    </b></pre>
    <br>
    <br>
    <h6>whereDate / whereMonth/ whereDay / whereYear / whereTime</h6>
    <p><b>whereDate: </b>return the results of the day between '00' - ''23-59-59</p>
    <b>whereDate('created_at' , '2019-01-01')</b>
    <p><b>whereMonth</b> compare a column's value against a specific month</p>
    <b>whereMonth('created_at' , '12')</b>
    <br>
    <p>get the results between two specific dates</p>
    <pre><b>
        $today = date('Y-m-d')." 23:59:59";
        $last = date('Y-m-d' , strtotime($today . ' -7 day'))." 23:59:59";
        $result = users::whereBetween('created_at' , [$last , $today])->get()->count();
    </b>
    </pre>
    <br>
    <pre><b>
        $getCity = Payment::select('customer_id', DB::raw('sum(amount) as totalPayment , count(customer_id) as totalRecords'))
            ->whereMonth('payment_date', '2')
            ->groupBy('customer_id')
            ->get()
            ->toArray();
    </b></pre>
