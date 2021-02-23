<h3>#Cache</h3>
    <hr>
    <h4>#Storing Items in the Cache</h4>
    <p><b>Format: Cache($key , $value , Time)</b></p>
    <br>
    <pre><b>
    $time = now()->addMinutes(30);
    Cache::put('key' , $value , $time);
   </b></pre>
    <br>
    <p>If the storage time is not passed then the item will be stored indefinitely</p>
    <pre><b>
        Cache::put('key' , $value );
       </b></pre>
       <br>
       <br>
    <h4>#access the Items from the Cache</h4>
    <pre><b>
    Cache::get($key);
   </b></pre>
    <br>
    <h4>#Store if not Present</h4>
    <p><b>add</b> method will only add the item to the cache if it doesnt already exist in the cache</p>
    <pre><b>
        Cache::add($key, $value, $time);
    </b></pre>
    <br>
    <br>
    <h4>#Removing the Items from the Cache</h4>
    <p>To remove an item from the cache</p>
    <pre><b>
        Cache::forget($key)
    </b></pre>
    <br>
    <p>To clear the entire item from the cache</p>
    <pre><b>
        Cache::flush()
    </b></pre>