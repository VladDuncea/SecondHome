package com.example.secondhome.contact;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import com.example.secondhome.R;

public class ContactActivity extends AppCompatActivity {
    Button contactUs;
    Button aboutus;
    Button achievements;
    Button facilities;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_contact);
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

}
