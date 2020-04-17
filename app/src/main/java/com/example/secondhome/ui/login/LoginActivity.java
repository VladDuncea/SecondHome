package com.example.secondhome.ui.login;

import android.content.Intent;
import android.os.Bundle;

import androidx.appcompat.app.AppCompatActivity;

import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.example.secondhome.Main2LoggedInActivity;
import com.example.secondhome.R;
import com.example.secondhome.data.model.LoggedInUser;
import com.android.volley.Request;
import com.android.volley.Response;

import org.json.JSONObject;
import org.json.JSONException;

import java.util.HashMap;
import java.util.Map;

public class LoginActivity extends AppCompatActivity {
    private static final String UrlForLogin="http://secondhome.fragmentedpixel.com/server/login.php/";
    //private LoginViewModel loginViewModel;
    private EditText loginInputEmail,loginInputPassword;
    private Button login;
    LoggedInUser user;
   // private Button signin;

      @Override
      public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        loginInputEmail= (EditText)findViewById(R.id.email);
        loginInputPassword=(EditText) findViewById(R.id.password);
        login=(Button) findViewById(R.id.login);
        login.setOnClickListener(new View.OnClickListener() {
                                     @Override
                                     public void onClick(View v) {
                                         System.out.println("onClick is fine");
                                         loginUser(loginInputEmail.getText().toString(), loginInputPassword.getText().toString());
                                     }
                                 }

        );
      }
      private void loginUser(final String email, final String password)
      {
          System.out.println("Trying to log in");
          StringRequest strReq= new StringRequest(
                  Request.Method.POST, UrlForLogin, new Response.Listener<String>() {
              @Override
              public void onResponse(String response)
              {
                  Log.d("LoginDataSource", "Register Response: "+ response.toString());
                  try{
                      System.out.println("Trying to request Object");
                      JSONObject obj=new JSONObject(response);
                      System.out.println(obj.toString());
                      //boolean error = obj.getBoolean("error");

                     // if(!error){
                          System.out.println("here");
                          String userName= obj.getString("user-firstname");
                          String UID=obj.getString("UID");
                          System.out.println(obj);
                          System.out.println("user");

                          user=new LoggedInUser(UID,email,userName);
                          AppSingleton.getInstance(getApplicationContext()).setUser(user);
                          Intent intent=new Intent(LoginActivity.this, Main2LoggedInActivity.class);
                          System.out.println("We want to add user");
                          intent.putExtra("username", userName);
                          startActivity(intent);
//                      }
//                      else{
//                          String errorMsg=obj.getString("error_msg");
//                          Toast.makeText(getApplicationContext(),errorMsg,Toast.LENGTH_LONG).show();
//                      }

                  } catch(JSONException e)
                  {
                      System.out.println("error here");
                      e.printStackTrace();
                  }
              }

          }, new Response.ErrorListener() {
              @Override
              public void onErrorResponse(VolleyError error) {
                Log.e("LoginActivity", "Login error: "+ error.getMessage());
                Toast.makeText(getApplicationContext(),error.getMessage(),Toast.LENGTH_LONG);
              }
          })
          {
            @Override
            protected Map<String,String> getParams(){
                Map<String,String> params=new HashMap<String,String>();
                params.put("user-email", email);
                params.put("user-password", password);
                return params;
            }

          };

          AppSingleton.getInstance(getApplicationContext()).addToRequestQueue(strReq,"login");


      }
}
