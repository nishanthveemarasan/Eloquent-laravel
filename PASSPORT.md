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
        php artisan passport:install
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
    <h4>Logout</h4>
    <pre><b>
            public function logout (Request $request) {
                $token = $request->user()->token();
                $token->revoke();
                $response = ['message' => 'You have been successfully logged out!'];
                return response($response, 200);
            }
        </b></pre>
           
        