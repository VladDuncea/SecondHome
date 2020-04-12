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
import android.widget.TextView;
import android.widget.Toast;

import com.example.secondhome.ui.login.AppSingleton;
import com.example.secondhome.ui.login.LoginActivity;
import com.google.android.material.navigation.NavigationView;

import java.io.Console;

public class Main2LoggedInActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener  {
    private TextView nameMessage;
    private DrawerLayout mDrawer;
    private Button contact;
    private Button logout;
    private ActionBarDrawerToggle mToggle;
    private NavigationView navigationView;
    private ActionMenuItem item;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2_logged_in);
        nameMessage=(TextView) findViewById(R.id.userMessage);
        nameMessage.append(" Bine ai venit, "+ AppSingleton.getInstance(getApplicationContext()).getLoggedInUserName().toString()+"!");

        mDrawer=(DrawerLayout) findViewById(R.id.mainmenu);
        mToggle= new ActionBarDrawerToggle(this, mDrawer,R.string.open,R.string.close);
        navigationView = (NavigationView) findViewById(R.id.mymenu);
        mDrawer.addDrawerListener(mToggle);
        //  mDrawer.addDrawerListener();
        mToggle.syncState();
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        contact=(Button) findViewById(R.id.contactButtonLoggedIn);

        View.OnClickListener lisenerContact=new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent=new Intent(Main2LoggedInActivity.this, ContactActivity.class);
                startActivity(intent);
            }
        };
        contact.setOnClickListener(lisenerContact);

        //logout
        logout=(Button) findViewById(R.id.logout);
        View.OnClickListener lisenerLogout=new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AppSingleton.getInstance(getApplicationContext()).logoutUser();
                Toast.makeText(getApplicationContext(), "Ati fost deconectat", Toast.LENGTH_SHORT).show();
                Intent intent=new Intent(Main2LoggedInActivity.this, MainActivity.class);
                startActivity(intent);
            }
        };
        logout.setOnClickListener(lisenerLogout);
    }


    private void setNavigationViewListener() {
        System.out.println("in here");
        NavigationView navigationView = (NavigationView) findViewById(R.id.mymenu);
        navigationView.setNavigationItemSelectedListener(this);
    }
    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        // Handle navigation view item clicks here.
        System.out.println("in here2");
        switch (item.getItemId()) {

            case R.id.db: {

                break;
            }
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