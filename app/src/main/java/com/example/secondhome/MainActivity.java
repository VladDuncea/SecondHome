package com.example.secondhome;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.view.menu.ActionMenuItem;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;

import android.content.ClipData;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.MotionEvent;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;

import com.example.secondhome.contact.ContactActivity;
import com.example.secondhome.showanimals.CatActivity;
import com.example.secondhome.showanimals.DogActivity;
import com.example.secondhome.ui.login.LoginActivity;
import com.example.secondhome.ui.login.RegisterActivity;
import com.google.android.material.navigation.NavigationView;

import java.io.Console;

public class MainActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener  {
    private Button login,register;
    private DrawerLayout mDrawer;
    private ActionBarDrawerToggle mToggle;
    private NavigationView navigationView;
    private ActionMenuItem item;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        setNavigationViewListener();
        mDrawer=(DrawerLayout) findViewById(R.id.mainmenu);
        mToggle= new ActionBarDrawerToggle(this, mDrawer,R.string.open,R.string.close);
        navigationView = (NavigationView) findViewById(R.id.mymenu);
        mDrawer.addDrawerListener(mToggle);
        mToggle.syncState();
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        login =(Button) findViewById(R.id.button5);
        register=(Button) findViewById(R.id.button6);

        View.OnClickListener lisenerLogin=new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent=new Intent(MainActivity.this, LoginActivity.class);
                startActivity(intent);
            }
        };
        View.OnClickListener lisenerRegister=new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent=new Intent(MainActivity.this, RegisterActivity.class);
                startActivity(intent);
            }
        };
        login.setOnClickListener(lisenerLogin);
        register.setOnClickListener(lisenerRegister);

    }


    private void setNavigationViewListener() {
        System.out.println("setting navigation listener");
        NavigationView navigationView = (NavigationView) findViewById(R.id.mymenu);
        navigationView.setNavigationItemSelectedListener(this);
    }
    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        // Handle navigation view item clicks here.
        System.out.println("On selected item");
        switch (item.getItemId()) {

            case R.id.db8:
                Intent intent=new Intent(MainActivity.this, ContactActivity.class);
                startActivity(intent);
                break;
            case R.id.db2:
                intent=new Intent(MainActivity.this, CatActivity.class);
                startActivity(intent);
                break;
            case R.id.db3:
                intent=new Intent(MainActivity.this, DogActivity.class);
                startActivity(intent);
                break;
        }
        //close navigation drawer
        mDrawer.closeDrawer(GravityCompat.START);
        return true;
    }
    @Override
    public boolean onOptionsItemSelected(MenuItem item){
        System.out.println("in here");

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
