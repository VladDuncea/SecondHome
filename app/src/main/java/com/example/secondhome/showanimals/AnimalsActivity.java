package com.example.secondhome.showanimals;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.view.menu.ActionMenuItem;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;

import android.content.Intent;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.example.secondhome.mains.Main2LoggedInActivity;
import com.example.secondhome.mains.MainActivity;
import com.example.secondhome.R;
import com.example.secondhome.contact.ContactActivity;
import com.example.secondhome.ui.login.AppSingleton;
import com.google.android.material.navigation.NavigationView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class AnimalsActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener  {
    private DrawerLayout mDrawer;
    private ActionBarDrawerToggle mToggle;
    private NavigationView navigationView;
    private ActionMenuItem item;
    private LinearLayout catsview;
    private static final String UrlForLogin="http://secondhome.fragmentedpixel.com/server/getanimals.php/";
    private String animalType;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cat);

        animalType=AppSingleton.getInstance(getApplicationContext()).getAnimalsToShow();


        setNavigationViewListener();
        mDrawer=(DrawerLayout) findViewById(R.id.showallCats);
        mToggle= new ActionBarDrawerToggle(this, mDrawer,R.string.open,R.string.close);
        navigationView = (NavigationView) findViewById(R.id.mymenuCats);
        mDrawer.addDrawerListener(mToggle);
        mToggle.syncState();
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        catsview=(LinearLayout) findViewById(R.id.linearCats);
        getCats();

    }

    private void getCats(){
        System.out.println("Trying request animals");
        StringRequest strReq= new StringRequest(
                Request.Method.POST, UrlForLogin, new Response.Listener<String>() {
            @Override
            public void onResponse(String response)
            {
                Log.d("AnimalSource", "Register Response: "+ response.toString());
                try{

                    System.out.println("Trying to request Object");
                    JSONObject obj=new JSONObject(response);
                    System.out.println(obj.toString());
                    int animalNo=Integer.parseInt(obj.getString("nr_animals"));
                    System.out.println(animalNo);
                    JSONArray animals=obj.getJSONArray("animals");

                    for(int i=0;i<animalNo;i++)
                    {
//                        if(i==0){
                        System.out.println(animals.get(i).toString());
//                        ImageView img=new ImageView(AnimalsActivity.this);
//                        String encodedArray=animals.getJSONObject(i).getString("image");
//                        encodedArray=encodedArray.replace("data:image/jpg;base64,/9j/","");
////                        encodedArray=encodedArray.replace("////","//");
//                        encodedArray=encodedArray.replace("\\","");
//                        System.out.println(encodedArray);
//                        byte [] encodeByte = Base64.decode(encodedArray,Base64.DEFAULT);
//                        Glide.with(AnimalsActivity.this)
//                                .load(encodeByte)
//                                .into(img);
//                        Bitmap bitmap = BitmapFactory.decodeByteArray(encodeByte, 0, encodeByte.length);
//                        img.setImageBitmap(BitmapFactory.decodeByteArray(encodeByte, 0, encodeByte.length));
//                        }
                       // Picasso.get().load().into(img);
                        TextView name=new TextView(AnimalsActivity.this);
                        TextView description=new TextView(AnimalsActivity.this);
                        Drawable buttonBackground=getResources().getDrawable(R.drawable.btn_shape_round_green);
                        Button viewDetails=new Button(AnimalsActivity.this);

                        viewDetails.setBackground(buttonBackground);

                        viewDetails.setTextColor(getResources().getColor(R.color.white));
                        viewDetails.setLayoutParams(new LinearLayout.LayoutParams(400,120));
                        viewDetails.setText("Mai multe detalii");


                        name.setText(animals.getJSONObject(i).getString("name"));
                        name.setTextSize(25);
                        name.setGravity(View.TEXT_ALIGNMENT_GRAVITY);
                        name.setPadding(0,60,0,0);
                        description.setText("Vârstă:"+animals.getJSONObject(i).getString("birthdate"));
                        description.setTextSize(20);
                        description.setGravity(View.TEXT_ALIGNMENT_GRAVITY);


                        //catsview.addView(img);
                        catsview.addView(name);
                        catsview.addView(description);
                        catsview.addView(viewDetails);

                    }


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
                params.put("request_type","0");
                params.put("pet_type", animalType);
                return params;
            }

        };

        AppSingleton.getInstance(getApplicationContext()).addToRequestQueue(strReq,"getCats");
    }
    private void setNavigationViewListener() {
        System.out.println("setting navigation listener");
        NavigationView navigationView = (NavigationView) findViewById(R.id.mymenuCats);
        System.out.println(navigationView.toString());
        navigationView.setNavigationItemSelectedListener(this);
    }
    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        // Handle navigation view item clicks here.
        System.out.println("On navigation selected item");
        System.out.println(AppSingleton.getInstance(getApplicationContext()).getAnimalsToShow());
        switch (item.getItemId()) {

            case R.id.db0:
                AppSingleton.getInstance(getApplicationContext()).setAnimalsToShow("0");
                Intent intent=new Intent(AnimalsActivity.this, AnimalsActivity.class);
                startActivity(intent);
                break;
            case R.id.db1:
                AppSingleton.getInstance(getApplicationContext()).setAnimalsToShow("1");
                intent=new Intent(AnimalsActivity.this, AnimalsActivity.class);
                startActivity(intent);
                break;
            case R.id.db2:
                AppSingleton.getInstance(getApplicationContext()).setAnimalsToShow("2");
                intent=new Intent(AnimalsActivity.this, AnimalsActivity.class);
                startActivity(intent);
                break;
            case R.id.db3:
                AppSingleton.getInstance(getApplicationContext()).setAnimalsToShow("3");
                intent=new Intent(AnimalsActivity.this, AnimalsActivity.class);
                startActivity(intent);
                break;
            case R.id.db4:
                AppSingleton.getInstance(getApplicationContext()).setAnimalsToShow("4");
                intent=new Intent(AnimalsActivity.this, AnimalsActivity.class);
                startActivity(intent);
                break;
            case R.id.db5:
                AppSingleton.getInstance(getApplicationContext()).setAnimalsToShow("5");
                intent=new Intent(AnimalsActivity.this, AnimalsActivity.class);
                startActivity(intent);
                break;
            case R.id.db6:
                AppSingleton.getInstance(getApplicationContext()).setAnimalsToShow("6");
                intent=new Intent(AnimalsActivity.this, AnimalsActivity.class);
                startActivity(intent);
                break;
            case R.id.db:
                if(AppSingleton.getInstance(getApplicationContext()).getUser()!=null)
                {
                    intent=new Intent(AnimalsActivity.this, Main2LoggedInActivity.class);
                    intent.putExtra("username", AppSingleton.getInstance(getApplicationContext()).getLoggedInUserName());
                }
                else intent=new Intent(AnimalsActivity.this, MainActivity.class);
                startActivity(intent);
                break;
            case R.id.db8:
                intent=new Intent(AnimalsActivity.this, ContactActivity.class);
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

        if(mToggle.onOptionsItemSelected(item))
        {
            System.out.println("onOptionsItemSeletced time to shine");
            return true;
        }
        System.out.println("onOptionsItemSeletced time");
        return super.onOptionsItemSelected(item);
    }



}
