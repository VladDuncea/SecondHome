package com.example.secondhome.ui.login;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.content.Intent;

import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.example.secondhome.R;
import com.android.volley.Request;
import com.android.volley.Response;

import org.json.JSONObject;
import org.json.JSONException;

import java.util.HashMap;
import java.util.Map;
public class RegisterActivity extends AppCompatActivity {

    private static final String TAG = "RegisterActivity";
    private static final String URL_FOR_REGISTRATION = "http://secondhome.fragmentedpixel.com/server/register.php/";
    private static final String urlForEmail = "http://secondhome.fragmentedpixel.com/server/checkemail.php/";
    //ProgressDialog progressDialog;
    private boolean isUsed=false;
    private EditText signupInputFirstName, signupInputLastName, signupInputEmail, signupInputPassword, signupInputSecondPassword;
    private Button btnSignUp;
   // private Button btnLinkLogin;
   // private RadioGroup genderRadioGroup;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);


       signupInputFirstName = (EditText) findViewById(R.id.firstName);
       signupInputLastName= (EditText) findViewById(R.id.lastName);

       signupInputEmail = (EditText) findViewById(R.id.emailRegister);
       signupInputPassword = (EditText) findViewById(R.id.passwordRegister);
       signupInputSecondPassword=(EditText) findViewById((R.id.passwordConfirmationRegister));
//
        btnSignUp = (Button) findViewById(R.id.buttonRegisterPage);
//        btnLinkLogin = (Button) findViewById(R.id.btn_link_login);
//
//        genderRadioGroup = (RadioGroup) findViewById(R.id.gender_radio_group);
        btnSignUp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                submitForm();
            }
       });
//
    }
//
    private void submitForm() {
        System.out.println(signupInputFirstName.getText().toString());
        System.out.println(signupInputLastName.getText().toString());
        System.out.println(signupInputEmail.getText().toString());
        System.out.println(signupInputPassword.getText().toString());
        if(signupInputPassword.getText().toString().length()<5)
        {
            Toast.makeText(getApplicationContext(),"Parola trebuie sa contina minim 6 caractere",Toast.LENGTH_SHORT).show();
            return ;
        }
        isUsed=false;
        //check if email is already in use
       StringRequest emailReq=new StringRequest(Request.Method.POST,
               urlForEmail,
               new Response.Listener<String>() {
           @Override
                   public void onResponse(String response){
               Log.d(TAG, "Register Response: " + response.toString());
//
               try {
                   JSONObject jObj = new JSONObject(response);
                   String status=jObj.getString("status");
                   char c=status.charAt(0);
                   if(c=='1') {

                       // String user = jObj.getString("user-firstname");
                       String used=jObj.getString("email-used");
                       if(used.equals("1")) {
                           Toast.makeText(getApplicationContext(), "Există deja un cont ce folosește acest email.", Toast.LENGTH_SHORT).show();
                            System.out.println("used");
                            isUsed=true;
                       }
                       else {
                           if(!isUsed){
                    if(signupInputPassword.getText().toString().equals(signupInputSecondPassword.getText().toString())) {
                            registerUser(signupInputFirstName.getText().toString(),
                                signupInputLastName.getText().toString(), signupInputEmail.getText().toString(),
                                signupInputPassword.getText().toString(),
                                signupInputSecondPassword.getText().toString());
                            }
                       else  Toast.makeText(getApplicationContext(),  "Cele două parole nu coincid.", Toast.LENGTH_SHORT).show();}
                       }

                   }
                   else System.out.println("Status is 0");
               } catch (JSONException e) {
                   e.printStackTrace();
               }

           }
               }, new Response.ErrorListener() {
           @Override
           public void onErrorResponse(VolleyError error) {
               Log.e(TAG, "Registration Error: " + error.getMessage());
               Toast.makeText(getApplicationContext(),
                       error.getMessage(), Toast.LENGTH_LONG).show();
           }
       }
       ){
           @Override
           protected Map<String, String> getParams() {// Posting params to register url
               Map<String, String> params = new HashMap<String, String>();
               params.put("user-email", signupInputEmail.getText().toString());
               return params;}
       };
        AppSingleton.getInstance(getApplicationContext()).addToRequestQueue(emailReq, "checkemail");
        //send to register if passwords match
//        if(!isUsed){
//        if(signupInputPassword.getText().toString().equals(signupInputSecondPassword.getText().toString())) {
//            registerUser(signupInputFirstName.getText().toString(),
//                    signupInputLastName.getText().toString(),
//                    signupInputEmail.getText().toString(),
//                    signupInputPassword.getText().toString(),
//                    signupInputSecondPassword.getText().toString());
//        }
//        else  Toast.makeText(getApplicationContext(),  "Your passwords do not match", Toast.LENGTH_SHORT).show();}
    }
//
    private void registerUser(final String firstName, final String lastName, final String email, final String password,
                              final String secondPass) {
//        // Tag used to cancel the request
        String cancel_req_tag = "register";
      System.out.println("here");
        StringRequest strReq = new StringRequest(Request.Method.POST,
                URL_FOR_REGISTRATION, new Response.Listener<String>() {
//
           @Override
            public void onResponse(String response) {
                Log.d(TAG, "Register Response: " + response.toString());
//
                try {
                   JSONObject jObj = new JSONObject(response);
                    String status=jObj.getString("status");
                    char c=status.charAt(0);
                    if(c=='1') {

                       // String user = jObj.getString("user-firstname");
                        Toast.makeText(getApplicationContext(),  ", You are successfully Added! Time to login", Toast.LENGTH_SHORT).show();
                       // Launch login activity
                        Intent intent = new Intent(RegisterActivity.this, LoginActivity.class);
                        startActivity(intent);
                        finish();
                    }
                    else System.out.println("Status is 0");
                } catch (JSONException e) {
                    e.printStackTrace();
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e(TAG, "Registration Error: " + error.getMessage());
                Toast.makeText(getApplicationContext(),
                        error.getMessage(), Toast.LENGTH_LONG).show();
            }
        }) {
            @Override
            protected Map<String, String> getParams() {// Posting params to register url
                Map<String, String> params = new HashMap<String, String>();
                params.put("user-email", email);
                params.put("user-password", password);
                params.put("user-firstname", firstName);
                params.put("user-lastname", lastName);
                return params;
           }
       };
//        // Adding request to request queue
        AppSingleton.getInstance(getApplicationContext()).addToRequestQueue(strReq, cancel_req_tag);
    }

//


}