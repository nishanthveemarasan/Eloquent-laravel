  <h3>Mutators & Casting</h3>
  <hr>
  <p>they will alow us to fomat attribute values when we <b>retireve or set</b> them</p>
  <p>for ex, we may want to convert the json fomat to array when retrieve</p>
  <br>
  <br>
  <h4>#Accessros</h4>
  <p>An Accessor transforms an attribute values when it is retrieved</p>
  <p><b>format: </b><h5>get{AttributeName}Attribute</h5></p>
 <p><b>Example 1</b> set Email attribute to lower case</p>
 <br>
 <pre><b>
    public function getEmailAttribute($value){
        return strtolower($value);
    }
 </b></pre>
 <p><b>Example 2</b> get the full name of a client</p>
 <br>
 <pre><b>
    public function getFullNameAttribute()
    {
        return $this->first_name." ".$this->last_name;
    }

    $getUcs = Customer::find(1)->full_name;

</b></pre>
<br>
<br>

 <h4>#Mutator</h4>
 <hr>
  <p>Mutator will be automatically called when we attempt to set the value of the colums</p>
 <p>This process will happen while storing</p>
 <br>
 <b>Format: </b><h5>set{AttributeName}Attribute</h5>
 <br>
 <p><b>Example 1</b> when we store the price, that should be multiplied by 100</p>
 <br>
 <pre><b>
    public function setAmountAttribute($value){
        $this->attributes['amount'] = $value * 100;
    }
 </b></pre>
 <br>
 <p><b>Example 2</b> store the first name in lower case</p>
 <br>
 <pre><b>
    public function setAmountAttribute($value){
        $this->attributes['amount'] = $value * 100;
    }
 </b></pre>
  <hr>
    <p><b>Mutator and accessor</b> are converting the attribute values from one format to another</p>
    <p><b>Attribute casting</b> are converting the attribute datatype from one to another when retrieve </p>
 <h4>#Attribute Casting</h4>
 <hr>
 <p>Here we store the data in one format and we want it to return in the different format</p>
 <p>for example, store as json format and returned in array format</p>
<p>Exercise we store number->string , status->int , detail->json</p>
<p>when we retrieve, we need them in different format</p>
<br>
<pre><b>
    protected $casts = [
        'number' => 'integer', //now number will be converted from string to int
        'status' => 'boolean', // now status will return either true or false
        'details' => 'array' // now it will retrun the result as an array
    ];
</b></pre>
