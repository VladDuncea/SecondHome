package com.example.secondhome.contact;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.view.menu.ActionMenuItem;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;

import com.example.secondhome.R;
import com.example.secondhome.locations.ListOfLocations;
import com.example.secondhome.mains.Main2LoggedInActivity;
import com.example.secondhome.mains.MainActivity;
import com.example.secondhome.showanimals.AnimalsActivity;
import com.example.secondhome.showanimals.MyAnimalsActivity;
import com.example.secondhome.ui.login.AppSingleton;
import com.google.android.material.navigation.NavigationView;

public class ContactActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener{
    Button contactUs;
    Button aboutus;
    Button achievements;
    Button facilities;
    private DrawerLayout mDrawer;
    private ActionBarDrawerToggle mToggle;
    private NavigationView navigationView;
    private ActionMenuItem item;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_contact);

        setNavigationViewListener();
        mDrawer=(DrawerLayout) findViewById(R.id.contactPage);
        mToggle= new ActionBarDrawerToggle(this, mDrawer,R.string.open,R.string.close);
        navigationView = (NavigationView) findViewById(R.id.mymenu);
        mDrawer.addDrawerListener(mToggle);
        mToggle.syncState();
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        aboutus=(Button) findViewById(R.id.aboutUs);
        View.OnClickListener lisenerAboutUs=new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent=new Intent(ContactActivity.this, AboutUsActivity.class);
                startActivity(intent);
            }
        };
        aboutus.setOnClickListener(lisenerAboutUs);

        facilities=(Button) findViewById(R.id.facilities);
        View.OnClickListener lisenerFacilities=new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent=new Intent(ContactActivity.this, FacilitiesActivity.class);
                startActivity(intent);
            }
        };
        facilities.setOnClickListener(lisenerFacilities);


        achievements=(Button) findViewById(R.id.achievments);
        View.OnClickListener lisenerAchievments=new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent=new Intent(ContactActivity.this, AchievmentsActivity.class);
                startActivity(intent);
            }
        };
        achievements.setOnClickListener(lisenerAchievments);
        contactUs=(Button) findViewById(R.id.contactUs);
        View.OnClickListener lisenerWriteUs=new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent=new Intent(ContactActivity.this, WriteUs.class);
                startActivity(intent);
            }
        };
        contactUs.setOnClickListener(lisenerWriteUs);
    }
    private void setNavigationViewListener() {
        System.out.println("setting navigation listener");
        NavigationView navigationView = (NavigationView) findViewById(R.id.mymenu);
        navigationView.setNavigationItemSelectedListener(this);
    }
    @Override
    public boolean onOptionsItemSelected(MenuItem item){
        System.out.println("in here");
        if(mToggle.onOptionsItemSelected(item))
        {
            return true;
        }
        return super.onOptionsItemSelected(item);
    }
    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        // Handle navigation view item clicks here.
        System.out.println("On navigation selected item");
        System.out.println(AppSingleton.getInstance(getApplicationContext()).getAnimalsToShow());
        switch (item.getItemId()) {

            case R.id.db0:
                AppSingleton.getInstance(getApplicationContext()).setAnimalsToShow("0");
                Intent intent=new Intent(ContactActivity.this, AnimalsActivity.class);
                startActivity(intent);
                break;
            case R.id.db1:
                AppSingleton.getInstance(getApplicationContext()).setAnimalsToShow("1");
                intent=new Intent(ContactActivity.this, AnimalsActivity.class);
                startActivity(intent);
                break;
            case R.id.db2:
                AppSingleton.getInstance(getApplicationContext()).setAnimalsToShow("2");
                intent=new Intent(ContactActivity.this, AnimalsActivity.class);
                startActivity(intent);
                break;
            case R.id.db3:
                AppSingleton.getInstance(getApplicationContext()).setAnimalsToShow("3");
                intent=new Intent(ContactActivity.this, AnimalsActivity.class);
                startActivity(intent);
                break;
            case R.id.db4:
                AppSingleton.getInstance(getApplicationContext()).setAnimalsToShow("4");
                intent=new Intent(ContactActivity.this, AnimalsActivity.class);
                startActivity(intent);
                break;
            case R.id.db5:
                AppSingleton.getInstance(getApplicationContext()).setAnimalsToShow("5");
                intent=new Intent(ContactActivity.this, AnimalsActivity.class);
                startActivity(intent);
                break;
            case R.id.db6:
                AppSingleton.getInstance(getApplicationContext()).setAnimalsToShow("6");
                intent=new Intent(ContactActivity.this, AnimalsActivity.class);
                startActivity(intent);
                break;
            case R.id.db:
                if(AppSingleton.getInstance(getApplicationContext()).getUser()!=null)
                {
                    intent=new Intent(ContactActivity.this, Main2LoggedInActivity.class);
                    intent.putExtra("username", AppSingleton.getInstance(getApplicationContext()).getLoggedInUserName());
                }
                else intent=new Intent(ContactActivity.this, MainActivity.class);
                startActivity(intent);
                break;
            case R.id.db8:
                intent=new Intent(ContactActivity.this, ContactActivity.class);
                startActivity(intent);
                break;
            case R.id.db10:
                intent=new Intent(ContactActivity.this, ListOfLocations.class);
                startActivity(intent);
                break;
            case R.id.db11:
                intent=new Intent(ContactActivity.this, MyAnimalsActivity.class);
                startActivity(intent);
                break;
        }
        //close navigation drawer
        mDrawer.closeDrawer(GravityCompat.START);
        return true;
    }

}
