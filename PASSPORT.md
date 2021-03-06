<h3>#Passport</h3>
    <hr>
    <h4>Installation</h4>
    <pre><b>
        composer require laravel/passport
    </b></pre>
    <br>
    <h5>#migrate Passport tables</h5>
    <pre><b>
        php artisan migrate
    </b></pre>
    <br>
    <h5>#intall passport to generate the Encryption keys</h5>
    <pre><b>
        php artisan passport:install --uuids
    </b></pre>
    <br>
    <p>After thaat add, <b>Laravel\Passport\HasApiTokens</b> in the user Model</p>
    <pre><b>
        use Laravel\Passport\HasApiTokens;
        class User extends Authenticatable
        {
            use HasApiTokens, HasFactory, Notifiable;
        }
    </b></pre>
    <br>
    <p>Next, we Should add the <b>Passport::routes</b> method withinthe <b>boot</b> method
        of the <b>App\Providers\AuthServiceProvider</b></p>
    <p>This will register the routes necessary to issue access tokens and revoke access tokens, clients, and personal
        access tokens</p>
    <br>
    <pre><b>
            use Laravel\Passport\Passport;
            class AuthServiceProvider extends ServiceProvider
            {
                public function boot()
                {
                    Passport::routes();
                }
            }
        </b></pre>
    <br>
    <p><b>Finally,</b> in <b>config/auth.php</b> file, we should set the driver oprion of api as passport</p>
    <pre><b>
            'api' => [
                'driver' => 'passport',
                'provider' => 'users',
            ],
    </b></pre>
   <br/>
    <br/>
     <hr/>
    <h4>Generate the token while register a user</h4>
     <hr/>
    <h4>Generate the token while register a user</h4>
    <pre><b>
            $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 202);//pass the errror as json format
        }
        //
        $allData = $request->all();
        $allData['password'] = bcrypt($allData['password']);
        $user = USer::create($allData);
        $resArr = [];
        $resArr['token'] = $user->createToken('api-application')->accessToken; //generate the access token
        $resArr['name'] = $user->name;
        return response()->json($resArr, 200);
        </b></pre>
    <br>
    <hr>
    <h4>Generate the token while login</h4>
    <br>
    <pre><b>
            $email = $request['email'];
            $password = $request['password'];
            if (Auth::attempt([
                'email' => $email,
                'password' => $password
            ])) {
                $user = Auth::user();
                $resArr['token'] = $user->createToken('api-application')->accessToken;
                $resArr['name'] = $user->name;
                return response()->json($resArr, 200);
            } else {
                return response()->json(['error' => "unAuthorised Access"], 203);
            }
        </b></pre>
    <br>
    <h3>OR</h3>
    <p><b>We can use the login url of passport library</b></p>
    <pre><b>
       {{BASE_URL}}/oauth/token    
       //inputs
       {
            "client_id":"92ee6acc-5195-4691-9b0f-53638eaa35ff",
            "grant_type":"password",
            "client_secret":"Wb0MdVr9nLDkZz8gDNvilviHkFcC3ryg7gLWamuI",
            "username":"iamnishanthveema@gmail.com",
            "password":"12345678"
        }
        //post man tesing in other urls we need to send thses two in the header
            Content-Type: application/json,
            Accept: application/json,
            Authorization: Bearer {token}
            //now we will be able to see the error reponse in json
            //other wise it will be rodrect to login route which is defined in laravel middleare
        </b></pre>
        <br>
    <h4>Logout</h4>
    <pre><b>
            public function logout (Request $request) {
                $token = $request->user()->token();
                $token->revoke();
                $response = ['message' => 'You have been successfully logged out!'];
                return response($response, 200);
            }
        </b></pre>
        <br />
         <h4>Protect routes with Passport</h4>
    <pre><b>
            Route::middleware('auth:api')->group(function () {
                // our routes to be protected will go in here
                Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
            });
            or
            Route::apiResource('/ceo', 'Api\CEOController')->middleware('auth:api');
            //we need to generate the keys
             php artisan key:generate
        </b></pre>
        <br>
        php artisan key:generate
           
        
