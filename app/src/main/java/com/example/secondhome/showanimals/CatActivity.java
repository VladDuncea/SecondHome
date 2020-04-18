package com.example.secondhome.showanimals;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.view.menu.ActionMenuItem;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.Bundle;
import android.util.Base64;
import android.util.Log;
import android.view.MenuItem;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.example.secondhome.Main2LoggedInActivity;
import com.example.secondhome.MainActivity;
import com.example.secondhome.R;
import com.example.secondhome.contact.ContactActivity;
import com.example.secondhome.data.model.LoggedInUser;
import com.example.secondhome.ui.login.AppSingleton;
import com.example.secondhome.ui.login.LoginActivity;
import com.google.android.material.navigation.NavigationView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Text;

import java.util.HashMap;
import java.util.Map;

public class CatActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener  {
    private DrawerLayout mDrawer;
    private ActionBarDrawerToggle mToggle;
    private NavigationView navigationView;
    private ActionMenuItem item;
    private LinearLayout catsview;
    private static final String UrlForLogin="http://secondhome.fragmentedpixel.com/server/getanimals.php/";


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cat);
        setNavigationViewListener();
        mDrawer=(DrawerLayout) findViewById(R.id.showallCats);
        mToggle= new ActionBarDrawerToggle(this, mDrawer,R.string.open,R.string.close);
        navigationView = (NavigationView) findViewById(R.id.mymenuCats);
        System.out.println(mDrawer.toString());
        mDrawer.addDrawerListener(mToggle);
        mToggle.syncState();
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        catsview=(LinearLayout) findViewById(R.id.linearCats);
        getCats();

    }

    private void getCats(){
        System.out.println("Trying to log in");
        StringRequest strReq= new StringRequest(
                Request.Method.POST, UrlForLogin, new Response.Listener<String>() {
            @Override
            public void onResponse(String response)
            {
                Log.d("CatsSource", "Register Response: "+ response.toString());
                try{
                    System.out.println("Trying to request Object");
                    JSONObject obj=new JSONObject(response);
                    System.out.println(obj.toString());
                    int animalNo=Integer.parseInt(obj.getString("nr_animals"));
                    System.out.println(animalNo);
                    JSONArray animals=obj.getJSONArray("animals");
                    for(int i=0;i<animalNo;i++)
                    {
                        System.out.println(animals.get(i).toString());
                        ImageView img=new ImageView(CatActivity.this);
                        String encodedArray="data:image/jpeg;base64,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";
//                        encodedArray=encodedArray.replace("\\","");
//                        encodedArray=encodedArray.replace("////","//");
                        System.out.println(encodedArray);
                        byte [] encodeByte = Base64.decode(encodedArray,Base64.DEFAULT);
                        //Bitmap bitmap = BitmapFactory.decodeByteArray(encodeByte, 0, encodeByte.length);
                        img.setImageBitmap(BitmapFactory.decodeByteArray(encodeByte, 0, encodeByte.length));
                        TextView name=new TextView(CatActivity.this);
                        TextView description=new TextView(CatActivity.this);
                        //JSONObject cat=animals.get(i);
                        name.setText(animals.getJSONObject(i).getString("name"));
                        name.setTextSize(20);
                        name.setPadding(100,2,0,0);
                        description.setText(animals.getJSONObject(i).getString("description"));
                        description.setPadding(100,2,0,10);
                        catsview.addView(name);
                        catsview.addView(description);

                    }

                    //boolean error = obj.getBoolean("error");

                    // if(!error){
//                    System.out.println("here");
//                    String userName= obj.getString("user-firstname");
//                    String UID=obj.getString("UID");
//                    System.out.println(obj);
//                    System.out.println("user");
//
//                    user=new LoggedInUser(UID,email,userName);
//                    AppSingleton.getInstance(getApplicationContext()).setUser(user);
//                    Intent intent=new Intent(LoginActivity.this, Main2LoggedInActivity.class);
//                    System.out.println("We want to add user");
//                    intent.putExtra("username", userName);
//                    startActivity(intent);
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
                Log.e("CatsActivity", "Login error: "+ error.getMessage());
                Toast.makeText(getApplicationContext(),error.getMessage(),Toast.LENGTH_LONG);
            }
        })
        {
            @Override
            protected Map<String,String> getParams(){
                Map<String,String> params=new HashMap<String,String>();
                params.put("security_code", "8981ASDGHJ22123");
                params.put("pet_type", "1");
                return params;
            }

        };

        AppSingleton.getInstance(getApplicationContext()).addToRequestQueue(strReq,"getCats");
    }
    private void setNavigationViewListener() {
        System.out.println("setting navigation listener");
        NavigationView navigationView = (NavigationView) findViewById(R.id.mymenuCats);
        navigationView.setNavigationItemSelectedListener(this);
    }
    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        // Handle navigation view item clicks here.
        System.out.println("On navigation selected item");
        switch (item.getItemId()) {

            case R.id.db8:
                Intent intent=new Intent(CatActivity.this, ContactActivity.class);
                startActivity(intent);
                break;
            case R.id.db2:
                intent=new Intent(CatActivity.this, CatActivity.class);
                startActivity(intent);
                break;
            case R.id.db3:
                intent=new Intent(CatActivity.this, DogActivity.class);
                startActivity(intent);
                break;
        }
        //close navigation drawer
        mDrawer.closeDrawer(GravityCompat.START);
        return true;
    }
    @Override
    public boolean onOptionsItemSelected(MenuItem item){
        System.out.println("in OptionsItemSelected");

        if(item.getItemId()==R.id.db)
        {
            System.out.println("in here");
            Intent intent=new Intent(this, LoginActivity.class);
            startActivity(intent);
            return true;
        }
        if(mToggle.onOptionsItemSelected(item))
        {
            return true;
        }
        return super.onOptionsItemSelected(item);
    }



}
